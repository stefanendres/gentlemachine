<?php
  function footer_content(){
    $footer_menus = get_field('footer_menus', 'options');
    $footer_cta_link = get_field('footer_cta_link', 'options');
    ?>
    <div class="footer-menus-container">
      <?php foreach($footer_menus as $footer_menu) : ?>
        <nav class="footer-menu">
          <h4><?= $footer_menu['menu_heading'] ?></h4>
          <ul>
            <?php foreach($footer_menu['menu_links'] as $link_item): ?>
              <li>
                <?php if ($link_item['menu_link']['target']): ?>
                  <a class="footer-link" target="_blank" rel="noopener noreferrer" href="<?= $link_item['menu_link']['url'] ?>">
                <?php else: ?>
                  <a class="footer-link" href="<?= $link_item['menu_link']['url'] ?>">
                <?php endif; ?>
                  <?= $link_item['menu_link']['title'] ?>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </nav>
      <?php endforeach; ?>
    </div>
    <?php if ($footer_cta_link['target']): ?>
      <a class="footer-cta-link" target="_blank" rel="noopener noreferrer" href="<?= $footer_cta_link['url'] ?>">
    <?php else: ?>
      <a class="footer-cta-link" href="<?= $footer_cta_link['url'] ?>">
    <?php endif; ?>
      <?= $footer_cta_link['title'] ?>
    </a>
    <?php
  }
?>