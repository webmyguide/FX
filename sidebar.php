<?php
    $args = array(
        'posts_per_page' => 3,
        'tax_query' => array(
            array(
                'taxonomy'=> 'toplist',
                'terms'=>array( 'toppoint1'),
                'field'=>'slug',
                'include_children'=>true,
                'operator'=>'IN'
            ),
        ),
    );
    $article_posts_1 = get_posts( $args );
    $article_term_1 = get_term_by( 'slug', 'toppoint1', 'toplist' );
    $article_term_name_1 = $article_term_1->name;

    $args = array(
        'posts_per_page' => 3,
        'tax_query' => array(
            array(
                'taxonomy'=> 'toplist',
                'terms'=>array( 'toppoint2'),
                'field'=>'slug',
                'include_children'=>true,
                'operator'=>'IN'
            ),
        ),
    );
    $article_posts_2= get_posts( $args );
    $article_term_2 = get_term_by( 'slug', 'toppoint2', 'toplist' );
    $article_term_name_2 = $article_term_2->name;
?>

<div class="wrap__side">
    <aside class="contentSide">
        <?php
            $side_banner_posts = get_side_banner_posts();
            if(!empty($side_banner_posts)){
        ?>
            <div class="contentSide__items txtAli-c">
                <?php

                    foreach ($side_banner_posts as $side_banner) {
                        $cushion_url = get_cushion_url($product->ID);
                        $banner_img = wp_get_attachment_image_src(get_post_field('product_thumb_banner',$side_banner->ID),'full');
                ?>
                    <a href="<?php echo $cushion_url; ?>"><img src="<?php echo $banner_img[0]; ?>" alt="<?php echo $banner_img[3]; ?>" width="<?php echo $banner_img[1]; ?>" height="<?php echo $banner_img[2]; ?>" class="img-r verAlign-b"/></a>
                <?php } ?>
            </div>
        <?php } ?>


        <?php if(!empty($article_posts_1)){ ?>
            <div class="contentSide__items boxSide">
                <h4 class="boxSide__title"><?php echo $article_term_name_1;?></h4>
                <div class="boxSide__articles">
                    <ul class="listSideArticl">
                        <?php foreach ( $article_posts_1 as $article_1 ) { ?>
                            <?php
                                $article_img = '';
                                $article_img = wp_get_attachment_image_src(get_post_thumbnail_id( $article_1->ID ),'large');
                            ?>
                            <li class="listSideArticl__item">
                                <a href="<?php the_permalink($article_1->ID); ?>" class="listSideArticl__link">
                                    <figure class="listSideArticl__figure">
                                        <?php echo get_the_post_thumbnail( $article_1->ID, 'thumbnail', array( 'class' => 'img-r verAlign-b' ) ); ?>
                                    </figure>
                                    <div class="listSideArticl__detail">
                                        <?php echo $article_1->post_title;?>
                                    </div>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        <?php } ?>

        <?php if(!empty($article_posts_2)){ ?>
            <div class="contentSide__items boxSide">
                <h4 class="boxSide__title"><?php echo $article_term_name_2;?></h4>
                <div class="boxSide__articles">
                    <ul class="listSideArticl">
                        <?php foreach ( $article_posts_2 as $article_2 ) { ?>
                            <?php
                                $article_img = '';
                                $article_img = wp_get_attachment_image_src(get_post_thumbnail_id( $article_2->ID ),'large');
                            ?>
                            <li class="listSideArticl__item">
                                <a href="<?php the_permalink($article_2->ID); ?>" class="listSideArticl__link">
                                    <figure class="listSideArticl__figure">
                                        <?php echo get_the_post_thumbnail( $article_2->ID, 'thumbnail', array( 'class' => 'img-r verAlign-b' ) ); ?>
                                    </figure>
                                    <div class="listSideArticl__detail">
                                        <?php echo $article_2->post_title;?>
                                    </div>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        <?php } ?>


        <?php
            $side_banner_posts = get_side_banner_posts('bottom');
            if(!empty($side_banner_posts)){
        ?>
            <div class="contentSide__items  txtAli-c">
                <?php
                    foreach ($side_banner_posts as $side_banner) {
                        $cushion_url = get_cushion_url($product->ID);
                        $banner_img = wp_get_attachment_image_src(get_post_field('product_thumb_banner',$side_banner->ID),'full');
                ?>
                    <a href="<?php echo $cushion_url; ?>"><img src="<?php echo $banner_img[0]; ?>" alt="<?php echo $banner_img[3]; ?>" width="<?php echo $banner_img[1]; ?>" height="<?php echo $banner_img[2]; ?>" class="img-r"/></a>
                <?php } ?>
            </div>
        <?php } ?>


    </aside>
</div>
