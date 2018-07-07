<h1>Настройки Темы</h1>
<p>настройки темы</p>
<?php
  $firstName = esc_attr(get_option('first_name'));
  $lastName = esc_attr(get_option('last_name'));
  $fullName = $firstName . ' ' . $lastName;
?>
<?php settings_errors(); ?>
<div class="admin-sidebar">
  <div class="admin-sidebar__username"><?php print $fullName; ?></div>
</div>
<form class="" action="options.php" method="post">
  <?php settings_fields('second-settings-group'); ?>
  <?php do_settings_sections('andrey-second'); ?>
  <?php submit_button('Сохранить'); ?>
</form>
