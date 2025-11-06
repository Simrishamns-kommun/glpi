<?php
// glpi/plugins/notificationhubs/front/config.form.php

include('../../../inc/includes.php');

// Hjälpfunktion för HTML-escaping
if (!function_exists('esc')) {
   function esc($s) { return htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
}

// Tillåt antingen plugin-rätt ELLER global konfig-rätt (superadmin)
$has_plugin_cfg = Session::haveRight(PluginNotificationhubsProfile::RIGHT_CONFIG, UPDATE);
$has_global_cfg = Session::haveRight('config', UPDATE);
if (!$has_plugin_cfg && !$has_global_cfg) {
   // Visa standardfelruta för rättigheter
   Html::displayRightError();
   exit;
}

$config = PluginNotificationhubsConfig::getConfig();

if (isset($_POST['save'])) {
   // VIKTIGT: skicka in post-datan till checkCSRF i denna GLPI-version
   Session::checkCSRF($_POST);

   $endpoint = trim($_POST['endpoint_url'] ?? '');
   $key      = trim($_POST['function_key'] ?? '');
   $tags     = trim($_POST['default_tags'] ?? '');
   PluginNotificationhubsConfig::updateConfig($endpoint, $key, $tags);
   Html::back();
}

Html::header('NotificationHubs Sender', $_SERVER['PHP_SELF'], 'config', 'plugins');

echo '<form method="post" action="'.esc($_SERVER['PHP_SELF']).'">';
// skapa/inkludera CSRF-token (namn: _glpi_csrf_token)
echo Html::hidden('_glpi_csrf_token', ['value' => Session::getNewCSRFToken()]);

echo '<table class="tab_cadre_fixe">';
echo '<tr><th colspan="2">Konfiguration</th></tr>';

echo '<tr class="tab_bg_1"><td>Azure Function endpoint URL</td><td>';
echo '<input type="text" name="endpoint_url" size="80" value="'.esc($config['endpoint_url']).'">';
echo '</td></tr>';

echo '<tr class="tab_bg_1"><td>Function key (x-functions-key)</td><td>';
echo '<input type="password" name="function_key" size="60" value="'.esc($config['function_key']).'">';
echo '</td></tr>';

echo '<tr class="tab_bg_1"><td>Default tags (komma-separerade)</td><td>';
echo '<input type="text" name="default_tags" size="60" value="'.esc($config['default_tags']).'">';
echo '</td></tr>';

echo '<tr class="tab_bg_2 center"><td colspan="2">';
echo '<input type="submit" name="save" class="btn btn-primary" value="Spara">';
echo '</td></tr>';

echo '</table></form>';

Html::footer();
