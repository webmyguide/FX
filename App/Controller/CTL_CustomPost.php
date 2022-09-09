<?php

function create_custom_post() {

    // 案件
    register_post_type(
    	'product',
    	array(
    		'label' => '案件',
    		'hierarchical' => false,
    		'public' => true,
    		'show_ui' => true,
    		'has_archive' => true,
    		'menu_position' => 5,
        'publicly_queryable' => true,
    		'query_var' => true,
    		'rewrite' =>
    				array( 'slug' => 'product' ),
    				array( 'with_front' => true, ),
            'show_in_nav_menus' => false,
    				'supports' => array(
    					'title',
    					'editor',
    					'thumbnail',
    					'custom-fields',
    					'page-attributes'
    				)
    	)
    );

    // register_post_type(
    // 	'rankingByCondition',
    // 	array(
    // 		'label' => '条件別ランキング',
    // 		'hierarchical' => false,
    // 		'public' => true,
    // 		'show_ui' => true,
    // 		'has_archive' => true,
    // 		'menu_position' => 5,
    //     'publicly_queryable' => true,
    // 		'query_var' => true,
    // 		'rewrite' =>
    // 				array( 'slug' => 'rankingByCondition' ),
    // 				array( 'with_front' => true, ),
    //         'show_in_nav_menus' => false,
    // 				'supports' => array(
    // 					'title',
    // 					'editor',
    // 					'thumbnail',
    // 					'custom-fields',
    // 					'page-attributes'
    // 				)
    // 	)
    // );

    register_post_type(
    	'word-mouth',
    	array(
    		'label' => '口コミ',
    		'hierarchical' => false,
    		'public' => true,
    		'show_ui' => true,
    		'has_archive' => true,
    		'menu_position' => 5,
            'publicly_queryable' => true,
    		'query_var' => true,
    		'rewrite' =>
    				array( 'slug' => 'word-mouth' ),
    				array( 'with_front' => true, ),
            '       show_in_nav_menus' => false,
    				'supports' => array(
    					'title',
    					'editor',
    					'thumbnail',
    					'custom-fields',
    					'page-attributes'
    				)
    	)
    );

    // ランキングリスト
    register_post_type(
        'ranking',
        array(
            'label' => 'ランキングリスト',
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => false,
            'has_archive' => true,
            'menu_position' => 5,
            'query_var' => true,
            'rewrite' =>
                    array( 'slug' => 'ranking' ),
                    array( 'with_front' => true, ),
            'show_in_nav_menus' => true,
            'supports' => array(
                'title',
                'editor',
                'thumbnail',
                'custom-fields',
                'page-attributes'
            )
        )
    );

    // // ランキングリスト
    // register_post_type(
    //     'feature',
    //     array(
    //         'label' => '特徴別で探す',
    //         'hierarchical' => false,
    //         'public' => true,
    //         'show_ui' => true,
    //         'show_in_menu' => true,
    //         'query_var' => false,
    //         'has_archive' => true,
    //         'menu_position' => 5,
    //         'query_var' => true,
    //         'rewrite' =>
    //                 array( 'slug' => 'feature' ),
    //                 array( 'with_front' => true, ),
    //         'show_in_nav_menus' => true,
    //         'supports' => array(
    //             'title',
    //             'editor',
    //             'thumbnail',
    //             'custom-fields',
    //             'page-attributes'
    //         )
    //     )
    // );
    // // 口コミ
    // register_post_type(
    // 	'reviews',
    // 	array(
    // 		'label' => '口コミ',
    // 		'hierarchical' => false,
    // 		'public' => false,
    // 		'show_ui' => true,
    // 		'query_var' => false,
    // 		'has_archive' => true,
    // 		'menu_position' => 6,
    // 		'query_var' => true,
    // 		'rewrite' =>
    // 				array( 'slug' => 'reviews' ),
    // 				array( 'with_front' => true, ),
    //         'show_in_nav_menus' => false,
    // 				'supports' => array(
    // 					'title',
    // 					'editor',
    // 					'thumbnail',
    // 					'custom-fields',
    // 					'page-attributes'
    // 				)
    // 	)
    // );
    // // 商品
    // register_post_type(
    // 	'faq',
    // 	array(
    // 		'label' => 'FAQ',
    //         'hierarchical' => false,
    //         'public' => true,
    //         'show_ui' => true,
    //         'show_in_menu' => true,
    //         'query_var' => false,
    //         'has_archive' => true,
    //         'menu_position' => 7,
    //         'query_var' => true,
    // 		'rewrite' =>
    // 				array( 'slug' => 'faq' ),
    // 				array( 'with_front' => true, ),
    //         'show_in_nav_menus' => true,
    // 		'supports' => array(
    // 			'title',
    // 			'editor',
    // 			'thumbnail',
    // 			'custom-fields',
    // 			'page-attributes'
    // 		)
    // 	)
    // );
    //

}
add_action( 'init', 'create_custom_post' );
