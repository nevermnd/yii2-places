<?=
\nevermnd\places\PlacesAutocomplete::widget([
    'model'     => $model,
    'attribute' => 'place'
])
?>

<?=
\nevermnd\places\PlacesAutocomplete::widget([
    'name' => 'place'
])
?>

<?=
\nevermnd\places\PlacesAutocomplete::widget([
    'name'             => 'place',
    'pluginOptions'    => [
        'displayKey' => 'test'
    ],
    'typeaheadOptions' => [
        'minLength' => 1
    ]
])
?>
