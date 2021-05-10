<div class="wrap">
<h1>MBFF Settings</h1>
<form method="post" action="options.php"> 
<?php
\settings_fields('mbff');
\do_settings_sections('mbff-settings.php');
\submit_button( 'Save Settings' );
?>
</form>
</div>