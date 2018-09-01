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
                     More From This Breweries</a>
            </div>

        </div>
    </div>

</div>