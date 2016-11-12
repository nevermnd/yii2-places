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
    const PLUGIN_NAME = 'addressPicker';
    /**
     * @var int Widgets counter
     */
    protected static $widgetCounter = 0;
    /**
     * @var array Autocomplete plugin options
     */
    public $pluginOptions = [];
    /**
     * @var array TypeAhead options
     */
    public $typeaheadOptions = [];
    /**
     * @var JsExpression|string On select plugin event handler
     */
    public $onSelect;
    /**
     * @var array Default typeahead options
     */
    protected $defaultOptions = ['displayKey' => 'description'];
    /**
     * @var string Adapter variable name
     */
    protected $varName = '';

    /**
     * @inheritdoc
     */
    public function run()
    {
        $view = $this->getView();

        $options = $this->encodeOptions();
        $this->varName = $this->generateVarName($options);
        $script = implode("\n", [$this->buildAdapter($options), $this->buildTypeAhead(), $this->buildEvent()]);

        Html::addCssClass($this->options, 'typeahead');
        PlacesPluginAsset::register($view);
        $view->registerJs($script);

        if ($this->hasModel()) {
            return Html::activeTextInput($this->model, $this->attribute, $this->options);
        } else {
            return Html::textInput($this->name, $this->value, $this->options);
        }
    }

    /**
     * Build the required adapter JS
     *
     * @param string $options JSON encoded options
     *
     * @return string
     */
    protected function buildAdapter($options)
    {
        return "var $this->varName = new AddressPicker($options);";
    }

    /**
     * Encode the plugin options into a JSON string
     *
     * @return string
     */
    protected function encodeOptions()
    {
        return !empty($this->pluginOptions) ? Json::encode($this->pluginOptions) : '{}';
    }

    /**
     * Build the required plugin event JS
     *
     * @return string
     */
    protected function buildEvent()
    {
        $script = '';
        if ($this->onSelect) {
            $event = $this->onSelect instanceof JsExpression ? $this->onSelect : new JsExpression($this->onSelect);
            $script .= "$this->varName.bindDefaultTypeaheadEvent($('#{$this->options['id']}'));\n";
            $script .= "$($this->varName).on('addresspicker:selected', $event);";
        }

        return $script;
    }

    /**
     * Build the typeahead initialization JS code
     *
     * @return string
     */
    protected function buildTypeAhead()
    {
        $options = ArrayHelper::merge($this->defaultOptions, $this->typeaheadOptions);
        $options['source'] = new JsExpression("$this->varName.ttAdapter()");

        return "$('#{$this->options['id']}').typeahead(null, " . Json::encode($options) . ");";
    }

    /**
     * Generates an unique variable name
     *
     * @param string $options
     *
     * @return string
     */
    protected function generateVarName($options)
    {
        return self::PLUGIN_NAME . '_' . hash('crc32', $options . static::$widgetCounter++);
    }
}