<?php
    global $int_setting_ids;

    // $fields = get_field_objects($int_setting_ids['contact']);


 ?>
 <div class="wrap">
    <main class="wrap__main">
        <section class="contentCommon">
            <?php
                //title
                view_title_common($post->post_title,'h1');
            ?>


            <div class="boxCommon boxContact borCommon">
                <?php echo apply_filters('the_content',$post->post_content); ?>


                <?php echo do_shortcode('[contact-form-7 id="2258" title="お問い合わせ"]'); ?>

            </div>

        </section>
    </main>
 </div>
