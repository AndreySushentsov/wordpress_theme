<h1>Настройки стилей.</h1>
<?php settings_errors(); ?>
<form id="custom_css_form" action="options.php" method="post">
  <?php settings_fields('second-custom-css'); ?>
  <?php do_settings_sections('andrey-second-css'); ?>
  <?php submit_button('Сохранить'); ?>
</form>
