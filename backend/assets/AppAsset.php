<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'web/sweetalert2/dist/sweetalert2.min.css',
        'web/css/site.css',
        'web/css/dataTables.bootstrap.min.css',
        'web/css/fixedColumns.bootstrap.min.css',
        'web/css/daterangepicker.css',
        'web/css/bootstrap-datepicker.min.css',
        'web/css/custom.css',
        // 'css/dark/bootstrap-dark.min.css',
        // 'css/darktheme.css',
    ];
    public $js = [
        'web/sweetalert2/dist/sweetalert2.all.min.js',
        'web/js/alert.js',
        'web/js/modal.js',
        'web/js/jquery.dataTables.min.js',
        'web/js/dataTables.fixedColumns.min.js',
        'web/js/dataTables.bootstrap.min.js',
        'web/js/moment.min.js',
        'web/js/daterangepicker.js',
        // 'https://adminlte.io/themes/AdminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js',
        'web/js/jquery.slimscroll.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
