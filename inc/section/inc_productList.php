<?php
    global $int_setting_ids;
    global $ranking_posts;
    //
    $title_kw = get_post_meta($int_setting_ids['top'],'cf_top_comparison_title',true);
    $detail_kw = get_post_meta($int_setting_ids['top'],'cf_top_comparison_detail',true);

    $title_kw = str_replace('2021年', date('Y').'年', $title_kw);

 ?>

<section class="contentCommon contentProductList">
    <?php
        //title
        view_title_common($title_kw);
    ?>
    <?php if( !empty($detail_kw) ){ ?>
        <div class="contentCommon__catch">
            <?php echo apply_filters('the_content',$detail_kw); ?>
        </div>
    <?php } ?>
    <div class="contentProductList__wrap">

        <div class="contentProductList__box">
            <?php foreach ($ranking_posts as $key => $value) {  ?>
                <article>
                    <?php
                        //案件ジャンルの取得
                        $product_name =  get_post_meta($int_setting_ids['common'],'cf_s_common_product',true);
                        //サムネの取得
                        $thumb_s = wp_get_attachment_image_src(get_post_field('product_thumb_s',$value->ID),'full');
                        if(empty($thumb_s)) $thumb_s = wp_get_attachment_image_src(get_post_field('product_thumb',$value->ID),'full');
                        //スプレッドの取得
                        $list_spread = array();
                        for ($i=1; $i <= 8; $i++) {
                            $fielddata_spread = get_field_object('product_spread_'.$i,$value->ID);
                            $list_spread[] = array(
                                'label' => $fielddata_spread['label'],
                                'value' => $fielddata_spread['value']['text'],
                                'num' => $fielddata_spread['value']['num'],
                            );
                        }

                        //データの取得
                        $data_text_list = get_product_data_text_field($value->ID);
                        $data_pair = $data_text_list[0];
                        $data_unit = $data_text_list[4];
                        $data_beginner = $data_text_list[1];
                        $data_demo = $data_text_list[2];
                        $data_smartphone = $data_text_list[3];
                        $data_cashback = $data_text_list[5];

                        //ラベルを消すクラス
                        $class_label = '';
                        if($key > 0){
                            $class_label = 'listComT__label-nonePc';
                        }
                    ?>
                    <ul class="listComT">
                        <li class="listComT__items listComT__items-product">
                            <div class="listComT__label listComT__label-product <?php echo $class_label;?>"><?php echo $product_name;?>会社</div>
                            <div class="listComT__value listComT__value-product">
                                <div class="listComT__figure">
                                    <img src="<?php echo $thumb_s[0]; ?>" alt="<?php echo $product->post_title; ?>" width="<?php echo $thumb_s[1]; ?>" height="<?php echo $thumb_s[2]; ?>" class="img-r verAlign-b"/>
                                </div>
                                <?php echo $value->post_title;?>
                            </div>
                        </li>
                        <li class="listComT__items listComT__items-spread">
                            <div class="listComT__label listComT__label-group <?php echo $class_label;?>">
                                スプレッド
                            </div>
                            <div class="listComT__value listComT__value-group">
                                <?php foreach ($list_spread as $spread_key => $spread_value) {  ?>
                                    <div class="listComT__items listComT__items-spreadPart <?php if($spread_key == 7) echo 'disp-sp';?>">
                                        <div class="listComT__label part <?php echo $class_label;?>"><?php echo $spread_value['label'];?></div>
                                        <div class="listComT__value">
                                            <?php echo $spread_value['value'];?>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </li>


                        <li class="listComT__items listComT__items-<?php echo $data_beginner['class_1'];?>">
                            <div class="listComT__label <?php echo $class_label;?>"><?php echo $data_beginner['label'];?></div>
                            <div class="listComT__value">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/ico_mark_0<?php echo $data_beginner['mark_id'];?>.png" alt="<?php echo $data_beginner['mark'];?>" width="52" height="52" class="listComT__mark img-r verAlign-b" />
                            </div>
                        </li>
                        <li class="listComT__items listComT__items-<?php echo $data_demo['class_1'];?>">
                            <div class="listComT__label <?php echo $class_label;?>"><?php echo $data_demo['label'];?></div>
                            <div class="listComT__value">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/ico_mark_0<?php echo $data_demo['mark_id'];?>.png" alt="<?php echo $data_demo['mark'];?>" width="52" height="52" class="listComT__mark img-r verAlign-b" />
                            </div>
                        </li>
                        <li class="listComT__items listComT__items-<?php echo $data_smartphone['class_1'];?>">
                            <div class="listComT__label <?php echo $class_label;?>"><?php echo $data_smartphone['label'];?></div>
                            <div class="listComT__value">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/ico_mark_0<?php echo $data_smartphone['mark_id'];?>.png" alt="<?php echo $data_smartphone['mark'];?>" width="52" height="52" class="listComT__mark img-r verAlign-b" />
                            </div>
                        </li>
                        <li class="listComT__items listComT__items-<?php echo $data_pair['class_1'];?>">
                            <div class="listComT__label <?php echo $class_label;?>"><?php echo $data_pair['label'];?></div>
                            <div class="listComT__value">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/ico_mark_0<?php echo $data_pair['mark_id'];?>.png" alt="<?php echo $data_pair['mark'];?>" width="52" height="52" class="listComT__mark img-r verAlign-b" />
                            </div>
                        </li>
                        <li class="listComT__items listComT__items-<?php echo $data_unit['class_1'];?>">
                            <div class="listComT__label <?php echo $class_label;?>"><?php echo $data_unit['label'];?></div>
                            <div class="listComT__value">
                                <?php echo $data_unit['value'];?>
                            </div>
                        </li>
                        <li class="listComT__items listComT__items-<?php echo $data_cashback['class_1'];?>">
                            <div class="listComT__label <?php echo $class_label;?>"><?php echo $data_cashback['label'];?></div>
                            <div class="listComT__value txtCol-f4">
                                <span class="txtCol-f2"><?php echo $data_cashback['value'];?></span>
                            </div>
                        </li>
                    </ul>
                </article>
            <?php } ?>
        </div>
    </div>
</section>
