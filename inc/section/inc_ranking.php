<?php
    global $int_setting_ids;
    global $page_title;
    global $ranking_posts;

    //テンプレートpage-indexか判定
    $temp_top = get_temp_top();

    if( is_home() || is_front_page() ) {
        $ranking_max = 5;
        $ranking_id = $post->ID;
        $is_diagnosis = true;
    }elseif ($temp_top) {
        $ranking_max = 5;
        $is_ranking = get_post_meta($post->ID,'cf_ranking_1',true);
        $ranking_id = ($is_ranking)?$post->ID:$int_setting_ids['top'];
        $is_diagnosis = true;
    }else {
        $ranking_max = 20;
        $ranking_id = $post->ID;
        $is_diagnosis = false;
    }

    //ランキング情報
    $ranking_posts = get_ranking_posts($ranking_id,$ranking_max);

    //タイトルの文章を取得
    if( !empty($page_title) ){
        $title_kw = $page_title;
    }else {
        $title_kw = get_post_meta($int_setting_ids['top'],'cf_top_ranking_title',true);
        $detail_kw = get_post_meta($int_setting_ids['top'],'cf_top_ranking_detail',true);
    }

 ?>



<section class="contentCommon" id="ankerRanking">
    <?php
        //title
        view_title_common($title_kw);
    ?>
    <?php if( !empty($detail_kw) ){ ?>
        <div class="contentCommon__catch">
            <?php echo $detail_kw; ?>
        </div>
    <?php } ?>
    <div class="">
        <?php
            $ranking_setting = array('ranking' => 1, );
            foreach ($ranking_posts as $key => $ranking) {
                view_product($ranking,$ranking_setting);
                $ranking_setting['ranking']++;
            }
         ?>
    </div>
</section>
