<?php


/*
 * Primary Footer
 */
 function gm_footer_container_logo() {
   ?>
   <div class="logo-container">
     <img src="<?= gm_get_context()['theme_url'].'/svg/cant-decide-logo.svg'; ?>"/>
   </div>
   <?php
 }

function gm_footer_legal_link_list() { // TODO 27-7-22 : use wp-nav, or acf links, but make this accessible via admin
 $page_slugs = array(
   'terms-and-conditions',
   'imprint',
   'privacy-policy',
   'customer-service',

 );
 ?>
 <div class="menu menu-legal-links">
   <ul class="menu-list">
 <?php
 foreach ($page_slugs as $slug) {
   $page = get_page_by_path($slug);
   if ($page->post_status === "publish") {
     ?>
       <li class="menu-item">
         <a class="menu-link<?= (gm_get_current_page_slug() === $slug) ? ' active' : '' ?>" href="<?= get_permalink($page); ?>"><?= $page->post_title; ?></a>
       </li>
     <?php
   }
 }
 ?>
   </ul>
 </div>
 <?php
}



?>