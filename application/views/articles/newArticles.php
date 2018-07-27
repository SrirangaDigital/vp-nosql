<?php $data = json_decode($data, true);?>

<div class="container dynamic-page">
      <div class="row justify-content-center">
            <div class="col-md-12 gap-above-med">
                  <h1><?=$data['pageTitle']?></h1>
            </div>
      </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row">
            	<div class="col-md-5 mainArticle">
                        <?= $viewHelper->displayArticles($data['articles'], 1)?>
                  </div>
                  <div class="col-md-3 subArticle">
                        <?= $viewHelper->displayArticles($data['articles'], 2)?>
                  </div>
            	<div class="col-md-4 cardArticle">
                        <?= $viewHelper->displayArticles($data['articles'], 3)?>
            	</div>
            </div>
        </div>
    </div>
    <div class="gap-above">&nbsp;</div>
</div>