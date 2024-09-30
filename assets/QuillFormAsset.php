<?php
namespace app\assets;

use yii\web\AssetBundle;

/**
 * Quill jS asset bundle.
 *
 * @author Fahmi Auliya Tsani <fahmi.auliya.tsani@gmail.com>
 */
class QuillFormAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = ['https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css'];
    public $js = ['https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js'];
    public $depends = ['app\assets\MainAsset'];
}
