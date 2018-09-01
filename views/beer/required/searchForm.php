<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>




<?php $form = ActiveForm::begin(['action' => Yii::$app->urlManager->createUrl(['beer/search']),'method' => 'get']); ?>

<?= $form->field($model, 'search')->textInput(['placeholder' => 'Search'])->label('Search') ;
   
    // $model->select = 'beer'; 
    echo $form->field($model, 'select')->radioList( ['beer'=>'beers', 'brewery' => 'breweries'] )
    ->label(false,['class'=>'label-class']);
   ?>

<div class="form-group">
    <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>