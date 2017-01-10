# yii2-places-autocomplete

###This extension is now deprecated, v1.0.5 is the last release!
Mainly because Typeahead Address Picker hasn't been updated in some time and Google Places now requires API keys.


[![Build Status](https://travis-ci.org/skiptirengu/yii2-places.svg?branch=master)](https://travis-ci.org/skiptirengu/yii2-places)

This is an Yii2 wrapper for the [Typeahead Address Picker](https://github.com/sgruhier/typeahead-addresspicker) JS plugin.

## Installation
The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```bash
$ composer require nevermnd/yii2-places:^1.0
```

or add

```
"nevermnd/yii2-places": "^1.0"
```

to the `require` section of your `composer.json` file.

## Usage
With a model:
```php
<?php
echo $form->field($model, 'place')
          ->widget(PlacesAutocomplete::className());
?>
```
Without a model:

```php
<?php
echo PlacesAutocomplete::widget(['name' => 'place']);
?>
```
