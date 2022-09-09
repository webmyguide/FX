<?php

//--------------------------------------------------------------------------------------------------
// ショートコード
//--------------------------------------------------------------------------------------------------
function sc_keyword_content( $atts, $content = null ) {

    //GETでキーワードを変える
    $kw = get_keyword(3);

    return $kw;
}
add_shortcode('kw_c', 'sc_keyword_content');


function sc_keyword_content_top( $atts, $content = null ) {

    //GETでキーワードを変える
    $kw = get_keyword(2);

    return $kw;
}
add_shortcode('kw_ct', 'sc_keyword_content_top');


function sc_now( $atts, $content = null ) {

    $now = date('Y').'年'.date('n').'月';

    return $now;
}
add_shortcode('now', 'sc_now');

function sc_line( $atts, $content = null ) {
    extract(shortcode_atts(array(
            'type' => 0,
    ), $atts));

    $line = '<div class="balloonLine">';
    if($type == 1){
        $line .= '<figure class="balloonLine__figure balloonLine__figure-r"><img src="'.get_template_directory_uri().'/images/thumb_balloon_01.png" width="116" height="110" class="img-r verAlign-b"/></figure>';
        $line .= '<div class="balloonLine__chatting balloonLine__chatting-r">'.$content.'</div>';
    }else {
        $line .= '<div class="balloonLine__chatting">'.$content.'</div>';
        $line .= '<figure class="balloonLine__figure"><img src="'.get_template_directory_uri().'/images/thumb_balloon_01.png" width="116" height="110" class="img-r verAlign-b"/></figure>';
    }
    $line .= '</div>';

    return $line;
}
add_shortcode('line', 'sc_line');



function sc_product_list( $atts, $content = null ) {

    $args = array(
        'posts_per_page' => -1,
        'post_type' => 'product',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
        'meta_key' => 'sort_num',
    );

    $product_posts = get_posts( $args );

    $ele = '<div class="pulldown"><select name="wmp_age">';
    foreach ($product_posts as $value) {
        $ele .= '<option value="'.$value->ID.'">'.$value->post_title.'</option>';
    }
    $ele .= '</select></div>';

    return $ele;
}
add_shortcode('wmp_product', 'sc_product_list');
