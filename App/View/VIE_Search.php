<?php


/*-------------------------------------------*/
/*	　検索質問のデータ
/*-------------------------------------------*/
function getFormInfo() {

  // $topType = get_transient( 'topPageType');

  //int
    // $keyAge = 'old22';
    // $keyGakureki = 'daigaku';
    // $keyZyoukyou = 'shain';
    // $keyNenshuu = 0;
    // $keyJob = 'sonota,hoiku,kaigo';
    // $keySex = 'lady';
    // $keyGyoukai = 'mikeiken';


	//$_GETを取得
	$key1 = ( isset($_GET[ 'sk1' ]) )? $_GET[ 'sk1' ]: 12;
	$key2 = ( isset($_GET[ 'sk2' ]) )? $_GET[ 'sk2' ]: 22;
	$key3 = ( isset($_GET[ 'sk3' ]) )?  $_GET[ 'sk3' ]: 32;
	// $key4 = ( isset($_GET[ 'sk4' ]) )? $_GET[ 'sk4' ]: 42;
	// $key5 = ( isset($_GET[ 'sk5' ]) )? $_GET[ 'sk5' ]: 52;
    // if ($_GET[ 'job' ]) $keyJob = $_GET[ 'job' ];
    // if ($_GET[ 'sex' ]) $keySex = $_GET[ 'sex' ];
	// if ($_GET[ 'gyoukai' ]) $keyGyoukai = $_GET[ 'gyoukai' ];

  // //学歴が高卒の場合未経験に変更
  // if($keyGakureki == 'kousotsu') $keyGyoukai = 'mikeiken';
  // //学歴が大卒以外の場合
  // if($keyGakureki != 'daigaku') $keyGakureki = 'kousotsu,senmon,sonota';
  // //状況がフリーターの場合
  // if( ($keyZyoukyou == 'freeter') || ($keyZyoukyou == 'nisotsu') ) $keyZyoukyou = 'freeter,nisotsu';


    $list[] = array(
        'name' => 'sk1',
		'title' => '特徴',
        'title_s' => '特徴',
        'class' => 'inputFeatures',
        'type' => 'checkbox',
        'key' => $key1,
        'inputList' => array(
            0 => array(
            'value' => '11',
            'label' => '--選択して下さい--',
            'def_flg' => true,
            ),
            1 => array(
            'value' => '12',
            'label' => '初心者におすすめ',
            ),
            2 => array(
            'value' => '13',
            'label' => '少額から始められる',
            ),
			3 => array(
			'value' => '14',
			'label' => '手数料が安い',
			),
			4 => array(
			'value' => '15',
			'label' => 'デモトレード対応',
			),
			5 => array(
			'value' => '16',
			'label' => 'キャッシュバックが充実',
			),
			6 => array(
			'value' => '17',
			'label' => 'スワップ金利が高め',
			),
        ),
    );

    $list[] = array(
        'name' => 'sk2',
		'title' => '取引単位',
        'title_s' => '取引単位',
		'class' => 'radioInput',
        'label_class' => 'formSearch__label-m1',
        'type' => 'radio',
        'key' => $key2,
        'inputList' => array(
            0 => array(
            'value' => '21',
            'label' => '--選択して下さい--',
            'def_flg' => true,
            ),
            1 => array(
            'value' => '22',
            'label' => '指定なし',
            ),
            2 => array(
            'value' => '23',
            'label' => '100通貨',
            ),
			3 => array(
			'value' => '24',
			'label' => '1,000通貨',
			),
			4 => array(
			'value' => '25',
			'label' => '10,000通貨',
			),
        ),
    );

    $list[] = array(
        'name' => 'sk3',
		'title' => 'スマホ対応',
        'title_s' => 'スマホ対応',
        'class' => 'checkboxInput',
		'label_class' => 'formSearch__label-m1',
        'type' => 'checkbox',
        'key' => $key3,
        'inputList' => array(
            0 => array(
            'value' => '31',
            'label' => '--選択して下さい--',
            'def_flg' => true,
            ),
            1 => array(
            'value' => '32',
            'label' => 'iPhone',
            ),
            2 => array(
            'value' => '33',
            'label' => 'Android',
            ),
        ),
    );

    return $list;
}




?>
