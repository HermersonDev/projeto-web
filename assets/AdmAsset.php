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
class AdmAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/adm.css',
        'fontawesome/fontawesome.css',
    ];
    public $js = [
        'js/adm.js',
        'js/adm-jq.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'app\assets\BootstrapAsset',
        'app\assets\IconAsset',
    ];
}
