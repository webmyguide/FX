<?php
    global $int_setting_ids;

    $list = array();
    for ($i=1; $i <= 3; $i++) {
        $list[] = array(
            'title' => get_post_meta($int_setting_ids['comp'],'cf_comparison_point_'.$i.'_title',true),
            'detail' => get_post_meta($int_setting_ids['comp'],'cf_comparison_point_'.$i.'_detail',true),
            'point' => $i,
        );
    }
 ?>

<div class="boxPointComparison">
    <ul class="listPointComparison">
        <?php foreach ($list as $key => $value) {  ?>
            <li class="listPointComparison__items">
                <div class="listPointComparison__title">
                    <div class="listPointComparison__point">POINT<?php echo $value['point'];?></div>
                    <div class="listPointComparison__ico listPointComparison__ico-point<?php echo $value['point'];?>">
                        <div class="listPointComparison__icoWrap">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/ico_point_03_0<?php echo $value['point'];?>.png" alt="POINT<?php echo $value['point'];?>" width="140" height="140" class="img-r verAlign-b" />
                        </div>
                    </div>
                    <div><?php echo $value['title'];?></div>
                </div>

                <div class="listPointComparison__detail"><?php echo apply_filters('the_content',$value['detail']);?></div>
            </li>
        <?php } ?>
    </ul>
</div>
