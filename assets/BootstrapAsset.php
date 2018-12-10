<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class BootstrapAsset extends AssetBundle
{
    public $basePath = '@webroot/bootstrap-4';
    public $baseUrl = '@web/bootstrap-4';
    public $css = [
        'css/bootstrap.min.css',
    ];
    public $js = [
        'js/jquery-3.3.1.slim.min.js',
        'js/popper.min.js',
        'js/bootstrap.min.js',
    ];
}
