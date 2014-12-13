<?php
    namespace c006\utility\migration\controllers;

    use c006\utility\migration\assets\AppAssets;
    use c006\utility\migration\assets\AppUtility;
    use c006\utility\migration\models\MigrationUtility;
    use yii\web\Controller;
    use Yii;

    /**
     * Class DefaultController
     * 
     * @author Jon Chambers <c006@users.noreply.github.com>
     *
     * @package c006\utility\migration\controllers
     */
    class DefaultController extends Controller
    {

        /**
         *
         */
        function init()
        {
            $view = $this->getView();
            AppAssets::register($view);
        }

        /**
         * @return string
         */
        public function actionIndex()
        {
            $initialTabLevel = 0;
            $output = new OutputString(['tabLevel' => $initialTabLevel]);
            $tables_value = '';
            if ( isset($_POST['MigrationUtility']) ) {
                $tables_value = $_POST['MigrationUtility']['tables'];
                $databaseType = $_POST['MigrationUtility']['databaseType'];
                $ifThen       = $_POST['MigrationUtility']['addIfThenStatements'];
                $tableOptions = $_POST['MigrationUtility']['tableOptions'];
                $tables       = explode(',', str_replace(' ', '', $tables_value));
                foreach ($tables as $table) {
                    $columns        = \Yii::$app->db->getTableSchema($table);
                    $prefix         = \Yii::$app->db->tablePrefix;
                    $table_prepared = str_replace($prefix, '', $table);
                    $output->tabLevel = $initialTabLevel;
                    foreach ($databaseType as $dbType) {
                        $output->addStr('$tableOptions = "'.$tableOptions.'";');
                        if ($ifThen) {
                            $output->addStr('if ($dbType == "' . $dbType . '") {');
                            $output->tabLevel++;
                        }
                        $output->addStr('/* ' . strtoupper($dbType) . ' */');
                        // $this->addStr($string, '$this->createTable(\'{{%' . $table . '}}\', [');
                        $output->addStr('$this->createTable(\'{{%' . $table_prepared . '}}\', [');
                        $output->tabLevel++;
                        // Ordinary columns
                        $k = 0;
                        foreach ($columns->columns as $column) {
                            $appUtility = new AppUtility($column, $dbType);
                            $output->addStr($appUtility->string."',");
                            if ($column->isPrimaryKey) {
                                $output->addStr($k." => 'PRIMARY KEY (`".$column->name."`)',");
                            }
                            $k++;
                        }
                        $output->tabLevel--;
                        $output->addStr('], $tableOptions);');
                        if (in_array($dbType, [ 'mysql', 'mssql', 'pgsql' ])  && !empty($columns->foreignKeys)) {
                            foreach ($columns->foreignKeys as $fk) {
                                $link_table = '';
                                foreach ($fk as $k => $v) {
                                    if ($k == '0') {
                                        $link_table = $v;
                                    }
                                    else {
                                        $link_to_column = $k;
                                        $link_column    = $v;
                                        $output->addStr(
                                            '$this->addForeignKey('.
                                                '\'fk_'.$link_table . '_' . $table . '\', '.
                                                '\'{{%' . $table . '}}\', '.
                                                '\'' . $link_to_column . '\', '.
                                                '\'{{%' . $link_table . '}}\', '.
                                                '\'' . $link_column . '\', '.
                                                '\'CASCADE\', '.
                                                '\'DELETE\' '.
                                            ');'
                                        );
                                    }
                                }
                            }
                        }
                        if ($ifThen) {
                            $output->tabLevel--;
                            $output->addStr('}');
                        }
                    }
                }
            }
            $model               = new MigrationUtility();
            $model->tables       = $tables_value;
            $model->databaseType = Yii::$app->db->driverName;

            return $this->render(
                'index',
                [
                    'model' => $model,
                    'output' => $output->output(),
                    'tables' => self::getTables()
                ]
            );
        }


        /**
         * @return \string[]
         */
        public function getTables()
        {

            return \Yii::$app->db->getSchema()->getTableNames('', TRUE);
        }

    }

    use yii\base\Object;

    /**
     * Class OutputString
     *
     * @author Nils Lindentals <nils@dfworks.lv>
     *
     * @package c006\utility\migration\controllers
     */
    class OutputString extends Object {

        /**
         * @var string
         */
        public $nw = "\n";

        /**
         * @var string
         */
        public $tab = "\t";

        /**
         * @var string
         */
        public $outputStringArray = array();

        /**
         * @var int
         */
        public $tabLevel = 0;

        /**
         * Adds string to output string array with "tab" prefix
         * @var string $str
         */
        public function addStr($str)
        {
            $str = str_replace($this->tab, '', $str);
            $this->outputStringArray[] = str_repeat($this->tab, $this->tabLevel).$str;
        }

        /**
         * Returns string output
         */
        public function output()
        {
             return implode($this->nw, $this->outputStringArray);
        }
    }
