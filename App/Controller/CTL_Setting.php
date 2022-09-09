<?php


/*-------------------------------------------*/
/*  Theme setup
/*-------------------------------------------*/
if ( ! function_exists( 'templ_theme_setup' ) ) :
function templ_theme_setup() {
    // if(is_front_page() || is_home()){
    //   var_dump('aaaaa');
    //   set_transient( 'topPageType', 0 );
    // }elseif (isLp() == true) {
    //   var_dump('bbbbbb');
    //   set_transient( 'topPageType', 1 );
    // }

    //設定ページのIDをglobalにセット
    set_setting_ids();

    /*-------------------------------------------*/
    /*  manage the document title
    /*-------------------------------------------*/
    add_theme_support( 'title-tag' );
    add_filter( 'pre_get_document_title', 'my_pre_get_document_title' );

    function my_pre_get_document_title( $title ) {
      $description = get_bloginfo('description');
      $name = get_bloginfo('name');
      $post_data = get_post();
      $title = $post_data->post_title;
      if ( is_search() ) {
        $title = $description.' | 検索結果一覧';
      }elseif (is_home() || is_front_page()) {
        $title = $description.' | '.$name;
      }else {
        $title = $description.' | '.$title;
      }
      return $title;
    }
// // $template_name = basename($template, '.php');
    // var_dump(isLp());
    // define("isLp", true);



    /*-------------------------------------------*/
    /*  support for Post Thumbnails
    /*-------------------------------------------*/
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 950, 9999 );
    /*-------------------------------------------*/
    /*  This theme uses wp_nav_menu() in two locations
    /*-------------------------------------------*/
    register_nav_menus( array(
        'foot_menu'  => 'Footer Menu'
    ) );
    /*-------------------------------------------*/
    /*  content width
    /*-------------------------------------------*/
    if ( !isset( $content_width ) ){
        $content_width = 950;
    }
    /*-------------------------------------------*/
    /*  Load css JS
    /*-------------------------------------------*/
    function templ_add_script() {
			wp_enqueue_style( 'style', get_template_directory_uri() . '/css/main.css', false );

      // 共通 js
      wp_deregister_script('jquery');
      wp_enqueue_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js', array(), '3', true);
      if (is_user_logged_in()){
          wp_enqueue_script( 'main-js', get_template_directory_uri() . '/build/main.js', array( 'jquery' ), '', true );
      }else {
          wp_enqueue_script( 'main-js', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), '', true );
      }

      // echo '<script type="text/javascript" src="'. get_template_directory_uri() .'/js/main.js" charset="utf-8" async="async"></script>';



    } // end templ_add_script
    add_action('wp_enqueue_scripts','templ_add_script');
}
endif;
add_action( 'after_setup_theme', 'templ_theme_setup' );


/*-------------------------------------------*/
/*	　リンクにパラメーターを引き継がせる
/*-------------------------------------------*/
function add_parameter(){
$url = 'https://' . $_SERVER["SERVER_NAME"] . $_SERVER['REQUEST_URI'];
$url_array = parse_url($url);
$url_query = '?' . $url_array['query'];
return  $url_query;
}
add_shortcode('parameter', 'add_parameter');

// パラメータをcookieに保存
add_action( 'init', 'gclid_setcookie' );
function gclid_setcookie() {
  // gclid cookie保存
  if ( isset( $_GET['gclid'] ) ) {
    setcookie( 'gclid_cookie', $_GET['gclid'], time() + 3600*24*90, '/' );
  }
}

/*-------------------------------------------*/
/*	　リダイレクトを無効
/*-------------------------------------------*/
function disable_redirect_canonical( $redirect_url ) {
  if( is_404() ) {
    return false;
  }
  return $redirect_url;
}
add_filter( 'redirect_canonical', 'disable_redirect_canonical' );


/*-------------------------------------------*/
/*	　AddQuicktagをカスタム投稿で使用する
/*-------------------------------------------*/
function addquicktag_post_types($post_types) {
    $post_types[] = 'product';
    return $post_types;
}
add_filter('addquicktag_post_types', 'addquicktag_post_types');


/*-------------------------------------------*/
/*	　//カスタム投稿アーカイブページの並び順を変更
/*-------------------------------------------*/
function change_posts_per_page($query) {

    //管理画面,メインクエリに干渉しないために必須
    if( is_admin() || ! $query->is_main_query() ){
        return;
    }

    //カスタム投稿「members」アーカイブページの表示件数を10件、ふりがなの昇順でソート
    if ( $query->is_post_type_archive( 'product' ) //membersのアーカイブページか、もしくは
        ||
         $query->is_tax() ) //カスタム分類のアーカイブページが表示されているか
        {
            $query -> set('meta_key', 'sort_num'); //基準のカスタムフィールドキー
            $query -> set('orderby', 'meta_value_num'); //meta_valueの値で並べる
            $query -> set('order','ASC'); //昇順
        return;
        }
}
add_action( 'pre_get_posts', 'change_posts_per_page' );
