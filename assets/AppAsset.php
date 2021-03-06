<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
	    'css/screen.css',
//	    'css/print.css',
//	    'css/ie.css',
//	    'css/main.css',
//	    'css/form.css',
	    'bootstrap/css/styles.css',
	    'css/bs_css/bootstrap.min.css',
	    'css/dd.css'
    ];

	public $js = [
		'js/googleAnalistic.js',
		'js/customJs.js',
		'js/jquery.dd.js',
		'js/bs_js/bootstrap.js'

	];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
