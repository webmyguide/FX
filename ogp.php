<!-- OGP -->
<meta property="og:type" content="website">
<?php
if (is_single()){//単一記事ページの場合
if(have_posts()): while(have_posts()): the_post();
  echo '<meta property="og:description" content="'.mb_substr(get_the_excerpt(), 0, 100).'">';echo "\n";//抜粋を表示
endwhile; endif;
  echo '<meta property="og:title" content="'; the_title(); echo '">';echo "\n";//単一記事タイトルを表示
  echo '<meta property="og:url" content="'; the_permalink(); echo '">';echo "\n";//単一記事URLを表示
} else {//単一記事ページページ以外の場合（アーカイブページやホームなど）
  echo '<meta property="og:description" content="'; bloginfo('description'); echo '">';echo "\n";//「一般設定」管理画面で指定したブログの説明文を表示
  echo '<meta property="og:title" content="'; bloginfo('name'); echo '">';echo "\n";//「一般設定」管理画面で指定したブログのタイトルを表示
  echo '<meta property="og:url" content="'; bloginfo('url'); echo '">';echo "\n";//「一般設定」管理画面で指定したブログのURLを表示
}
$str = $post->post_content;
$searchPattern = '/<img.*?src=(["\'])(.+?)\1.*?>/i';//投稿にイメージがあるか調べる
if (is_single()){//単一記事ページの場合
  if (has_post_thumbnail()){//投稿にサムネイルがある場合の処理
    $image_id = get_post_thumbnail_id();
    $image = wp_get_attachment_image_src( $image_id, 'full');
    echo '<meta property="og:image" content="'.$image[0].'">';echo "\n";
  } else if ( preg_match( $searchPattern, $str, $imgurl ) && !is_archive()) {//投稿にサムネイルは無いが画像がある場合の処理
    echo '<meta property="og:image" content="'.$imgurl[2].'">';echo "\n";
  } else {//投稿にサムネイルも画像も無い場合の処理
    $ogp_image = get_template_directory_uri().'/images/og-image.jpg';
    echo '<meta property="og:image" content="'.$ogp_image.'">';echo "\n";
  }
} else {//単一記事ページページ以外の場合（アーカイブページやホームなど）
  if (get_header_image()){//ヘッダーイメージがある場合は、ヘッダーイメージを
    echo '<meta property="og:image" content="'.get_header_image().'">';echo "\n";
  } else {//ヘッダーイメージがない場合は、テーマのスクリーンショット
    echo '<meta property="og:image" content="'.get_template_directory_uri().'/images/ogp.png">';echo "\n";
  }
}
?>
<meta property="og:site_name" content="<?php bloginfo('name'); ?>">
<meta property="og:locale" content="ja_JP" />
<!-- <meta property="fb:admins" content="ADMIN_ID"> -->
<!-- <meta property="fb:app_id" content="APP_ID"> -->
<!-- /OGP -->
