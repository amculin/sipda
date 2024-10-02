<?php
namespace app\assets;

use yii\web\AssetBundle;

/**
 * Highchart asset bundle.
 *
 * @author Fahmi Auliya Tsani <fahmi.auliya.tsani@gmail.com>
 */
class HighchartAsset extends AssetBundle
{
    const BASE_URL = 'https://code.highcharts.com/';

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
        'https://code.highcharts.com/highcharts.js',
        'https://code.highcharts.com/modules/exporting.js',
        'https://code.highcharts.com/modules/export-data.js',
        'https://code.highcharts.com/modules/accessibility.js',
    ];
    public $depends = ['app\assets\MainAsset'];
}
