

<!-- <?php if( is_search() || is_home() || is_front_page() ) { ?>
	 <div class="boxRegistration ani-attention-registration<?php if( is_search() ) { ?>2<?php }else { ?>1<?php } ?>">
		<?php if( is_search() ) { ?>
		 	<p>この１時間で<span data-num-registrants="" data-registrants-type="2"><span class="fixedNum"><?php echo (!empty(get_transient( 'numberRegistrants')))?get_transient( 'numberRegistrants')*1.5:'--'; ?></span><span class="cagNum"></span></span>人が購入しました</p>
		<?php }else { ?>
			<p>現在<span data-num-registrants="" data-registrants-type="1"><span class="fixedNum"><?php echo (!empty(get_transient( 'numberRegistrants')))?get_transient( 'numberRegistrants'):'--'; ?></span><span class="cagNum"></span></span>人が見ています！</p>
		<?php } ?>
	 </div>
 <?php } ?> -->



<?php
    // get_template_part('inc/section/inc_dialog');
?>


<footer class="footer">
	<div class="footer__wrap">
		<div class="footer__logo">
			<a href="<?php echo esc_url(home_url( '/' )); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo_01.png" alt="<?php bloginfo('title'); ?>" width="208" height="56" class="img-r verAlign-b" /></a>
		</div>
		<div class="footer__nav">
			<ul class="navFooter">
				<li class="navFooter__item"><a href="<?php echo esc_url( home_url('/company/') ); ?>" class="navFooter__link">会社概要</a></li>
				<li class="navFooter__item"><a href="<?php echo esc_url( home_url('/privacy/') ); ?>" class="navFooter__link">プライバシーポリシー</a></li>
				<li class="navFooter__item"><a href="<?php echo esc_url( home_url('/ranking_research/') ); ?>" class="navFooter__link">ランキング根拠</a></li>
				<li class="navFooter__item"><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="navFooter__link">お問い合わせ</a></li>
			</ul>
		</div>
	</div>
	<p class="footer__copyright">Copyright (C) <?php bloginfo('name'); ?>. All Rights Reserved</p>
</footer><!-- /.footer -->

<?php wp_footer();?>
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/> -->
<!-- <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script> -->
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.dataTables.min.js"></script>
<script>
    $(function () {
        $.extend( $.fn.dataTable.defaults, {
            language: {
                url: "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Japanese.json"
            }
        });
        $("#table-product").DataTable({
            lengthMenu: [ 5, 10, 15, 20 ],
            displayLength: 5,
            order: []
        });
    });
</script>
<script>
  var ajaxUrl = '<?php echo admin_url( 'admin-ajax.php' ); ?>';
</script>







</body>
</html>
