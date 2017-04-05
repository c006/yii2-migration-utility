<?php

namespace c006\preferences\migrations;

use Yii;
use yii\db\Migration;

class m000000_000000_c006_testing extends Migration
{

    /**
     *  ~ Console command ~
     *
     * php yii migrate --migrationPath=@vendor/c006/yii2-prefs/migrations
     *
     */

    /**
     *
     */
    public function up()
    {

        self::down();

        $tables = Yii::$app->db->schema->getTableNames();
        $dbType = $this->db->driverName;
        $tableOptions_mysql = "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB";
        $tableOptions_mssql = "";
        $tableOptions_pgsql = "";
        $tableOptions_sqlite = "";
        /* MYSQL */
        if (!in_array(Yii::$app->db->tablePrefix.'new_table_2', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%new_table_2}}', [
                    'id' => 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT',
                    'column_varchar' => 'VARCHAR(200) NULL',
                    'column_char' => 'CHAR(3) NULL',
                    'column_tinyint' => 'TINYINT(1) NULL',
                    4 => 'PRIMARY KEY (`id`)',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array(Yii::$app->db->tablePrefix.'new_table', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%new_table}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    'id2' => 'INT(11) NOT NULL',
                    'column1' => 'VARCHAR(100) NULL',
                    'column2' => 'CHAR(3) NOT NULL',
                    4 => 'PRIMARY KEY (`id`,`id2`)',
                ], $tableOptions_mysql);
            }
        }


        $this->execute('SET foreign_key_checks = 0');
        $this->insert('{{%new_table_2}}',['id'=>'1','column_varchar'=>'A','column_char'=>'B','column_tinyint'=>'1']);
        $this->insert('{{%new_table_2}}',['id'=>'2','column_varchar'=>'AA','column_char'=>'BB','column_tinyint'=>'0']);
        $this->insert('{{%new_table}}',['id'=>'1','id2'=>'0','column1'=>'A','column2'=>'bbb']);
        $this->insert('{{%new_table}}',['id'=>'2','id2'=>'1','column1'=>'b','column2'=>'ccc']);
        $this->execute('SET foreign_key_checks = 1;');

    }

    /**
     *
     */
    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `new_table_2`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `new_table`');
        $this->execute('SET foreign_key_checks = 1;');
    }

}