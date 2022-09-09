<?php
    global $int_setting_ids;
    //
    $title_kw = get_post_meta($int_setting_ids['top'],'cf_top_point_title',true);
    $detail_kw = get_post_meta($int_setting_ids['top'],'cf_top_point_detail',true);

    $list = array();
    for ($i=1; $i <= 3; $i++) {
        $list[] = array(
            'text' => get_post_meta($int_setting_ids['top'],'cf_top_point_list_point_'.$i,true),
            'point' => $i,
        );
    }
 ?>

<section class="contentCommon contentPoint">
    <div class="contentPoint__wrap">
        <h2 class="contentPoint__title titleRibbon"><?php echo $title_kw;?></h2>

        <div class="contentPoint__detail"><?php echo $detail_kw;?></div>

        <ul class="listPoint">
            <?php foreach ($list as $key => $value) {  ?>
                <li class="listPoint__items">
                    <div class="listPoint__point">POINT<?php echo $value['point'];?></div>
                    <div class="listPoint__ico listPoint__ico-point<?php echo $value['point'];?>"><img src="<?php echo get_template_directory_uri(); ?>/images/ico_point_01_0<?php echo $value['point'];?>.png" alt="POINT<?php echo $value['point'];?>" width="140" height="140" class="img-r verAlign-b" /></div>
                    <div class="listPoint__text"><?php echo $value['text'];?></div>
                </li>
            <?php } ?>
        </ul>
    </div>
</section>
