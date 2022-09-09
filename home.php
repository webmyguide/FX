<?php
global $int_setting_ids;

if(is_front_page() || is_home())set_transient( 'topPageType', 0 );

get_header();

//タイトルの文章を取得
$title_catchcopy_t = get_post_meta($int_setting_ids['top'],'cf_top_catchcopy_t_title',true);
$detail_catchcopy_t = get_post_meta($int_setting_ids['top'],'cf_top_catchcopy_t_detail',true);

 ?>

<div class="wrap">
    <main class="wrap__main">


        <section class="contentCatch">
            <h2 class="contentCatch__title"><div class="line_sp"><?php echo date('Y'); ?>年<?php echo date('n'); ?>月最新版</div><?php echo $title_catchcopy_t; ?></h2>
            <div class="contentCatch__detail"><?php echo apply_filters('the_content',$detail_catchcopy_t); ?></div>
        </section>



        <?php
        	if(is_front_page() || is_home() || $is_mv_top){
        		global $formSetting;
        		$formSetting  = array(
                    'isIdName' => true,
                    'formType' => 'top',
                    'is_accordion' => 'close',
                );
        		get_template_part('inc/section/inc_form');
        	}
        ?>

        <?php
          get_template_part('inc/section/inc_ranking_simple');
        ?>


        <div id="topRanking"></div>
        <?php
          get_template_part('inc/section/inc_ranking');
        ?>

        <?php
          get_template_part('inc/section/inc_cta');
        ?>

        <?php
          get_template_part('inc/section/inc_howToFind');
        ?>

        <?php
          get_template_part('inc/section/inc_productList');
        ?>

        <?php
          get_template_part('inc/section/inc_articlesList');
        ?>

        <?php
            if(is_front_page() || is_home() || $is_mv_top){
                global $formSetting;
                $formSetting  = array(
                    'isIdName' => true,
                    'formType' => 'bottom',
                    'is_accordion' => 'open',
                );
                get_template_part('inc/section/inc_form');
            }
        ?>

    </main>

</div>


<?php get_footer(); ?>
