<?php
    global $formSetting;
    global $int_setting_ids;
    //
    $formType = '';
    if( isset($formSetting['formType']) ){
        $formType = '-'.$formSetting['formType'];
    }

    //ステップアップフォーム有無
    $sutepForm = get_post_field('cff_stepup_enable',2);
    $sutepTopOnly = get_post_field('cff_stepup_only',2);

    if($formType && $sutepTopOnly) $sutepForm = false;



    //GETでキーワードを変える
    // $title_kw = get_keyword();

    //タイトルの文章を取得
    $title_kw = get_post_meta($int_setting_ids['top'],'cf_top_search_title',true);
  //
  //  $title_kw = '【'.$page->post_title.'の転職サイト】ランキング';
  // }
 ?>

<div class="contentForm"<?php if (!empty($formSetting['is_anker'])) { ?>id="ankerForm"<?php } ?>>
    <div class="contentForm__wrap">
        <h2 class="tit_search"><?php echo $title_kw;?></h2>
        <?php
            //content
            get_template_part('inc/form/inc_search');
        ?>

        <?php if (!empty($formSetting['is_accordion'])) { ?>
            <div class="btnAcd search <?php if ($formSetting['is_accordion'] == 'close') { ?>close<?php } ?>" data-acd-search-trigger="">
                <img src="<?php echo get_template_directory_uri(); ?>/images/btn_accordion_01.svg" alt="<?php echo $title_kw;?>" width="60" height="65" class="img-r" />
            </div>
        <?php } ?>
    </div>
</div>
