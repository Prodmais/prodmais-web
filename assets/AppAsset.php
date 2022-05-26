<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
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
        'css/site.css',
        'web/custom/css/estilos.css',
        // 'web/custom/css/dev.css',
        'web/custom/css/loader-default.css',
        'web/custom/css/page-not-found.css',
        'web/custom/css/sweetalert.css',
    ];
    public $js = [
        'web/custom/js/bootbox2.js',
        'web/custom/js/yii_overrides.js',
        'web/custom/js/sweetalert.min.js',
        // 'web/custom/js/jquery-ui.js', // draggable ui
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        
    ];
}
