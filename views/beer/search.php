<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<title>search</title>


<div class="container">
    <div class="row">
             <div class="col-md-12 search" >
                <div class="col-md-3" >
                    <div>
                      
                       <img src="<?= $resultRand['data']['labels']['medium']?>" alt="">
                    </div>

                 </div> 
                <div class="col-md-6" >
                    <h3 class="">
                    <?= $resultRand['data']['name']?>
                    </h3>
                    <div class="lead">
                    <?= $resultRand['data']['description']?>
                    </div>

                    

                 </div> 

                 <div class="col-md-3">
                    
                 <a href="/index.php?r=site" class="btn btn-success btn-block">Anather Beer</a>
                 

                 <a href="/index.php?r=site%2Fbrewery&id=<?=$resultRand['data']['breweries'][0]['id']?>" 
            class="btn btn-primary btn-block"> <?=$resultRand['data']['breweries'][0]['id']?> More From This Breweries</a>
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


<div class="container ">


    <div class="row">
        <?php if(isset($result['data']) ):
foreach($result['data'] as $beer){ ?>


        <div class="col-md-12 search">
            <div class="col-md-3">
                       <!-- there is some beers with no image=labels -->
                <?php if(isset($beer['labels'])) { ?>

                <img src="<?=$beer['labels']['icon']; ?>" alt="">

                <?php }

// https://s3.amazonaws.com/brewerydbapi/beer/9kEqn5/upload_vxo1QT-icon.png
                else { ?>

                <img src="http://placehold.it/100x100" alt="beer" width=100 hight=100>
                <?php }?>


            </div>


            <div class="col-md-9">
                <h2>
                    <?=$beer['name']; ?>
                </h2>
                <!-- there is some beers with no descreption -->
                <?php if(isset($beer['description'])) { ?>

                <div class="lead">
                    <?=$beer['description']; ?>"
                </div>

                <?php } ?>

            </div>

        </div>


        <?php
  
}

?>


    </div>


</div>


<?php else: ?>
<div class="lead text-danger">there is no result</div>
<?php endif; ?>