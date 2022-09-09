<?php


/*-------------------------------------------*/
/*	　タイトル
/*-------------------------------------------*/
function view_title_common( $text = '',$tag = 'h2',$class = '' ,$type = '' ){
    //$textが空だったら何もしない
    if(empty($text)) return false;

    if(!empty($type)) $class = $class.' titleCommon-'.$type;

    if( $tag == 'h1' ){
        $base_class = 'titlePage';
    }else {
        $base_class = 'titleCommon';
    }
?>
    <<?php echo $tag; ?> class="<?php echo $base_class;?> <?php echo $class;?>"><?php echo $text; ?></<?php echo $tag; ?>>

<?php
}

function view_title_ribbon( $text = '',$class = '' ,$type = '' ){
    //$textが空だったら何もしない
    if(empty($text)) return false;

    if(!empty($type)) $class = $class.' titleCommon-'.$type;
?>
    <div class="titleRibbon <?php echo $class;?>"><div><?php echo $text; ?></div></div>

<?php
}

/*-------------------------------------------*/
/*	　評価
/*-------------------------------------------*/
function view_reputation_common($value = '', $class = '' ,$type = '' ){
    //$valueが空だったら何もしない
    if(empty($value)) return false;


    if($type == 1){
        $class .= ' icoReputation-s';
    }elseif ($type == 2) {
        $class .= ' icoReputation-l';
    }elseif ($type == 3) {
        $class .= ' icoReputation-ss';
    }

    // 桁数を求める
    $max = strlen($value);
    $d_su = array();
    for($i=0; $i<$max; $i++){
    	// 右側から1桁ずつ配列に格納していく
    	$d_su[$i] = substr($value,($max-$i-1),1);
    }

    //ゲージの処理
    $base_star_body_w = 216;
    $base_star_int_r = 2/$base_star_body_w;
    $base_star_margin_r = 10/$base_star_body_w;
    $base_star_r = 35/$base_star_body_w;
    $range_digit_f = ($base_star_r/10*$d_su[0])*100;
    $range_digit_s = 0;
    if(!empty($d_su[1])){
        $range_margin_r = $base_star_margin_r*$d_su[1];
        $range_star_r = $base_star_r*$d_su[1];
        $range_digit_s = ($base_star_int_r + $range_margin_r + $range_star_r)*100;
    }
    $res_range = $range_digit_f + $range_digit_s;
    if($res_range >= 100) $res_range = 100;

?>
    <div class="icoReputation <?php echo $class;?>"><div class="icoReputation__range" style="width:<?php echo $res_range;?>%;"></div></div>

<?php
}
/*-------------------------------------------*/
/*	　評価2
/*-------------------------------------------*/
function view_reputation_simple($value = '', $class = '' ,$type = '' ){
    //$valueが空だったら何もしない
    if(empty($value)) return false;

    // 桁数を求める

    if($value['value'] == 1){
        $reputation = '◎';
    }elseif ($value['value'] == 2) {
        $reputation = '○';
    }elseif ($value['value'] == 3) {
        $reputation = '△';
    }elseif ($value['value'] == 4) {
        $reputation = '☓';
    }else {
        $reputation = '◎';
    }

?>
    <div class="icoReputationS <?php echo $class;?>">
        <div class="icoReputationS__label"><?php echo $value['label'];?></div>
        <?php echo $reputation;?>
    </div>

<?php
}
?>
