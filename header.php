<?php
	global $int_setting_ids;
	global $template; // テンプレートファイルのパスを取得
	$temp_name = basename($template); // パスの最後の名前（ファイル名）を取得
	if($temp_name == 'page-index.php') {
		$is_mv_top = true;
	}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="format-detection" content="telephone=no">

	<?php wp_head();?>
	<meta name="description" content="<?php bloginfo('description'); ?>" />

    <link rel="apple-touch-icon" href="icon.png">
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">


<!-- Google Tag Manager -->
<?php
	$gtm_id =  get_post_meta($int_setting_ids['common'],'cf_s_common_gtm',true);
	$gtm_id  = preg_replace("/( |　)/", "", $gtm_id );
?>

<?php if( !empty($gtm_id) ){ ?>
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','<?php echo $gtm_id;?>');</script>
	<!-- End Google Tag Manager -->
<?php } ?>


	<?php get_template_part('ogp'); ?>
</head>
<body <?php body_class(); ?>>

<?php if( !empty($gtm_id) ){ ?>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src=""https://www.googletagmanager.com/ns.html?id=<?php echo $gtm_id;?>""
	height=""0"" width=""0"" style=""display:none;visibility:hidden""></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
<?php } ?>

	<!-- IE9未満への注意文 -->
	<!--[if lte IE 9]>
			<p class="browserAlert">IE9未満用のメッセージ</p>
	<![endif]-->
<header class="header">
	<div class="header__wrap">

		<div class="header__logo">
			<a href="<?php echo esc_url(home_url( '/' )); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo_01.png" alt="<?php bloginfo('title'); ?>" width="208" height="56" class="img-r verAlign-b" /></a>
		</div>


		<!-- <div class="header__menu">
			<a href="javascript:void(0)" class="button-menu" id="onMenu">
				<img src="<?php echo get_template_directory_uri(); ?>/images/button_menu.png" alt="menu" width="72" height="72" class="img-r" />
			</a>
		</div> -->

		<nav class="headerMenu" id="targetMenu">
			<?php
				if(is_front_page() || is_home() ){
					$anker_form = '#ankerForm';
					$anker_ranking = '#ankerRanking';
				}else {
					$anker_form = esc_url(home_url( '/#ankerForm' ));
					$anker_ranking = esc_url(home_url( '/#ankerRanking' ));
				}
			?>
			<ul class="headerMenu__ul">
				<li class="headerMenu__li">
					<a href="<?php echo esc_url(home_url( '/' )); ?>" class="headerMenu__link headerMenu__link-01 <?php if(is_front_page() || is_home() ) echo "headerMenu__link-select";?> ">ホーム</a>
				</li>
				<li class="headerMenu__li">
					<a href="<?php echo esc_url( home_url( '/product/' ) ); ?>" class="headerMenu__link headerMenu__link-02 <?php if(is_post_type_archive('product')) echo "headerMenu__link-select";?> ">一括比較</a>
				</li>
				<li class="headerMenu__li">
					<a href="<?php echo esc_url( home_url( '/articles-list/' ) ); ?>" class="headerMenu__link headerMenu__link-03 <?php if(is_page('articles-list')) echo "headerMenu__link-select";?> ">初心者</a>
				</li>
			</ul>
		</nav>
	</div>
</header>



<?php get_template_part('inc/section/inc_mainVisual'); ?>
