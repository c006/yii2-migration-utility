<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 6/7/14
     * Time: 7:24 PM
     */
    namespace c006\utility\migration;

    /**
     * Class Module
     *
     * @package c006\utility\migration
     */
    class Module extends \yii\base\Module
    {

        /**
         *
         */
        const VERSION = '0.0.1-dev';

        /**
         * @var string
         */
        public $controllerNamespace = 'c006\utility\migration\controllers';


        /**
         *
         */
        public function init()
        {

            parent::init();
        }


        /**
         * Override createController()
         *
         * @link https://github.com/yiisoft/yii2/issues/810
         * @link http://www.yiiframework.com/forum/index.php/topic/21884-module-and-url-management/
         */
        public function createController($route)
        {

            preg_match('/(default)/', $route, $match);
            if ( isset($match[0]) )
                return parent::createController($route);

            return parent::createController("{$this->defaultRoute}/{$route}");
        }

    }