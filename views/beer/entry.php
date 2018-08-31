<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>

<div class="container">
    <div class="row">
        <div class="col-md-12 search">
            <div class="col-md-3">
                <div>

                    <img src="<?= $resultRand['data']['labels']['medium']?>" alt="">
                </div>

            </div>
            <div class="col-md-6">
                <h3 class="">
                    <?= $resultRand['data']['name']?>
                </h3>
                <div class="lead">
                    <?= $resultRand['data']['description']?>
                </div>



            </div>

            <div class="col-md-3">

                <a href="/index.php?r=beer" class="btn btn-success btn-block">Anather Beer</a>


                <a href="/index.php?r=beer%2Fbrewery&id=<?=$resultRand['data']['breweries'][0]['id']?>" class="btn btn-primary btn-block">
                    <?=$resultRand['data']['breweries'][0]['id']?> More From This Breweries</a>
            </div>

        </div>
    </div>

</div>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'search')->textInput(['placeholder' => 'Search'])->label('Search') ;
    if ($model->select!='brewerie') {
       $model->select = 'beer'; 
    }
   
    echo $form->field($model, 'select')->radioList( ['beer'=>'beers', 'brewerie' => 'breweries'] )
    ->label(false,['class'=>'label-class']);
   ?>

<div class="form-group">
    <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>