<?php

/*-------------------------------------------*/
/*	　設定画面のPost ID
/*-------------------------------------------*/
function set_setting_ids(){
    global $int_setting_ids;

    $int_setting_ids = array();

    //共通の設定
    $int_setting_ids['common'] = 1928;

    //TOPページの設定
    $int_setting_ids['top'] = 328;

    //比較ページの設定
    $int_setting_ids['comp'] = 2213;

    //ランキング根拠の設定
    $int_setting_ids['ranking_research'] = 335;

    //会社概要の設定
    $int_setting_ids['company'] = 2094;

    //お問い合わせページの設定
    $int_setting_ids['contact'] = 2117;
    $int_setting_ids['contact_confirm'] = 2119;
    $int_setting_ids['contact_thanks'] = 2122;
    $int_setting_ids['contact_error'] = 2124;


    $args = array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'posts_per_page' => 1,
    );
    $posts = get_posts($args);
    $int_setting_ids['int_product'] = $posts[0]->ID;

}

/*-------------------------------------------*/
/*	　TOPページ　ランキング
/*-------------------------------------------*/
function get_ranking_posts($id = null,$max = 20) {
    global $post;
    global $int_setting_ids;

    //空だったらTOPページの設定のpost_idを付与
    if(empty($id)) $id = $int_setting_ids['top'];

    $ids = array();
    for ($i=1; $i <= $max; $i++) {
        $ranking_id = get_post_field('cf_ranking_'.$i,$id);
        if($ranking_id && !in_array($ranking_id,$ids) ){
            $ids[] = (int) get_post_field('cf_ranking_'.$i,$id);
        }
    }

    if(empty($ids)){
        $args = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => $max,
            'orderby' => 'meta_value_num',
            'order' => 'ASC',
            'meta_key' => 'sort_num',
        );
    }else {
        $args = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'include' => $ids,
            'orderby' => 'post__in',
        );
    }

    $posts = get_posts($args);

    return $posts;
}

/*-------------------------------------------*/
/*	　サイドバナー
/*-------------------------------------------*/
function get_side_banner_posts($pos = null) {

    $term_slug = 'side_bnner1';
    if($pos == 'bottom') $term_slug = 'side_bnner2';

    $args = array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'posts_per_page' => 5,
        'tax_query' => array(
            array(
              'taxonomy'=> 'sidebanner',
              'terms'=>array( $term_slug),
              'field'=>'slug',
              'include_children'=>true,
              'operator'=>'IN'
            ),
        ),
    );
    $posts = get_posts($args);

    return $posts;
}


/*-------------------------------------------*/
/*	　クッションURLの取得
/*-------------------------------------------*/
function get_cushion_url($id = null) {
    $link_name = get_post_meta($id,'product_link_name',true);
    $link = esc_url( get_home_url() ).'/cushion/?pn='.$link_name.'&pid='.$id;
    return $link;
}



/*-------------------------------------------*/
/*	　評価取得
/*-------------------------------------------*/
function get_reputation_field($id = null,$page = null) {

    //int
    $i = 1;
    $max_i = 4;

    //詳細ページ
    if($page == 'detail'){
        $i = 1;
        $max_i = 4;
    }

    $list = array();
    for ($i; $i <= $max_i; $i++) {
            $list[] = get_field_object('product_reputation_'.$i,$id);
    }

    return $list;
}

/*-------------------------------------------*/
/*	　案件データテキストの取得
/*-------------------------------------------*/
function get_product_data_text_field($id = null,$type = null) {

    $list = array();
    if($type == 1){
        $select_num = array(2,3,4,5,6);
        foreach ($select_num as $value) {
            $fielddata = get_field_object('product_data_'.$value,$id);
            $list[] = array(
                'label' => $fielddata['label'],
                'value' => $fielddata['value']['text'],
                'num' => $fielddata['value']['num'],
                'mark_id' => $fielddata['value']['mark'],
                'mark' => get_mark($fielddata['value']['mark']),
                'class_1' => $fielddata['value']['type'],
                'type' => $fielddata['value']['type'],
            );
        }
    }else if($type == 2) {
        $select_num = array(2,3,4,1,5,6);
        foreach ($select_num as $value) {
            $fielddata = get_field_object('product_data_'.$value,$id);
            $list[] = array(
                'label' => $fielddata['label'],
                'value' => $fielddata['value']['text'],
                'num' => $fielddata['value']['num'],
                'mark_id' => $fielddata['value']['mark'],
                'mark' => get_mark($fielddata['value']['mark']),
                'class_1' => $fielddata['value']['type'],
                'type' => $fielddata['value']['type'],
            );
        }
    }else {
        for ($i=1; $i <= 10; $i++) {
            $fielddata = get_field_object('product_data_'.$i,$id);
            $list[] = array(
                'label' => $fielddata['label'],
                'value' => $fielddata['value']['text'],
                'num' => $fielddata['value']['num'],
                'mark_id' => $fielddata['value']['mark'],
                'mark' => get_mark($fielddata['value']['mark']),
                'class_1' => $fielddata['value']['type'],
                'type' => $fielddata['value']['type'],
            );
        }

    }


    return $list;
}

function get_mark($val) {
    switch ($val) {
        case 1:
            $res = '◎';
            break;
        case 2:
            $res = '○';
            break;
        case 3:
            $res = '△';
            break;
        case 4:
            $res = '✕';
            break;
        case 5:
            $res = '-';
            break;
        default:
            $res = '○';
            break;
    }

    return $res;
}


/*-------------------------------------------*/
/*	　案件データテキストの取得
/*-------------------------------------------*/
function get_product_recommend_point_field($id = null) {
    $list = array();
    for ($i=1; $i <= 5; $i++) {
        $fielddata = get_post_meta($id,'product_recommend_point_'.$i,ture);
        if($fielddata) $list[] = $fielddata;
    }
    return $list;
}

/*-------------------------------------------*/
/*	　テンプレートがpage-indexか判定
/*-------------------------------------------*/
function get_temp_top() {
    global $template;
    $temp_name = basename($template);

    return ( $temp_name == 'page-index.php' )? true: false;
}


?>
