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
         * @return array
         */
        function rules()
        {

            return [
                [ [ 'tables' ], 'required' ],
            ];
        }

    }