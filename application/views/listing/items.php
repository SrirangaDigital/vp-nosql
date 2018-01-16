<?php $data = json_decode($data, true);?>

<div class="container dynamic-page">
    <div class="row">
        <div class="col-md-12 mainpage">
            <h1><?=$data['pageTitle']?></h1>
<?php if(isset($data['alphabet'])) {?>
            
            <p class="alphabet">    
    <?php foreach ($data['alphabet'] as $letter) { ?>

                <a class="letter" href="<?=BASE_URL?>listing/authors/<?=$letter?>"><?=$letter?></a>
    <?php } ?>
            </p>

<?php } ?>
<?php if(isset($data['subTitle'])) {?>
            <h5 class="text-right"><?= sizeof($data['values'])?> <?=$data['subTitle']?></h5>
<?php } ?>
<?php foreach ($data['values'] as $row) { ?>
    
            <div class="full-width-card red-edge">
    <?php if(isset($row['item'])) { ?>
                <h3 class="author"><a href="<?=$data['nextUrl']?><?=$row['item']?>"><?=$row['item']?></a></h3>
    <?php } ?>
            </div>
<?php } ?>
        </div>
    </div>
</div>
