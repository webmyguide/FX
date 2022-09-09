<?php get_header();  ?>

<?php get_header();  ?>



<?php if ( is_page('privacy') ) { ?>
    <?php get_template_part('inc/page/inc_privacy'); ?>
<?php }else if( is_page('ranking_research') ){ ?>
    <?php get_template_part('inc/page/inc_research'); ?>
<?php }else if( is_page('company') ){ ?>
    <?php get_template_part('inc/page/inc_company'); ?>
<?php }else if( is_page('contact') || is_page('confirm') || is_page('thanks') || is_page('error') ){ ?>
    <?php get_template_part('inc/page/inc_contact'); ?>

<?php }else{ ?>
    <div class="wrap">
        <main class="wrap__main">
            <?php if( get_the_ID() == 88 ){ ?>
                <?php
                    global $setting_articles_list;

                    $setting_articles_list = array(
                        'is_archive' => true,
                    );

                    get_template_part('inc/section/inc_articlesList');
                ?>
            <?php }else{ ?>
        		<section class="contentCommon">
                    <?php
                        //title
                        $post_title = get_the_title();
                        view_title_common($post_title,'h1');
                    ?>
                    <div class="boxCommon borCommon">
        				<?php echo apply_filters('the_content',$post->post_content); ?>
                    </div>
        		</section>
            <?php } ?>
        </main>
    </div>
<?php } ?>


<?php get_footer(); ?>
