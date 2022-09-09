<?php
    global $setting_sort;
    //ソートリスト
    $list_sort = get_sort_search();
 ?>
 <ul class="listSort" data-sort-product="true" data-sort-page="<?php echo $setting_sort['page'];?>" >
     <?php foreach ($list_sort as $key => $sort) { ?>
         <?php if( $sort['group'] == 'spread' ) { ?>

            <?php foreach ($sort['list'] as $sortList) { ?>
                <li class="listSort__item listSort__item-spread listSort__item-spreadSp">
                    <div class="listSort__label">
                        <?php echo $sort['name'];?><br>
                        <?php echo $sortList['name'];?>
                    </div>
                    <div class="listSort__btn">
                        <a href="javascript:void(0)" class="btnSort btnSort-asc" data-where="<?php echo $sortList['where'];?>" data-order="ASC"></a>
                        <a href="javascript:void(0)" class="btnSort btnSort-desc" data-where="<?php echo $sortList['where'];?>" data-order="DESC"></a>
                    </div>
                </li>
            <?php } ?>
            <li class="listSort__item listSort__item-spread listSort__item-spreadPc">
                <div class="listSort__groupLabel"><?php echo $sort['name'];?></div>
                <?php foreach ($sort['list'] as $sortList) { ?>
                    <div class="listSort__spread">
                        <div class="listSort__label">
                            <?php echo $sortList['name'];?>
                        </div>
                        <div class="listSort__btn">
                            <a href="javascript:void(0)" class="btnSort btnSort-asc" data-where="<?php echo $sortList['where'];?>" data-order="ASC"></a>
                            <a href="javascript:void(0)" class="btnSort btnSort-desc" data-where="<?php echo $sortList['where'];?>" data-order="DESC"></a>
                        </div>
                    </div>
                <?php } ?>
            </li>
        <?php }else{ ?>
            <li class="listSort__item">
                <div class="listSort__label">
                    <?php echo $sort['name'];?>
                </div>
                 <div class="listSort__btn">
                     <a href="javascript:void(0)" class="btnSort btnSort-asc" data-where="<?php echo $sort['where'];?>" data-order="ASC"></a>
                     <a href="javascript:void(0)" class="btnSort btnSort-desc" data-where="<?php echo $sort['where'];?>" data-order="DESC"></a>
                 </div>
            </li>
         <?php } ?>
     <?php } ?>
 </ul>
