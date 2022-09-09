<?php
    //検索結果の案件リスト
    $search_posts = get_search_posts();
?>


<section class="contentCommon">
    <?php
        //title
        $posts_count =  (!empty($search_posts))? count($search_posts): 0 ;
        $title_search = '検索結果！'.$posts_count.'件見つかりました';
        view_title_common($title_search,'h1');
    ?>

    <div class="boxSort">
        <?php
            global $setting_sort;
            $setting_sort = array(
                'page' => 'search',
            );
            get_template_part('inc/box/inc_sort');
        ?>
    </div>

    <div data-sort-content="true">
        <?php
            $setting = array(
                'page_search' => true,
                'ranking' => 1,
            );
            foreach ($search_posts as $key => $search) {
                view_product($search,$setting);
                $setting['ranking']++;
             }
         ?>
    </div>
</section>
