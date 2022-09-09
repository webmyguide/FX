<?php get_header();  ?>


<div class="wrap">
    <main class="wrap__main">
        <?php if( get_post_type() == 'product' ){ ?>
            <section class="contentCommon">
                <?php
                    //title
                    global $int_setting_ids;
                    $title_kw = get_post_meta($int_setting_ids['top'],'cf_top_comparison_title',true);
                    $detail_kw = get_post_meta($int_setting_ids['top'],'cf_top_comparison_detail',true);
                    view_title_common($title_kw,'h1');
                ?>
                <?php if( !empty($detail_kw) ){ ?>
                    <div class="contentCommon__catch">
                        <?php echo apply_filters('the_content',$detail_kw); ?>
                    </div>
                <?php } ?>

                <div class="boxSort">
                    <?php
                      get_template_part('inc/box/inc_sort');
                    ?>
                </div>
                <div data-sort-content="true">
                    <?php view_product_archive(); ?>
                </div>

                <?php
                  get_template_part('inc/box/inc_boxFindTips');
                ?>
            </section>
        <?php }elseif (get_post_type() == 'word-mouth') { ?>
            <section class="contentCommon">
                <?php
                    //title
                    view_title_common('口コミ一覧','h1');
                ?>

                <?php get_template_part('inc/section/inc_wordMouthArchive'); ?>

            </section>
        <?php }else { ?>
            <section class="contentSingle">
                <div class="contentSingle__wrap">
                    <h1><?php the_title(); ?></h1>
                    <div>
                        <?php the_content(); ?>
                    </div>
                </div>
            </section>
        <?php }  ?>
    </main>

</div>


<?php get_footer(); ?>
