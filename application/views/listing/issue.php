<?php $data = json_decode($data,true); ?>

<div class="container dynamic-page">
    <div class="row">
        <div class="col-md-8">
            <div class="row mb-5">
                <div class="col-md-12">
                    <p class="vol-title text-center">ಸಂಪುಟಗಳು</p>
                </div>
<?php foreach($data['values'] as $volume) {?>
        <?php 
            echo '<div class="col-md-2 col-lg-2 col-xl-2 col-xs-1 mt-3">';
            echo '<div class="text-center">';
            echo '<a href="' . BASE_URL . 'listing/distinct/issue&volume='. $volume['item'] .'">' . '<img src="' . PUBLIC_URL . 'images/coverpages/'  . $volume['item'] . '.gif" alt="Volume: '. $volume['item'] .'" /></a><br />';
            echo '<span class="vol-caption">ಸಂಪುಟ ' . intval($volume['item']) . '</span>'; 
            echo '</div>';
            echo '</div>';
        ?>
<?php } ?>
            </div>
        </div>        
    </div>
</div>
