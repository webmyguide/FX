<?php
    global $int_setting_ids;

    //案件IDの取得
    $product_id = get_post_meta($int_setting_ids['top'],'cf_top_pickup_id',true);
    if(empty($product_id))return false;

    //タイトルの文章を取得
    $title_kw = get_post_meta($product_id,'product_pickup_title',true);


    $product = get_post($product_id);

    //公式サイト
    $official_url = get_cushion_url($product_id);

 ?>



<section class="contentCommon">
    <?php
        //title
        view_title_common($title_kw);
    ?>

    <?php echo view_product($product,array('page_pickup'=>1,'ranking'=>1)); ?>


</section>
