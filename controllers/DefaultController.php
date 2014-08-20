<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 6/7/14
     * Time: 2:43 PM
     */
    namespace c006\utility\migration\controllers;

    use c006\utility\migration\assets\AppAssets;
    use c006\utility\migration\assets\AppUtility;
    use c006\utility\migration\models\MigrationUtility;
    use yii\web\Controller;
    use Yii;

    /**
     * Class DefaultController
     *
     * @package c006\utility\migration\controllers
     */
    class DefaultController extends Controller
    {
        /**
         * @var string
         */
        private $Nw = "\n";
        /**
         * @var string
         */
        private $Tab = "\t";


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

            $string = $tables_value = '';
            if ( isset($_POST['MigrationUtility']) ) {
                $tables_value = $_POST['MigrationUtility']['tables'];
                $databaseType = $_POST['MigrationUtility']['databaseType'];
                $ifThen       = $_POST['MigrationUtility']['addIfThenStatements'];
                $tableOptions=$_POST['MigrationUtility']['tableOptions'];
                $tables       = explode(',', str_replace(' ', '', $tables_value));
                foreach ($tables as $table) {
                    $columns        = \Yii::$app->db->getTableSchema($table);
                    $prefix         = \Yii::$app->db->tablePrefix;
                    $table_prepared = str_replace($prefix, '', $table);
                    foreach ($databaseType as $dbType) {
                        $string.='$tableOptions="'.$tableOptions.'";'.$this->Nw;
                        if ( $ifThen )
                            $string .= $this->Nw . 'if ($dbType == "' . $dbType . '") {';
                        $string .= $this->Nw . '/* ' . strtoupper($dbType) . ' */';
                        //                        $string .= $this->Nw . '$this->createTable(\'{{%' . $table . '}}\', [' . $this->Nw;
                        $string .= $this->Nw . '$this->createTable(\'{{%' . $table_prepared . '}}\', [' . $this->Nw;
                        $primary_string = "";
                        foreach ($columns->columns as $column) {
                            $appUtility = new AppUtility($column, $dbType);
                            $string .= $appUtility->string;
                            $primary_string .= ($column->isPrimaryKey) ? $this->Tab . '0 => \'PRIMARY KEY (`' . $column->name . '`)\'' : '';
                            $string .= "'," . $this->Nw;
                        }
                        $string .= $primary_string . $this->Nw;
                        $string .= '], $tableOptions);';
                        if ( in_array($dbType, [ 'mysql', 'mssql', 'pgsql' ]) ) {
                            foreach ($columns->foreignKeys as $fk) {
                                $link_to_column = $link_column = $link_table = '';
                                foreach ($fk as $k => $v) {
                                    if ( $k == "0" )
                                        $link_table = $v;
                                    else {
                                        $link_to_column = $k;
                                        $link_column    = $v;
                                    }
                                }
                                $string .= $this->Nw . '$this->addForeignKey(\'fk_' . $link_table . '_' . $table . '\', \'{{%' . $table . '}}\', \'' . $link_to_column . '\', \'{{%' . $link_table . '}}\', \'' . $link_column . '\', \'CASCADE\', \'DELETE\');' . $this->Nw;
                            }
                        }
                        if ( $ifThen )
                            $string .= $this->Nw . '}';
                        $string .= $this->Nw;
                    }
                }
            }
            $model               = new MigrationUtility();
            $model->tables       = $tables_value;
            $model->databaseType = Yii::$app->db->driverName;

            return $this->render('index', [ 'model' => $model, 'output' => $string, 'tables' => self::getTables() ]);
        }


        /**
         * @return \string[]
         */
        public function getTables()
        {

            return \Yii::$app->db->getSchema()->getTableNames('', TRUE);
        }

    }
