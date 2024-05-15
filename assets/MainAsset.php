<?php
namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main layout asset bundle.
 *
 * @author Fahmi Auliya Tsani <fahmi.auliya.tsani@gmail.com>
 */
class MainAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = ['https://cdn.jsdelivr.net/npm/sweetalert2@11'];
    public $depends = [
        'app\assets\AppAsset',
        'yii\web\JqueryAsset'
    ];
}
