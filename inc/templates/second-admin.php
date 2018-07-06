<h1>Настройки Темы</h1>
<p>настройки темы</p>
<?php settings_errors(); ?>
<form class="" action="options.php" method="post">
  <?php settings_fields('second-settings-group'); ?>
  <?php do_settings_sections('andrey-second'); ?>
  <?php submit_button('Сохранить'); ?>
</form>
