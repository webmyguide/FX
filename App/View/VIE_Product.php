<?php

//--------------------------------------------------------------------------------------------------
// 案件情報
//--------------------------------------------------------------------------------------------------
function view_product($product = null,$setting = null) {

    //コンテンツの有無
    //int
    $is_title_out = false;
    $is_title_sp_out = true;
    $is_title_in = true;
    $is_detail = true;
    $is_action = false;
    $is_wordMouth = true;
    $reputation_type = '';
    $ranking_num = false;
    $is_pickup = false;
    $is_sort = false;
    $tag_title = 'h3';
    $data_type = 2;

    //詳細ページ
    if ( isset($setting['page_detail']) ) {
        $is_title_out = true;
        $is_title_sp_out = false;
        $is_title_in = false;
        $is_action = true;
        $reputation_type = 'detail';
        $tag_title = 'h1';
        $data_type = 1;

    }elseif ( isset($setting['page_archive']) ) {

    }elseif ( isset($setting['page_search']) ) {
        $is_sort = true;
    }

    $official_url = get_cushion_url($product->ID);
    $thumb = wp_get_attachment_image_src(get_post_field('product_thumb',$product->ID),'full');
    $reputation_com = get_field_object('product_reputation_0',$product->ID);
    $title_sub = get_post_meta($product->ID,'product_title_sub',ture);
    $reputation_list = get_reputation_field($product->ID,$reputation_type);


    $is_detail_btn = get_post_meta($product->ID,'is_product_detail_btn',true);
    $data_text_list = get_product_data_text_field($product->ID,$data_type);
    if($is_detail) $detail_text = get_post_meta($product->ID,'product_detail',ture);
    $catchcopy = get_post_meta($product->ID,'product_catchcopy',ture);

    //順位の設定
    if(isset($setting['ranking'])){
        $ranking_num = $setting['ranking'];
        if($ranking_num < 4) $ico_class .= ' icoRank-0'.$setting['ranking'];
    }

    if ( isset($setting['page_detail']) ) {
        $list_point = array();
        for ($i=1; $i <= 2; $i++) {
            $text_point = get_post_meta($product->ID,'product_point_text_'.$i,ture);
            if(!empty($text_point)) $list_point[] = $text_point;
        }
    }

    //スプレッドの取得
    $list_spread = array();
    for ($i=1; $i <= 7; $i++) {
        $fielddata_spread = get_field_object('product_spread_'.$i,$product->ID);
        $list_spread[] = array(
            'id' => $i,
            'label' => $fielddata_spread['label'],
            'value' => $fielddata_spread['value']['text'],
            'num' => $fielddata_spread['value']['num'],
        );
    }


    if ( isset($setting['page_detail']) ) {
        //スワップの取得
        $list_swap = array();
        for ($i=1; $i <= 7; $i++) {
            $fielddata_swap = get_field_object('product_swap_'.$i,$product->ID);
            $list_swap[] = array(
                'id' => $i,
                'label' => $fielddata_swap['label'],
                'value' => $fielddata_swap['value']['text'],
                'num' => $fielddata_swap['value']['num'],
            );
        }

        //特徴の取得
        $list_features = array();
        for ($i=1; $i <= 3; $i++) {
            $fielddata_features = get_field_object('product_features_'.$i,$product->ID);
            $list_features[] = array(
                'id' => $i,
                'title' => $fielddata_features['value']['title'],
                'detail' => $fielddata_features['value']['detail'],
            );
        }
    }

?>


    <article class="boxCommon product" <?php if(!empty($is_sort)){ ?>data-sort-id="<?php echo $product->ID;?>"<?php } ?>>
        <<?php echo $tag_title;?> class="titleProduct">
            <?php if (!empty($ranking_num)) { ?><div class="titleProduct__rank icoRank <?php echo $ico_class;?>"><?php echo $ranking_num;?></div><?php  } ?>
            <div class="titleProduct__in<?php if (!empty($ranking_num)) { ?> titleProduct__in-rank<?php  } ?>">
                <div class="titleProduct__title">
                    <?php echo $product->post_title;?>
                </div>
                <?php if ( isset($setting['page_detail']) ) { ?>
                    <div class="titleProduct__sub">
                        ★<?php echo $title_sub;?>★
                    </div>
                <?php } ?>
            </div>
        </<?php echo $tag_title;?>>

        <?php if ( isset($setting['page_detail']) ) { ?>
            <div class="product__catch product__catch-detail"><?php echo $catchcopy;?></div>
        <?php } ?>

        <?php if ( isset($setting['page_detail']) && !empty($list_point) ) { ?>
            <div class="product__point product__point-sp">
                <div>
                    <ul>
                        <?php foreach ($list_point as $point) { ?>
                            <li><?php echo $point;?></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        <?php } ?>

        <div class="product__head">
            <?php if ( !isset($setting['page_detail']) ) { ?>
                <div class="product__catch product__catch-sp"><?php echo $catchcopy;?></div>
            <?php } ?>

            <div class="product__figure <?php if ( isset($setting['page_detail']) ) { ?>product__figure-detail<?php } ?>">
                <a href="<?php echo $official_url; ?>"><img src="<?php echo $thumb[0]; ?>" alt="<?php echo $thumb[3]; ?>" width="<?php echo $thumb[1]; ?>" height="<?php echo $thumb[2]; ?>" class="figureProduct__img img-r verAlign-b"/></a>
            </div>

            <div class="product__info">
                <?php if ( !isset($setting['page_detail']) ) { ?>
                    <div class="product__catch product__catch-pc"><?php echo $catchcopy;?></div>
                <?php } ?>

                <?php if ( isset($setting['page_detail']) && !empty($list_point) ) { ?>
                    <div class="product__point product__point-pc">
                        <div>
                            <ul>
                                <?php foreach ($list_point as $point) { ?>
                                    <li><?php echo $point;?></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                <?php } ?>

                <div class="product__lead">
                    <?php echo apply_filters('the_content',$detail_text);?>
                </div>
            </div>
        </div>


        <?php if ( !isset($setting['page_detail']) ) { ?>
            <div class="product__spread boxSpread">
                <div class="boxSpread__title">スプレッド</div>
                <ul class="boxSpread__list">
                    <?php foreach ($list_spread as $spread) {  ?>
                        <?php
                            $spread_label = $spread['label'];
                            $spread_label = str_replace('南アフリカ','南アフリカ<br>',$spread_label);
                        ?>
                        <li class="boxSpread__items">
                            <div class="boxSpread__ico"><img src="<?php echo get_template_directory_uri(); ?>/images/ico_country_0<?php echo $spread['id'];?>.png" alt="<?php echo $spread['label'];?>" width="60" height="60" class="img-r verAlign-b" /></div>
                            <div class="boxSpread__currency"><?php echo $spread_label;?></div>
                            <div class="boxSpread__fee"><?php echo $spread['value'];?></div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        <?php } ?>


        <?php if ($data_text_list && !isset($setting['page_detail'])) { ?>
            <div class="product__data">
                <ul class="listDataText">
                    <?php foreach ($data_text_list as $data_text_key => $data_text) { ?>
                        <?php if ($data_text_key < 6) { ?>
                            <li class="listDataText__items <?php if (!empty($data_text['class_1'])) echo "listDataText__items-".$data_text['class_1']; ?>">
                                <div class="listDataText__label"><?php echo $data_text['label'];?></div>
                                <div class="listDataText__value">
                                    <?php if (array_search($data_text['type'], array('beginner','demo','smartphone',)) !== FALSE) { ?>
                                        <?php echo $data_text['mark'];?>
                                    <?php }else if($data_text['type'] == 'cashback') { ?>
                                        <span class="txtCol-f2"><?php echo $data_text['value'];?></span>
                                    <?php }else{ ?>
                                        <?php echo $data_text['value'];?>
                                    <?php } ?>
                                </div>

                            </li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </div>
        <?php } ?>

        <?php if ( isset($setting['page_detail']) ) { ?>
            <div class="product__action actionProduct actionProduct-midle">
                <div class="actionProduct__official actionProduct__official-midle">
                    <a href="<?php echo $official_url;?>" class="btnMain btnMain-arrow btnOfficial">
                        公式ページはこちら
                        <span class="ani-deco-gura"></span>
                    </a>
                </div>
            </div>
        <?php }else{ ?>
            <div class="product__action actionProduct">
                <?php if ($is_detail_btn ) { ?>
                    <div class="actionProduct__detail"><a href="<?php echo get_permalink($product->ID); ?>" class="btnSub btnSub-arrow btnDetail">詳細を見る</a></div>
                <?php  } ?>
                <div class="actionProduct__official">
                    <a href="<?php echo $official_url;?>" class="btnMain btnMain-arrow btnOfficial">
                        公式はこちら
                        <span class="ani-deco-gura"></span>
                    </a>
                </div>
            </div>
        <?php } ?>



        <?php if ( isset($setting['page_detail']) ) { ?>
            <div class="product__content">
                <h2 class="titleProduct">
                    <div class="titleProduct__in">
                        <div class="titleProduct__title">
                            基本情報
                        </div>
                    </div>
                </h2>

                <h3 class="titleProductSub">取扱いサービス</h3>
                <div class="product__data">
                    <ul class="listDataText">
                        <?php foreach ($data_text_list as $data_text_key => $data_text) { ?>
                            <?php if ($data_text_key < 6) { ?>
                                <li class="listDataText__items <?php if (!empty($data_text['class_1'])) echo "listDataText__items-".$data_text['class_1'].'Detail'; ?>">
                                    <div class="listDataText__label"><?php echo $data_text['label'];?></div>
                                    <div class="listDataText__value">
                                        <?php if (array_search($data_text['type'], array('beginner','demo','smartphone',)) !== FALSE) { ?>
                                            <img src="<?php echo get_template_directory_uri(); ?>/images/ico_mark_0<?php echo $data_text['mark_id'];?>.png" alt="<?php echo $data_text['mark'];?>" width="52" height="52" class="listDataText__mark img-r verAlign-b" />
                                        <?php }else if($data_text['type'] == 'cashback') { ?>
                                            <span class="txtCol-f2"><?php echo $data_text['value'];?></span>
                                        <?php }else{ ?>
                                            <?php echo $data_text['value'];?>
                                        <?php } ?>
                                    </div>
                                </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </div>

                <h3 class="titleProductSub">スワップポイント</h3>
                <div class="product__data">
                    <ul class="listDataText">
                        <?php foreach ($list_swap as $data_swap) { ?>
                            <li class="listDataText__items listDataText__items-swap">
                                <div class="listDataText__label listDataText__label-swap"><?php echo $data_swap['label'];?></div>
                                <div class="listDataText__value">
                                    <?php echo $data_swap['value'];?>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>

                <h3 class="titleProductSub">スプレッド</h3>
                <div class="product__data">
                    <ul class="listDataText">
                        <?php foreach ($list_spread as $data_spread) { ?>
                            <li class="listDataText__items listDataText__items-swap">
                                <div class="listDataText__label listDataText__label-swap"><?php echo $data_spread['label'];?></div>
                                <div class="listDataText__value">
                                    <?php echo $data_spread['value'];?>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>

            <div class="product__content">
                <h2 class="titleProduct">
                    <div class="titleProduct__in">
                        <div class="titleProduct__title">
                            主な特徴
                        </div>
                    </div>
                </h2>

                <ul class="listFeatures">
                    <?php foreach ($list_features as $data_features) { ?>
                        <li class="listFeatures__items">
                            <div class="listFeatures__head">
                                <div class="listFeatures__ico">特徴<span><?php echo $data_features['id'];?></span></div>
                                <div class="listFeatures__title"><?php echo $data_features['title'];?></div>
                            </div>
                            <div class="listFeatures__detail">
                                <?php echo $data_features['detail'];?>
                            </div>
                        </li>

                    <?php } ?>
                </ul>
            </div>


            <div class="product__action actionProduct actionProduct-bottom">
                <div class="actionProduct__official actionProduct__official-bottom">
                    <a href="<?php echo $official_url;?>" class="btnMain btnMain-arrow btnOfficial">
                        公式ページで無料口座開設
                        <span class="ani-deco-gura"></span>
                    </a>
                </div>
            </div>
        <?php } ?>




    </article>

<?php
}

function view_product_simple($product = null,$setting = null) {

    //タイトルの設定
    //サムネイル画像
    $thumb = wp_get_attachment_image_src(get_post_field('product_thumb',$product->ID),'full');


    //順位の設定
    if(isset($setting['ranking'])){
        $ranking_num = $setting['ranking'];
    }

    $official_url = get_cushion_url($product->ID);


?>

    <div class="listRankingSimple__rank">
        <img src="<?php echo get_template_directory_uri(); ?>/images/ico_ranking_s_0<?php echo $ranking_num;?>.png" alt="<?php echo $ranking_num;?>位" width="192" height="48" class="img-r verAlign-b" />
    </div>

    <a href="<?php echo $official_url; ?>" class="itemRankingSimple__figure">
        <img src="<?php echo $thumb[0]; ?>" alt="<?php echo $product->post_title; ?>" width="<?php echo $thumb[1]; ?>" height="<?php echo $thumb[2]; ?>" class="itemRankingSimple__img img-r"/>
    </a>


<?php
}

//--------------------------------------------------------------------------------------------------
// 案件アーカイブ
//--------------------------------------------------------------------------------------------------
function view_product_archive() { ?>
    <?php
        $args = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'orderby' => 'meta_value_num',
            'meta_key' => 'sort_num',
            'order' => 'ASC',
        );
        $posts = get_posts($args);
    ?>


    <?php if ( !empty($posts) ){ ?>
        <?php
            $setting = array(
                'page_archive' => true,
            );
            foreach ($posts as $key => $value) {
                view_product_comparison($value,$setting);
            }
        ?>
    <?php }else{ ?>
        <p>表示できる案件がありません</p>
    <?php } ?>

<?php
    }



//--------------------------------------------------------------------------------------------------
// 案件比較
//--------------------------------------------------------------------------------------------------
function view_product_comparison($product = null,$setting = null) {

    //コンテンツの有無
    //int
    $reputation_type = '';
    $data_type = 2;

    $official_url = get_cushion_url($product->ID);
    $thumb = wp_get_attachment_image_src(get_post_field('product_thumb',$product->ID),'full');
    $reputation_com = get_field_object('product_reputation_0',$product->ID);
    $title_sub = get_post_meta($product->ID,'product_title_sub',ture);
    $reputation_list = get_reputation_field($product->ID,$reputation_type);


    $is_detail_btn = get_post_meta($product->ID,'is_product_detail_btn',true);
    $data_text_list = get_product_data_text_field($product->ID,$data_type);
    if($is_detail) $detail_text = get_post_meta($product->ID,'product_detail',ture);
    $catchcopy = get_post_meta($product->ID,'product_catchcopy',ture);



    if ( isset($setting['page_detail']) ) {
        $list_point = array();
        for ($i=1; $i <= 2; $i++) {
            $text_point = get_post_meta($product->ID,'product_point_text_'.$i,ture);
            if(!empty($text_point)) $list_point[] = $text_point;
        }
    }

    //スプレッドの取得
    $list_spread = array();
    for ($i=1; $i <= 7; $i++) {
        $fielddata_spread = get_field_object('product_spread_'.$i,$product->ID);
        $list_spread[] = array(
            'id' => $i,
            'label' => $fielddata_spread['label'],
            'value' => $fielddata_spread['value']['text'],
            'num' => $fielddata_spread['value']['num'],
            'mark' => get_mark($fielddata_spread['value']['mark']),
            'mark_id' => $fielddata_spread['value']['mark'],
        );
    }


    if ( isset($setting['page_detail']) ) {
        //スワップの取得
        $list_swap = array();
        for ($i=1; $i <= 7; $i++) {
            $fielddata_swap = get_field_object('product_swap_'.$i,$product->ID);
            $list_swap[] = array(
                'id' => $i,
                'label' => $fielddata_swap['label'],
                'value' => $fielddata_swap['value']['text'],
                'num' => $fielddata_swap['value']['num'],
            );
        }

        //特徴の取得
        $list_features = array();
        for ($i=1; $i <= 3; $i++) {
            $fielddata_features = get_field_object('product_features_'.$i,$product->ID);
            $list_features[] = array(
                'id' => $i,
                'title' => $fielddata_features['value']['title'],
                'detail' => $fielddata_features['value']['detail'],
            );
        }
    }

?>
    <article class="boxCommon product" data-sort-id="<?php echo $product->ID;?>">
        <h2 class="titleProduct">
            <div class="titleProduct__in<?php if (!empty($ranking_num)) { ?> titleProduct__in-rank<?php  } ?>">
                <div class="titleProduct__title">
                    <?php echo $product->post_title;?>
                </div>
            </div>
        </h2>


        <div class="product__head product__head-comparison">
            <div class="product__figure product__figure-comparison">
                <a href="<?php echo $official_url; ?>"><img src="<?php echo $thumb[0]; ?>" alt="<?php echo $thumb[3]; ?>" width="<?php echo $thumb[1]; ?>" height="<?php echo $thumb[2]; ?>" class="figureProduct__img img-r verAlign-b"/></a>

                <div class="product__action actionProduct actionProduct-figure actionProduct-pc">
                    <div class="actionProduct__official actionProduct__official-figure">
                        <a href="<?php echo $official_url;?>" class="btnMain btnMain-arrow btnOfficial">
                            お申し込み
                            <span class="ani-deco-gura"></span>
                        </a>
                    </div>
                    <div class="actionProduct__detail actionProduct__detail-figure"><a href="<?php echo get_permalink($product->ID); ?>" class="btnSub btnSub-arrow btnDetail">詳細を見る</a></div>
                </div>
            </div>

            <div class="product__info product__info-comparison">
                <ul class="listDataText">
                    <?php foreach ($data_text_list as $data_text_key => $data_text) { ?>
                        <?php if ($data_text_key < 6) { ?>
                            <li class="listDataText__items listDataText__items-comparison">
                                <div class="listDataText__label"><?php echo $data_text['label'];?></div>
                                <div class="listDataText__value">
                                    <?php if (array_search($data_text['type'], array('beginner','demo','smartphone','pair',)) !== FALSE) { ?>
                                        <img src="<?php echo get_template_directory_uri(); ?>/images/ico_mark_0<?php echo $data_text['mark_id'];?>.png" alt="<?php echo $data_text['mark'];?>" width="52" height="52" class="listDataText__mark img-r verAlign-b" />
                                    <?php }else if($data_text['type'] == 'cashback') { ?>
                                        <span class="txtCol-f2"><?php echo $data_text['value'];?></span>
                                    <?php }else{ ?>
                                        <?php echo $data_text['value'];?>
                                    <?php } ?>
                                </div>
                            </li>
                        <?php } ?>
                    <?php } ?>
                </ul>


                <h3 class="titleProductSub titleProductSub-comparison">スプレッド</h3>
                <div class="product__data">
                    <ul class="listDataText">
                        <?php foreach ($list_spread as $data_spread) { ?>
                            <li class="listDataText__items listDataText__items-swapComp">
                                <div class="listDataText__label listDataText__label-swap"><?php echo $data_spread['label'];?></div>
                                <div class="listDataText__value">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/ico_mark_0<?php echo $data_spread['mark_id'];?>.png" alt="<?php echo $data_spread['mark'];?>" width="52" height="52" class="listDataText__mark img-r verAlign-b" /><br>
                                    <div class="listDataText__text"><?php echo $data_spread['value'];?></div>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>

            </div>
        </div>

        <div class="product__action actionProduct actionProduct-sp">
            <div class="actionProduct__detail"><a href="<?php echo get_permalink($product->ID); ?>" class="btnSub btnSub-arrow btnDetail">詳細を見る</a></div>
            <div class="actionProduct__official">
                <a href="<?php echo $official_url;?>" class="btnMain btnMain-arrow btnOfficial">
                    お申し込み
                    <span class="ani-deco-gura"></span>
                </a>
            </div>
        </div>
    </article>

<?php
}
