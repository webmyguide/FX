<?php
    global $formSetting;

    $formInfo = getFormInfo();
    $moreFlg = false;

    $formType = '';
    if( isset($formSetting['formType']) ){
        $formType = '-'.$formSetting['formType'];
    }
?>


<form action="<?php echo esc_url( get_home_url() ); ?>" method="get" data-search-hits="">
    <div class="formSearch"<?php if (!empty($formSetting['is_accordion'])) { ?> data-accordion-search="" <?php if ($formSetting['is_accordion'] == 'close') { ?>style="display:none;"<?php } ?><?php } ?>>
        <div class="formSearch__select">
            <?php foreach ($formInfo as $keyForm => $itemForm) { ?>
                <?php if($itemForm['type'] == 'hidden'){ ?>
                    <?php foreach ($itemForm['inputList'] as $keyInput => $itemInput) { ?>
                        <div class="itemsHits">
                            <input type="<?php echo $itemForm['type']; ?>" name="<?php echo $itemForm['name']; ?>" value="<?php echo $itemInput['value']; ?>">
                        </div>
                    <?php } ?>
                <?php }else if($itemForm['class'] == 'inputFeatures'){ ?>
                    <ul class="listForm listForm-features itemsHits">
                        <?php $list_num = 1; ?>
                        <?php foreach ($itemForm['inputList'] as $keyInput => $itemInput) { ?>
                            <?php if( !isset($itemInput['def_flg']) ){?>
                                <li class="listForm__item">
                                    <?php
                                        $itemFormClass = $itemForm['class'];
                                        $itemFormName = ( $itemForm['type'] == 'checkbox' )?$itemForm['name'].'[]': $itemForm['name'];
                                        $itemFormId = $itemForm['name'].$keyInput.$formType;
                                        $itemFormChecked = ( (!empty( $itemForm['key'] ) && $itemForm['key'] == $itemInput['value']) || empty( $itemForm['key'] ) )?'checked="checked"': '';
                                    ?>
                                    <input class="<?php echo $itemFormClass; ?>" type="<?php echo $itemForm['type']; ?>" name="<?php echo $itemFormName; ?>" id="<?php echo $itemFormId; ?>" value="<?php echo $itemInput['value']; ?>" <?php echo $itemFormChecked; ?>>
                                    <label for="<?php echo $itemFormId; ?>">
                                        <div><?php echo $itemInput['label']; ?></div>
                                        <img src="<?php echo get_template_directory_uri(); ?>/images/ico_form_features_0<?php echo $list_num; ?>.png" alt="<?php echo $itemInput['label']; ?>" width="52" height="52" class="<?php echo $itemFormClass; ?>__ico <?php echo $itemFormClass; ?>__ico-<?php echo $list_num; ?> img-r verAlign-b" />
                                    </label>
                                </li>
                                <?php $list_num++; ?>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                <?php }else{ ?>
                    <?php if($keyForm == 4) $moreFlg = true; ?>
                        <div class="formSearch__item itemsHits <?php if($keyForm >= 5) echo "formSearch__item-hide"; ?>">
                            <div class="formSearch__label <?php if($keyForm%2 == 1) echo "formSearch__label-even"; ?> <?php if(!empty($itemForm['label_class'])){ echo $itemForm['label_class']; } ?>"><div><?php echo $itemForm['title']; ?></div></div>
                            <div class="formSearch__input">
                                <?php if($itemForm['type'] == 'select'){?>
                                    <select name="search_element_0" class="selecting">
                                        <?php foreach ($itemForm['inputList'] as $selecting) {?>
                                            <option value="<?php echo $selecting['value']; ?>"><?php echo $selecting['label']; ?></option>
                                        <?php } ?>
                                    </select>
                                <?php }else { ?>
                                    <ul class="listForm">
                                        <?php foreach ($itemForm['inputList'] as $keyInput => $itemInput) { ?>
                                            <?php if( !isset($itemInput['def_flg']) ){?>
                                                <li class="listForm__item">
                                                    <?php
                                                            $itemFormClass = $itemForm['class'];
                                                            $itemFormName = ( $itemForm['type'] == 'checkbox' )?$itemForm['name'].'[]': $itemForm['name'];
                                                            $itemFormId = $itemForm['name'].$keyInput.$formType;
                                                            $itemFormChecked = ( (!empty( $itemForm['key'] ) && $itemForm['key'] == $itemInput['value']) || empty( $itemForm['key'] ) )?'checked="checked"': '';
                                                    ?>
                                                    <input class="<?php echo $itemFormClass; ?>" type="<?php echo $itemForm['type']; ?>" name="<?php echo $itemFormName; ?>" id="<?php echo $itemFormId; ?>" value="<?php echo $itemInput['value']; ?>" <?php echo $itemFormChecked; ?>>
                                                    <label for="<?php echo $itemFormId; ?>"><span <?php if(isset($itemInput['class'])){ ?>class="<?php echo $itemInput['class']; ?>"<?php } ?> ><?php echo $itemInput['label']; ?></span></label>
                                                </li>
                                            <?php } ?>
                                        <?php } ?>
                                    </ul>
                                <?php } ?>
                            </div>
                        </div>
                <?php } ?>
            <?php } ?>
        </div>
        <?php if($moreFlg){ ?>
            <div class="formSearch__add">
                <a href="javascript:void(0)" class="btnSub" id="tggleInput">＋こだわり条件を追加</a>
            </div>
        <?php } ?>

        <div class="formSearch__action">
            <div>該当<span data-hits-target="">--</span>件</div>
            <input type="hidden" name="s" <?php if($formSetting['isIdName']){ ?>id="s-<?php echo $formSetting['formType']; ?>"<?php } ?> />
            <input type="submit" class="btnMain btnForm" value="上記の条件で検索">
        </div>
    </div>
</form>
