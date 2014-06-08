<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 6/7/14
     * Time: 2:43 PM
     */
    namespace c006\utility\migration\controllers;

    use c006\utility\migration\models\MigrationUtility;
    use yii\web\Controller;

    /**
     * Class UtilityController
     *
     * @package app\controllers
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
         * @return string
         */
        public function actionIndex()
        {

            $string = $tables_value = '';
            if ( isset($_POST['MigrationUtility']) ) {
                $tables_value = $_POST['MigrationUtility']['tables'];
                $tables       = explode(',', str_replace(' ', '', $tables_value));
                foreach ($tables as $table) {
                    $columns = \Yii::$app->db->getTableSchema($table);
                    $string .= $this->Nw . $this->Nw . '$this->createTable(\'{{%' . $table . '}}\', [' . $this->Nw;
                    $primary_string = "";
                    foreach ($columns->columns as $column) {
                        $string .= $this->Tab . "'{$column->name}' => '" . strtoupper($column->dbType) . "";
                        $string .= ($column->unsigned) ? ' UNSIGNED' : '';
                        $string .= ($column->allowNull) ? ' NULL' : ' NOT NULL';
                        $string .= ($column->autoIncrement) ? ' AUTO_INCREMENT' : '';
                        $string .= (empty($column->defaultValue)) ? ' ' : " DEFAULT '{$column->defaultValue}'";
                        $primary_string .= ($column->isPrimaryKey) ? '$this->addPrimaryKey(\'' . $column->name . '\', \'{{%' . $table . '}}\',\'' . $column->name . '\' );' . $this->Nw : '';
                        $string .= "'," . $this->Nw;
                    }
                    $string .= ']);';
                    $string .= $this->Nw . $primary_string . $this->Nw;
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
                        $string .= '$this->addForeignKey(\'fk_' . $link_table . '_' . $table . '\', \'{{%' . $table . '}}\', \'' . $link_to_column . '\', \'{{%' . $link_table . '}}\', \'' . $link_column . '\', \'CASCADE\', \'DELETE\');' . $this->Nw;
                    }

                }
            }
            $model         = new MigrationUtility();
            $model->tables = $tables_value;

            return $this->render('index', [ 'model' => $model, 'output' => $string ]);
        }

    }