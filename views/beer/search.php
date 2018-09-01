<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<title>search</title>



<?php

require ('required/randomBeer.php');  //display random beer here
require ('required/searchForm.php');  //display search form here
?>


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
                    <?php
                    if(strlen($beer['description'])>=150)
                    {
                        echo substr($beer['description'],0,150).'...';
                    }
                    else
                    {
                        echo $beer['description'];
                    }


                    
                    ?>
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