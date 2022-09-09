<?php

/*-------------------------------------------*/
/*	　検索結果の取得
/*-------------------------------------------*/
function get_search_posts($isPost = false) {
  global $post;
  global $wpdb;

    if($isPost){
        $keySk1 = (isset($_POST['sk1']))?$_POST['sk1']:'';
        $keySk2 = (isset($_POST['sk2']))?$_POST['sk2']:'';
        $keySk3 = (isset($_POST['sk3']))?$_POST['sk3']:'';
        $keySk4 = (isset($_POST['sk4']))?$_POST['sk4']:'';
        $keySk5 = (isset($_POST['sk5']))?$_POST['sk5']:'';
        $keyMata = 'sort_num';
      $keyOrder = 'ASC';
    }else {
        $keySk1 = $_GET['sk1'];//年齢は？
        $keySk2 = $_GET['sk2'];//学歴は？
        $keySk3 = $_GET['sk3'];//現在の状況は？
        $keySk4 = $_GET['sk4'];//現在の年収は600万円以上？
        $keySk5 = $_GET['sk5'];//希望する職業は？
        $keyMata = 'sort_num';
        $keyOrder = 'ASC';
    }



    // 検索条件
    $conditions = array();
    //年齢は？複数か単発かどうか
    if(!empty($keySk1)) $conditions["sk1"] = get_args_meta_query('sk1',$keySk1);
    //学歴は？複数か単発かどうか
    if(!empty($keySk2)) $conditions["sk2"] = get_args_meta_query('sk2',$keySk2);
    //現在の状況は？複数か単発かどうか
    if(!empty($keySk3)) $conditions["sk3"] = get_args_meta_query('sk3',$keySk3);
    //希望する職業は？複数か単発かどうか
    if(!empty($keySk4)) $conditions["sk4"] = get_args_meta_query('sk4',$keySk4);
    //性別は？複数か単発かどうか
    if(!empty($keySk5)) $conditions["sk5"] = get_args_meta_query('sk5',$keySk5);



    $args = array(
		'posts_per_page' => -1,
		'post_type' => 'product',
		'orderby' => 'meta_value_num',
		'order' => $keyOrder,
        'meta_key' => $keyMata,
	);
    $posts = get_posts($args);
// var_dump($conditions);

    // 検索処理
    $list = array();

    foreach ($posts as $keyPost => $post) {
      $isDisp = true;
      $addPostFlg = true;

      if($addPostFlg){
        foreach ($conditions as $key => $value) {
          $filed = get_post_field($key,$post->ID);

          //$filedが配列であるか
          if(is_array($filed)){
              $resultFiled = array_intersect($filed, $value);
              if(count($resultFiled) < count($value)){
                $isDisp = false;
              }
          }else {
            if(!in_array($filed, $value)){
              $isDisp = false;
            }
          }
        }
        if($isDisp) $list[] = $post;
      }
    }


    return $list;
}

//
function get_args_meta_query($key,$value){

    $args = '';

    if (is_array($value)) {
        $args = $value;
    } else {
        $args = array();
        if(strpos($value,',') !== false){
          $explode = explode(',',$value);
          $list = array();

          foreach ($explode as $val) {
            $val  = preg_replace("/( |　)/", "", $val );
            $val  = preg_replace("/%20/", "", $val );
            $args[] = $val;
          }
        }else {
          $args[] = $value;
        }
    }
    return $args;


    // $args = '';
    // if((strpos((string) $value,',') !== false) || (strpos((string) $value,'%2C') !== false)){
    //   if(strpos($value,'%2C') !== false){
    //     $explode = explode('%2C',$value);
    //   }else {
    //     $explode = explode(',',$value);
    //   }
    //
    //   $list = array();
    //
    //   foreach ($explode as $val) {
    //     $val  = preg_replace("/( |　)/", "", $val );
    //     $val  = preg_replace("/%20/", "", $val );
    //     $args[] = $val;
    //   }
    // }else {
    //   $args[] = $value;
    // }
    // return $args;
}

//--------------------------------------------------------------------------------------------------
// ソート
//--------------------------------------------------------------------------------------------------

function get_sort_search() {
    global $int_setting_ids;


    $fields = get_field_objects($int_setting_ids['int_product']);

    $list_spread = array();
    for ($i=1; $i <= 7; $i++) {
        $list_spread[] = array(
            'where' => 'product_spread_'.$i.'_num',
            'order' => 'DESC',
            'name' => $fields['product_spread_'.$i]['label'],
        );
    }

    $list = array();
    $list = array(
		array(
            'where' => 'product_data_2'.'_num',
            'order' => 'DESC',
            'name' => $fields['product_data_2']['label'],
        ),
		array(
            'where' => 'product_data_3'.'_num',
            'order' => 'DESC',
            'name' => $fields['product_data_3']['label'],
        ),
        array(
            'where' => 'product_data_4'.'_num',
            'order' => 'DESC',
            'name' => $fields['product_data_4']['label'],
        ),
        array(
            'where' => 'product_data_1'.'_num',
            'order' => 'DESC',
            'name' => $fields['product_data_1']['label'],
        ),
        array(
            'where' => 'product_data_5'.'_num',
            'order' => 'DESC',
            'name' => $fields['product_data_5']['label'],
        ),
        array(
            'where' => 'product_data_6'.'_num',
            'order' => 'DESC',
            'name' => $fields['product_data_6']['label'],
        ),
        array(
            'name' => 'スプレッド',
            'group' => 'spread',
            'list' => $list_spread,
        ),
    );



    return $list;
}


?>
