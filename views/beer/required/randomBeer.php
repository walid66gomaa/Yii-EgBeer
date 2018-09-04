<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\ActiveForm;
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12 random">
                <div class="col-md-3">
                    <div>

                        <img src="<?= $resultRand['data']['labels']['medium']?>"
                        alt="">
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

                            <a href="/index.php?r=beer" class="btn btn-success
                                btn-block">Anather Beer</a>
                            <?php echo Html::a('<b>More About This Brewery</b>',
                            ['beer/brewery', 'id' =>$resultRand['data']['breweries'][0]['id'],'beerId'=>$resultRand['data']['id']],
                            ['class' => 'btn btn-primary btn-block']) ?>



                        </div>

                    </div>
                </div>

            </div>