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
     * @inheritdoc
     */
    public function run()
    {
        $view = $this->getView();
        PlacesPluginAsset::register($view);

        $typeAhead = ArrayHelper::merge(['displayKey' => 'description'], $this->typeaheadOptions);
        $typeAhead['source'] = new JsExpression('new AddressPicker(' . Json::encode($this->pluginOptions) . ').ttAdapter()');

        $view->registerJs("$('#{$this->options['id']}').typeahead(null, " . Json::encode($typeAhead) . ");");

        return $this->renderInput();
    }

    /**
     * Render the input
     *
     * @return string
     */
    protected function renderInput()
    {
        if ($this->hasModel()) {
            return Html::activeTextInput($this->model, $this->attribute, $this->options);
        } else {
            return Html::textInput($this->name, $this->value, $this->options);
        }
    }
}