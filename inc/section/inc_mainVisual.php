<?php
	global $int_setting_ids;

	$is_section = true;
	$is_mv = false;
	$is_mv_top = false;
	$is_balloon = false;
	$is_breadcrumb = false;

	//TOPページの場合
	if(is_front_page() || is_home()){
		$is_section = true;
	}

	//パンクズ
	if( !(is_front_page() || is_home()) ){
		$is_breadcrumb = true;
	}

	//post_typeで判定
	// if( is_singular( 'ranking' ) ) {
	// 	$balloon = get_post_meta($post->ID,'cf_ranking_balloon',true);
	// 	$appeal = get_post_meta($post->ID,'cf_ranking_appeal',true);
	// 	if(!empty($balloon)) $is_balloon = true;
	// }

	global $template; // テンプレートファイルのパスを取得
    $temp_name = basename($template); // パスの最後の名前（ファイル名）を取得
    if($temp_name == 'page-index.php') {
		$is_section = true;
		$is_mv_top = true;
		$is_breadcrumb = false;
	}


	//記事数
	$count_product = wp_count_posts('product');

?>

<?php if($is_section){ ?>

	<?php if(is_front_page() || is_home() || $is_mv_top){ ?>
		<div class="mainVisual">
			<div class="mainVisual__wrap">
				<div class="mainVisual__data"><?php echo date('Y'); ?>年&nbsp;最新版</div>
				<div class="mainVisual__text">
					<?php echo get_post_meta($int_setting_ids['common'],'cf_s_mv_top_main',true); ?>
					<div class="sub"><?php echo get_post_meta($int_setting_ids['common'],'cf_s_mv_top_sub',true); ?></div>
				</div>
				<!-- <div class="mainVisual__post"><?php echo $count_product->publish; ?></div> -->
				<img src="<?php echo get_template_directory_uri(); ?>/images/mv_top_pc_01.png" alt="<?php bloginfo('title'); ?>" width="940" height="357" class="img-r img-pc"/>
				<img src="<?php echo get_template_directory_uri(); ?>/images/mv_top_01.jpg" alt="<?php bloginfo('title'); ?>" width="768" height="573" class="img-r img-sp"/>
			</div>
		</div>
	<?php }else{ ?>
		<div class="mainVisual mainVisual-other">
			<div class="mainVisual__wrap">
				<div class="mainVisual__text mainVisual__text-other">
					<?php echo get_post_meta($int_setting_ids['common'],'cf_s_mv_other_main',true); ?>
				</div>
				<img src="<?php echo get_template_directory_uri(); ?>/images/mv_other_pc_01.png" alt="<?php bloginfo('title'); ?>" width="940" height="151" class="img-r img-pc"/>
				<img src="<?php echo get_template_directory_uri(); ?>/images/mv_other_01.jpg" alt="<?php bloginfo('title'); ?>" width="768" height="200" class="img-r img-sp"/>
			</div>
		</div>
	<?php } ?>


	<?php if($is_breadcrumb){ ?>
		<?php
			$product_name =  get_post_meta($int_setting_ids['common'],'cf_s_common_product',true);
			$archive_product_name = $product_name.'一覧';
		?>
		<div class="breadcrumb">
			<ul class="listBreadcrumb">
				<li class="listBreadcrumb__item"><a href="<?php echo esc_url(home_url( '/' )); ?>"><?php bloginfo('title'); ?></a></li>
				<?php if( is_singular( 'product' ) ){ ?>
					<li class="listBreadcrumb__item"><a href="<?php echo get_post_type_archive_link('product'); ?>"><?php echo $archive_product_name; ?></a></li>
				<?php }elseif ( is_singular( 'post' ) ) { ?>
					<li class="listBreadcrumb__item"><a href="<?php echo get_permalink(88); ?>">記事一覧</a></li>
				<?php } ?>

				<?php if( is_search() ){ ?>
					<li class="listBreadcrumb__item">検索結果</li>
				<?php }elseif (is_post_type_archive('product')) { ?>
					<li class="listBreadcrumb__item"><?php echo $archive_product_name; ?></li>
				<?php }elseif (is_post_type_archive('word-mouth')) { ?>
					<li class="listBreadcrumb__item"><?php echo '口コミ'; ?></li>
				<?php }else { ?>
					<li class="listBreadcrumb__item"><?php echo $post->post_title; ?></li>
				<?php } ?>
			</ul>
		</div>
	<?php } ?>

<?php } ?>
