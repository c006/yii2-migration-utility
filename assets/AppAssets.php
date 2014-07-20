<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 5/24/14
     * Time: 11:47 AM
     */
    namespace c006\utility\migration\assets;

    use yii\web\AssetBundle;
    use yii\web\View;

    /**
     * Class AppAssets
     *
     * @package c006\crud\assets
     */
    class AppAssets extends AssetBundle
    {

        /**
         * @inheritdoc
         */
        public $sourcePath = '@vendor/c006/utility/migration/assets';
        /**
         * @inheritdoc
         */
        public $css = [
            '',
        ];
        /**
         * @inheritdoc
         */
        public $js = [
            'c006-migration.js',
        ];
        /**
         * @inheritdoc
         */
        public $depends = [
            'yii\web\YiiAsset',
            'yii\widgets\ActiveFormAsset',
            'yii\bootstrap\BootstrapAsset',
        ];

        /**
         * @var array
         */
        public $jsOptions = [
            'position' => View::POS_END,
        ];

    }
