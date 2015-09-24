<?php
namespace c006\utility\migration\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Class DefaultAsset
 *
 * @package c006\utility\migration\assets
 */
class DefaultAsset extends AssetBundle
{

    /**
     * @inheritdoc
     */
    public $sourcePath = '@vendor/c006/yii2-migration-utility/assets';

    /**
     * @inheritdoc
     */
    public $css = [
       'default.css'
    ];

    /**
     * @inheritdoc
     */
    public $js = [
       'default.js'
    ];

    /**
     * @inheritdoc
     */
    public $depends = [
        '\yii\web\JqueryAsset'
    ];

    /**
     * @var array
     */
    public $jsOptions = [
        'position' => View::POS_END,
    ];
    /**
     * @var array
     */
    public $cssOptions = [
        'position' => View::POS_BEGIN,
    ];

}
