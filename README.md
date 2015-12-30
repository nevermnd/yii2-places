# yii2-places-autocomplete
[![Build Status](https://travis-ci.org/nevermnd/yii2-places.svg?branch=master)](https://travis-ci.org/nevermnd/yii2-places)

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
