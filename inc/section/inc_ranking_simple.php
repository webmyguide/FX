<?php
    global $int_setting_ids;


    //テンプレートpage-indexか判定
    $temp_top = get_temp_top();

    if( is_home() || is_front_page() ) {
        $ranking_max = 5;
        $ranking_id = $post->ID;
    }elseif ($temp_top) {
        $ranking_max = 5;
        $is_ranking = get_post_meta($post->ID,'cf_ranking_1',true);
        $ranking_id = ($is_ranking)?$post->ID:$int_setting_ids['top'];
    }else {
        $ranking_max = 5;
        $ranking_id = $post->ID;
    }

    //ランキング情報
    $ranking_posts = get_ranking_posts($ranking_id,$ranking_max);
 ?>




<div class="boxRankingSimple">
    <ul class="listRankingSimple">
        <?php
            $ranking_setting = array('ranking' => 1, );
            foreach ($ranking_posts as $key => $ranking) {
        ?>
            <li class="listRankingSimple__items">
                <?php view_product_simple($ranking,$ranking_setting);?>
            </li>
        <?php
            $ranking_setting['ranking']++;
            }
         ?>
    </ul>
</div>
