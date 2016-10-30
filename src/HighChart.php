<?php

namespace iluxaar\highcharts;

use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;

/**
 * Class HighChart
 * @package iluxaar\highcharts
 */
class HighChart extends Widget
{
    /**
     * @var array
     */
    public $options = [];

    /**
     * @var array
     */
    public $clientOptions = [];

    /**
     * @var bool
     */
    public $enable3d = false;

    /**
     * @var bool
     */
    public $enableMore = false;

    /**
     * @var array
     */
    public $modules = [];

    /**
     * @var bool
     */
    public $export = false;

    /**
     * @var bool
     */
    private $_renderTo;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }
        $this->clientOptions = ArrayHelper::merge(
            [
                'exporting' => [
                    'enabled' => $this->export,
                ]
            ],
            $this->clientOptions
        );
        if (ArrayHelper::getValue($this->clientOptions, 'exporting.enabled')) {
            $this->modules[] = 'exporting.js';
        }
        $this->_renderTo = ArrayHelper::getValue($this->clientOptions, 'chart.renderTo');
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        if (empty($this->_renderTo)) {
            echo Html::tag('div', '', $this->options);
            $this->clientOptions['chart']['renderTo'] = $this->options['id'];
        }
        $this->registerClientScript();
    }

    /**
     * @inheritdoc
     */
    protected function registerClientScript()
    {
        $view = $this->getView();
        $bundle = assets\HighChartAsset::register($view);
        $id = str_replace('-', '_', $this->options['id']);
        $options = $this->clientOptions;
        if ($this->enable3d) {
            $bundle->js[] = YII_DEBUG ? 'highcharts-3d.src.js' : 'highcharts-3d.js';
        }
        if ($this->enableMore) {
            $bundle->js[] = YII_DEBUG ? 'highcharts-more.src.js' : 'highcharts-more.js';
        }
        foreach ($this->modules as $module) {
            $bundle->js[] = "modules/{$module}";
        }
        if ($theme = ArrayHelper::getValue($options, 'theme')) {
            $bundle->js[] = "themes/{$theme}.js";
        }
        $options = Json::encode($options);
        $view->registerJs("var highChart_{$id} = new Highcharts.Chart({$options});");
    }
}