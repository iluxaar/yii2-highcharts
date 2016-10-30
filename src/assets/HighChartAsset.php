<?php

namespace iluxaar\highcharts\assets;

use yii\web\AssetBundle;

/**
 * Class HighChartAsset
 * @package iluxaar\highcharts\assets
 */
class HighChartAsset extends AssetBundle
{
    public $sourcePath = '@vendor/bower/highcharts-release/';
    public $js = [
        YII_DEBUG ? 'highcharts.src.js' : 'highcharts.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}