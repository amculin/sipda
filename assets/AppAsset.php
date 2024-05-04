<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/tabler.min.css',
        'css/custom.css',
        'css/login.css',
        'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css',
        'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css'
    ];
    public $js = [
        'js/tabler.min.js',
        'js/app.js',
        'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap5\BootstrapAsset'
    ];
}
