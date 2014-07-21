<?php

    namespace c006\utility\migration\models;

    use yii\base\Model;

    /**
     * Class MigrationUtility
     *
     * @package c006\utility\migration\models
     */
    class MigrationUtility extends Model
    {

        /**
         * @var string
         */
        public $tables = '';
        /**
         * @var string
         */
        public $databaseType = '';

        /**
         * @var array
         */
        public $databaseTables = [ ];

        /**
         * @var bool
         */
        public $addIfThenStatements = TRUE;


        /**
         * @return array
         */
        function rules()
        {

            return [
                [ [ 'tables', 'databaseTables', 'databaseType' ], 'required' ],
            ];
        }



    }