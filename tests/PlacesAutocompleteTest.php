<?php

namespace nevermnd\places\tests;

use nevermnd\places\tests\models\Model;

/**
 * Class PlacesAutocompleteTest
 *
 * @author Thiago Oliveira <thiago.oliveira.gt14@gmail.com>
 */
class PlacesAutocompleteTest extends \PHPUnit_Framework_TestCase
{
    public function testWidget()
    {
        \Yii::setAlias('@bower', __DIR__ . '/../vendor/bower-asset');

        $view = \Yii::$app->getView();
        $model = new Model();
        $content = $view->render('//test', compact('model'));
        $actual = $view->render('//layouts/main', compact('content'));
        $expected = file_get_contents(__DIR__ . '/data/test.bin');

        $this->assertEquals($expected, $actual);
    }
}