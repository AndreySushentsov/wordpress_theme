<h1>Форма обратной связи</h1>
<?php settings_errors(); ?>
<form class="" action="options.php" method="post">
  <?php settings_fields('second-contact-options'); ?>
  <?php do_settings_sections('andrey-theme-contact'); ?>
  <?php submit_button('Сохранить'); ?>
</form>
