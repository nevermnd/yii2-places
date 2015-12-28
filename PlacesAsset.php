<?php

namespace nevermnd\places;

use yii\web\AssetBundle;

/**
 * Class TypeAheadAsset
 *
 * @author Thiago Oliveira <thiago.oliveira.gt14@gmail.com>
 */
class PlacesAsset extends AssetBundle
{
    public $css = [
        'places.css'
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = __DIR__ . '/assets';
        parent::init();
    }
}