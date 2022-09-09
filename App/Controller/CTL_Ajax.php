<?php


/*-------------------------------------------*/
/*	非同期通信
/*-------------------------------------------*/

/*-------------------------------------------*/
/*	並び替え
/*-------------------------------------------*/
// パラメータ案件記事 取得
function ajax_sort_product(){
    global $post;

    $page = $_POST['page'];
    $order = $_POST['order'];
    $where = $_POST['where'];

    // 検索結果の取得
    if($page == 'search' ){
        $posts = get_search_posts(true);
        $rankingCount = 1;
        $resut = '';

        $setting = array(
            'page_search' => true,
            'ranking' => 1,
        );

    }else {
        $resut = '';
        $args = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'orderby' => 'meta_value_num',
            'order' => 'ASC',
            'meta_key' => 'sort_num',
        );

        $posts = get_posts($args);

        $setting = array();
    }

    $sort_array = array();
    $original_array = array();
    foreach($posts as $keys => $post) {
        if( !empty($post) ) {
            $sort_where = get_post_meta($post->ID,$where,'ture');
            //マークの場合
            if(empty($sort_where)){
                $where = str_replace('num','mark',$where);
                $sort_where = get_post_meta($post->ID,$where,'ture');
            }

            $original_array[$keys] = array(
                'id' => $post->ID,
                'sort' => $sort_where,
            );

            $sort_array[$keys] = $sort_where;
        }
    }

    if($order == 'DESC'){
        $sort_order = SORT_DESC;
    }else {
        $sort_order = SORT_ASC;
    }

    array_multisort($sort_array, $sort_order, $original_array);


    echo json_encode($original_array);
    die();
}

add_action( 'wp_ajax_ajax_sort_product', 'ajax_sort_product' );
add_action( 'wp_ajax_nopriv_ajax_sort_product', 'ajax_sort_product' );






/*-------------------------------------------*/
/*	検索のヒット数
/*-------------------------------------------*/
function ajax_search_hits(){
    global $post;

    //IDの取得
    $id = (isset($_POST['id']))?$_POST['id']:'';


    // 検索結果の取得
    $posts = get_search_posts(true);
    $hits = count($posts);
    if(empty($hits)) $hits = 0;

    $res = array(
        'id' => $id,
        'hits' => $hits,
    );

    echo json_encode($res);
    die();
}

add_action( 'wp_ajax_ajax_search_hits', 'ajax_search_hits' );
add_action( 'wp_ajax_nopriv_ajax_search_hits', 'ajax_search_hits' );



/*-------------------------------------------*/
/*	登録者数の取得
/*-------------------------------------------*/

add_action( 'wp_ajax_ajaxNumberRegistrants', 'ajaxNumberRegistrants' );
add_action( 'wp_ajax_nopriv_ajaxNumberRegistrants', 'ajaxNumberRegistrants' );
//参考になったボタン
add_action( 'wp_ajax_ajaxDoReputation', 'ajaxDoReputation' );
add_action( 'wp_ajax_nopriv_ajaxDoReputation', 'ajaxDoReputation' );
function ajaxNumberRegistrants(){
  global $post;

  $value = get_transient( 'numberRegistrants');


  if(empty($value)){
    //時間の取得
    date_default_timezone_set('Asia/Tokyo');
    $timeH = date("H");

    $value = 31;
    //時間毎に振り分け
    if($timeH < 8) {
      $value = mt_rand(60, 80);
      // $value = floor(mt_rand(1, 3));
    }else if ($timeH < 12) {
      $value = mt_rand(120, 150);
    }else if ($timeH < 14) {
      $value = mt_rand(120, 160);
      // $value = mt_rand(1, 3);
    }else if ($timeH < 19) {
      $value = mt_rand(140, 199);
    }else if ($timeH < 22) {
      $value = mt_rand(140, 199);
    }else {
      $value = mt_rand(100, 120);
    }
    set_transient( 'numberRegistrants', $value,360 );
  }

  echo $value;
  die();
}

// 参考になったボタン
function ajaxDoReputation(){
  global $wpdb;
  global $post;
  $keyId = $_POST['id'];
  $data = $wpdb->get_results( "SELECT meta_value FROM wp_postmeta WHERE post_id = '".$keyId."' AND meta_key = 'reputation_reference'"  );


  //保存するために配列にする
  $set_arr = array(
    'meta_value' => $data[0]->meta_value+1,
  );

  //DBに保存
  if ($data[0]->meta_value) {
    $wpdb->update( 'wp_postmeta', $set_arr, array('post_id' => $keyId,'meta_key' => 'reputation_reference',));
  } else {
    $set_arr['post_id'] = $post_id;
    $set_arr['meta_key'] = 'reputation_reference';
    $wpdb->insert( 'wp_postmeta', $set_arr);
  }

  echo $set_arr['meta_value'];
  die();
}
