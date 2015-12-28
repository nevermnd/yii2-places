<?php

namespace nevermnd\places;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\JsExpression;
use yii\widgets\InputWidget;

/**
 * Class PlacesAutocomplete
 *
 * @author Thiago Oliveira <thiago.oliveira.gt14@gmail.com>
 */
class PlacesAutocomplete extends InputWidget
{
    /**
     * @var array Autocomplete plugin options
     */
    public $pluginOptions = [];
    /**
     * @var array TypeAhead options
     */
    public $typeaheadOptions = [];
    /**
     * @var array Default typeahead options
     */
    protected $defaultOptions = [
        'displayKey' => 'description'
    ];

    /**
     * @inheritdoc
     */
    public function run()
    {
        $view = $this->getView();
        PlacesPluginAsset::register($view);

        $options = !empty($this->pluginOptions) ? Json::encode($this->pluginOptions) : '{}';
        $typeAhead = ArrayHelper::merge($this->defaultOptions, $this->typeaheadOptions);
        $typeAhead['source'] = new JsExpression("new AddressPicker($options).ttAdapter()");

        $view->registerJs("$('#{$this->options['id']}').typeahead(null, " . Json::encode($typeAhead) . ");");

        return $this->hasModel()
            ? Html::activeTextInput($this->model, $this->attribute, $this->options)
            : Html::textInput($this->name, $this->value, $this->options);
    }
}