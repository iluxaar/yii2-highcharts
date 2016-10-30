Yii2 Highcharts
===============
Yii2 Highcharts

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist iluxaar/yii2-highcharts "*"
```

or add

```
"iluxaar/yii2-highcharts": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by:

```php
<?=
\iluxaar\highcharts\HighChart::widget([
    'clientOptions' => [
        'chart' => [
            'type' => 'column',
        ],
        'title' => [
            'text' => 'Monthly Average Rainfall',
        ],
        'subtitle' => [
            'text' => 'Source: WorldClimate.com',
        ],
        'yAxis' => [
            'title' => [
                'text' => 'Rainfall (mm)',
            ],
        ],
        'xAxis' => [
            'categories' => ['Jan', 'Feb', 'Mar'],
        ],
        'series' => [
            ['name' => 'Tokyo', 'data' => [49.9, 71.5, 106.4]],
            ['name' => 'New York', 'data' => [83.6, 78.8, 98.5]],
            ['name' => 'London', 'data' => [48.9, 38.8, 39.3]],
        ],
    ],
]);
?>
```