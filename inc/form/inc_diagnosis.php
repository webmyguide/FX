<?php
    global $formSetting;

    $formType = '';
 ?>


<form action="" method="get" class="formStepup">
    <?php
        $formInfo = getFormInfo();
    ?>

    <div class="formStepup__step" data-stepup-box="0">
        <div class="formStepup__panel">
            <img src="<?php echo get_template_directory_uri(); ?>/images/tit_diagnosis_01.png" alt="5ステップ診断" width="653" height="144" class="formStepup__title img-r" />
            <div class="formStepup__start btnMain btnMain-arrow btnDiagnosisStart cursor-p" data-stepup-form="0" data-step="1">
                スタート
            </div>
        </div>


        <?php $step_title_num = 2; ?>
        <?php $step_num = 2; ?>
        <?php foreach ($formInfo as $keyForm => $itemForm) { ?>
            <div class="formStepup__panel">
                <?php if($itemForm['type'] != 'hidden'){ ?>
                    <div class="formStepup__question" data-stepup-question="<?php echo $step_title_num; ?>">
                        <div class="formStepup__prog">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/prog_stepup_0<?php echo $step_title_num-1; ?>.png" alt="5ステップ診断" width="242" height="28" class="img-r" />
                        </div>
                        <?php echo $itemForm['title']; ?>
                    </div>
                    <?php $step_title_num++; ?>
                <?php } ?>

                <div class="formStepup__operation">

                    <?php if($itemForm['type'] != 'hidden'){ ?>
                        <div class="formStepup__answer" data-stepup-answer="<?php echo $step_num; ?>">
                            <ul class="listFormStepup">
                                <?php foreach ($itemForm['inputList'] as $keyInput => $itemInput) { ?>
                                    <?php if( !isset($itemInput['def_flg']) ){?>
                                        <li class="listFormStepup__item">
                                            <?php
                                                    $add_class_label= (isset($itemInput['class_s']))? $itemInput['class_s']:'';
                                                    $itemFormId = 'st'.$itemForm['name'].$keyInput.$formType;
                                                    $itemFormChecked = ( (!empty( $itemForm['key'] ) && $itemForm['key'] == $itemInput['value']) || empty( $itemForm['key'] ) )?'checked="checked"': '';
                                            ?>
                                            <input class="listFormStepup__radio <?php echo $add_class_label; ?>" type="radio" name="<?php echo $itemForm['name']; ?>" id="d_<?php echo $itemFormId; ?>" value="<?php echo $itemInput['value']; ?>" <?php echo $itemFormChecked; ?>><label for="d_<?php echo $itemFormId; ?>"><span><?php echo $itemInput['label']; ?></span></label>
                                        </li>
                                    <?php } ?>
                                <?php } ?>
                            </ul>
                        </div>
                        <?php $step_num++; ?>
                    <?php } ?>

                </div>
            </div>
        <?php } ?>


        <div class="formStepup__action">
            <div class="formStepup__return" data-stepup-return="0" data-step="1" style="display: none;">
                <div class="btnSub btnStepupReturn cursor-p">戻る</div>
            </div>

            <div class="formStepup__result" style="display: none;"  data-stepup-result="0">
                <input id="submit" type="submit" value="診断する" class="btnMain btnStepupResult cursor-p" />
            </div>

            <div class="formStepup__next" data-stepup-form="0" data-step="1" >
                <div class="btnMain btnMain-arrow btnStepupNext cursor-p">次へ</div>
            </div>
        </div>

    </div>
    <?php foreach ($formInfo as $keyForm => $itemForm) { ?>
        <?php if($itemForm['type'] == 'hidden'){ ?>
            <?php foreach ($itemForm['inputList'] as $keyInput => $itemInput) { ?>
                <input type="<?php echo $itemForm['type']; ?>" name="<?php echo $itemForm['name']; ?>" value="<?php echo $itemInput['value']; ?>">
            <?php } ?>
        <?php } ?>
    <?php } ?>
    <input type="hidden" name="s" />
</form>
