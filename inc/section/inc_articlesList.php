<?php
    global $setting_articles_list;
    global $int_setting_ids;

    //テンプレートpage-indexか判定
    $temp_top = get_temp_top();

    if( is_home() || is_front_page() || $temp_top ) {
        $articles_max = 10;
    }else {
        $articles_max = 3;
    }

    if($setting_articles_list['is_archive']){
        $args = array(
            'posts_per_page' => -1,
        );
    }else {
        $args = array(
            'posts_per_page' => $articles_max,
            // 'tax_query' => array(
            //         array(
            //             'taxonomy'=> 'toplist',
            //             'terms'=>array( 'toppoint1'),
            //             'field'=>'slug',
            //             'include_children'=>true,
            //             'operator'=>'IN'
            //         ),
            // ),
        );
    }

    $articl_posts = get_posts( $args );

    //タイトルの文章を取得
    $title_kw = get_post_meta($int_setting_ids['top'],'cf_top_archive_title',true);
?>


<section class="contentCommon contentArticles">
    <div class="contentArticles__wrap">
        <h2 class="contentArticles__title"><div><?php echo $title_kw;?></div></h2>

        <!-- <?php if(!$setting_articles_list['is_archive']){
            //title
            view_title_common($title_kw);
        }else {
            //title
            view_title_common('記事一覧','h1');
        } ?> -->

        <div class="contentArticles__list">
            <?php foreach ( $articl_posts as $keyPage => $articl ) { ?>
                <article class="articlesBlog">
                    <div class="articlesBlog__lead">
                        <div class="articlesBlog__title">
                            <?php echo $articl->post_title;?>
                        </div>
                        <div class="articlesBlog__detail">
                            <?php
                                $articl_content = $articl->post_content;
                                $articl_content = wp_strip_all_tags( $articl_content );
                                $articl_content = strip_shortcodes( $articl_content );
                                echo mb_substr($articl_content, 0, 80).'……';
                            ?>
                        </div>
                    </div>
                    <div class="articlesBlog__more"><a href="<?php the_permalink($articl->ID); ?>" class="btnSub btnMore">もっと見る</a></div>
                </article>
            <?php } ?>
        </div>
    </div>
</section>
