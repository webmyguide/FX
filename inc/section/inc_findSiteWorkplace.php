<?php
    global $formFindSite;

    $is_title = true;
    $is_lead = true;
    $is_tips = true;
    if( isset($formFindSite['page_ranking']) ){
        $is_title = false;
        $is_lead = false;
        $is_tips = true;
    }
?>

<section class="contentFind">
    <div class="contentFind__wrap">
        <?php if($is_title){ ?>
            <div class="contentFind__links boxFindLinks">
                <h2 class="boxFindLinks__title">あなたの<span class="marker-01">重視するもの</span>からサイトを探す</h2>
                <!-- <p class="boxFindLinks__lead">希望業種の求人に強いサイトが見つかる</p> -->
                <?php get_template_part('inc/list/inc_findSiteWorkplace'); ?>
            </div>
        <?php } ?>
    </div>
</section>
