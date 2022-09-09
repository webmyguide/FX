<?php get_header();  ?>



<?php if( get_post_type() == 'product' ){ ?>
    <?php get_template_part('inc/section/inc_productDetail'); ?>
    <?php
      get_template_part('inc/section/inc_articlesList');
    ?>
    <?php
        global $formSetting;
        $formSetting  = array(
            'isIdName' => true,
            'formType' => 'bottom',
            'is_accordion' => 'open',
        );
        get_template_part('inc/section/inc_form');
    ?>
<?php }elseif( get_post_type() == 'ranking' ) { ?>
    <?php
        global $page_title;
        $page_title = get_the_title();
        get_template_part('inc/section/inc_ranking');
    ?>
<?php }else { ?>
    <?php get_template_part('inc/page/inc_single'); ?>
    </section>
<?php }  ?>

<?php get_footer(); ?>
