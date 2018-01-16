<?php $data = json_decode($data, true);?>

<div class="container dynamic-page">
    <div class="row">
        <div class="col-md-12 mainpage">
            <h1><?=$data['pageTitle']?></h1>
<?php if(isset($data['alphabet'])) {?>
            
            <p class="alphabet">    
    <?php foreach ($data['alphabet'] as $letter) { ?>

                <a class="letter" href="<?=BASE_URL?>articles/all/<?=$letter?>"><?=$letter?></a>
    <?php } ?>
            </p>

<?php } ?>
            <h5 class="text-right"><?= $viewHelper->roman2Kannada(sizeof($data['articles']))?> <?=ARTICLES?></h5>
<?php foreach ($data['articles'] as $article) { ?>
    
            <div class="full-width-card blue-edge">
                <h4 class="publication-details">
                    <span class="red"><a href="<?=BASE_URL?>articles/category/feature/<?=$article['feature']?>"><?=(isset($article['feature'])) ? $article['feature'] : ''?></a></span>
                    <span class="brown"><a href="<?=BASE_URL?>articles/category/series/<?=$article['series']?>"><?=(isset($article['series'])) ? $article['series'] : ''?></a></span>
                    <span class="gray"><a href="<?=BASE_URL?>articles/toc?volume=<?=$article['volume']?>&issue=<?=$article['issue']?>"><?=$viewHelper->kannadaMonth($article['month'])?>, <?=$viewHelper->roman2Kannada($article['year'])?> (<?=ARCHIVE_VOLUME?> <?=$viewHelper->roman2Kannada($viewHelper->rlZero($article['volume']))?>, <?=ARCHIVE_ISSUE?> <?=$viewHelper->roman2Kannada($viewHelper->rlZero($article['issue']))?>)</a></span>
                </h4>
                <h2 class="title">
                    <a target="_blank" href="#" class="pdf"><?=$article['title']?></a>
                </h2>
    <?php if(isset($article['author'])) { ?>
                <h3 class="author by">
        <?php foreach($article['author'] as $author) { ?>
                    <span><a href="<?=BASE_URL?>articles/author/<?=$author['name']?>"><?=$author['name']?></a></span>
        <?php } ?>
                </h3>
    <?php } ?>
            </div>
<?php } ?>

        </div>
    </div>
</div>
