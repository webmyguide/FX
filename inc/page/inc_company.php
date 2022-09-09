<?php
    global $int_setting_ids;

    $fields = get_field_objects($int_setting_ids['company']);


    $max_tabel = count($fields['cf_company_table']['value']);


    $table_list = array();
    for ($i=0; $i < $max_tabel; $i++) {

        if( !empty( $fields['cf_company_table']['value']['tr_'.($i+1)] ) ){
            $table_list[] = array(
                'label' => $fields['cf_company_table']['sub_fields'][$i]['label'],
                'value' => $fields['cf_company_table']['value']['tr_'.($i+1)],
            );
        }
    }


 ?>
 <div class="wrap">
    <main class="wrap__main">
        <section class="contentCommon">
            <?php
                //title
                view_title_common($fields['cf_company_pagetitle']['value'],'h1');
            ?>

            <?php if( !empty( $table_list ) ){ ?>
                <div class="boxCommon borCommon boxCompany boxCompany-table">
                    <table>
                        <?php foreach ($table_list as $key => $value) { ?>
                            <tr>
                                <th>
                                    <?php echo $value['label']; ?>
                                </th>
                                <td>
                                    <?php echo $value['value']; ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            <?php } ?>

            <?php if( !empty( $post->post_content ) ){ ?>
                <div class="boxCommon boxCompany">
                    <?php echo apply_filters('the_content',$post->post_content); ?>
                </div>
            <?php } ?>
        </section>
    </main>
 </div>
