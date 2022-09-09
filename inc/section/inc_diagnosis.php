<?php
    global $setting_diagnosis;

    if($setting_diagnosis['flg_rankng']){
        $is_section = false;
    }else {
        $is_section = true;
    }
?>

<?php if($is_section){ ?>
<section class="contentCommon">

<?php } ?>

        <div class="boxCommon borCommon boxDiagnosis">
            <div class="boxDiagnosis__in">
                <h2 class="boxDiagnosis__title">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/head_diagnosis_01.png" width="678" height="142" class="img-r verAlign-b"/>
                </h2>
                <div class="boxDiagnosis__detail">
                    <?php
                      get_template_part('inc/form/inc_diagnosis');
                    ?>
                </div>
            </div>
        </div>

<?php if($is_section){ ?>
</section>
<?php } ?>
