<?php

namespace nevermnd\places;

use yii\web\AssetBundle;

/**
 * Class PlacesAsset
 *
 * @author Thiago Oliveira <thiago.oliveira.gt14@gmail.com>
 */
class TypeAheadAsset extends AssetBundle
{
    public $sourcePath = '@bower/typeahead.js/dist';
    public $js = [
        'typeahead.bundle.js',
    ];
    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset'
    ];
}