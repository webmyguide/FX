<?php

 ?>
 <div class="wrap">
     <main class="wrap__main">

             <section class="contentCommon">
                 <?php
                     //title
                     $post_title = get_the_title();
                     view_title_common($post_title,'h1');
                 ?>
                 <div class="boxCommon borCommon boxPrivacy">
                     <?php echo apply_filters('the_content',$post->post_content); ?>
                 </div>
             </section>

     </main>
 </div>
