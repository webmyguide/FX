<?php
    global $int_setting_ids;
    //
    //表示させるIDの取得
    $target_id = get_post_meta($int_setting_ids['top'],'cf_top_cta_post_id',true);

    if(empty($target_id)){
        $args = array(
            'posts_per_page' => 1,
            'post_type' => 'product',
            'orderby' => 'meta_value_num',
            'order' => 'ASC',
            'meta_key' => 'sort_num',
        );
        $post_cta = get_posts($args);
        $target_id = $post_cta[0]->ID;
    }

    //タイトルの文章を取得
    $title_kw = get_post_meta($target_id,'product_cta_title',true);
    $detail_kw = get_post_meta($target_id,'product_cta_detail',true);
    $official_url = get_cushion_url($target_id);
    $thumb = wp_get_attachment_image_src(get_post_field('product_thumb',$target_id),'full');
    $name = get_the_title($target_id);

 ?>

<section class="contentCommon contentCta">
    <div class="contentCta__wrap">
        <h2 class="contentCta__title"><?php echo $title_kw;?></h2>

        <div class="contentCta__name"><?php echo $name;?></div>

        <div class="contentCta__head">
            <div class="contentCta__figure">
                <a href="<?php echo $official_url; ?>">
                    <img src="<?php echo $thumb[0]; ?>" alt="<?php echo $thumb[3]; ?>" width="<?php echo $thumb[1]; ?>" height="<?php echo $thumb[2]; ?>" class="img-r verAlign-b"/>
                </a>
            </div>

            <div class="contentCta__info">
                <div class="contentCta__detail">
                    <?php echo apply_filters('the_content',$detail_kw);?>
                </div>

                <div class="contentCta__btn">
                    <a href="<?php echo $official_url; ?>" class="btnMain">公式ページはこちら</a>
                </div>
            </div>
        </div>
    </div>
</section>
