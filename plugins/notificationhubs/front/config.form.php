<?php
// glpi/plugins/notificationhubs/front/config.form.php

include('../../../inc/includes.php');
require_once __DIR__.'/../inc/config.class.php';

// Global config-rätt, samma som SCCM
Session::checkRight('config', UPDATE);

if (isset($_POST['update'])) {
   // Skicka in token-strängen istället för hela $_POST
   $token = $_POST['_glpi_csrf_token'] ?? '';
   //Session::checkCSRF($token);
   Session::checkRight("config", UPDATE);

   PluginNotificationhubsConfig::updateConfig(
      trim($_POST['endpoint_url'] ?? ''),
      trim($_POST['function_key'] ?? ''),
      trim($_POST['default_tags'] ?? '')
   );

   Session::addMessageAfterRedirect('Konfiguration sparad', false, INFO, false);
   Html::back();
   exit;
}

// Hämta eller skapa singleton-raden och rendera den (inte "nytt objekt"-läge)
$conf = PluginNotificationhubsConfig::getConfig();
$id   = (int)($conf['id'] ?? 0);
if ($id === 0) {
   PluginNotificationhubsConfig::updateConfig($conf['endpoint_url'] ?? '', $conf['function_key'] ?? '', $conf['default_tags'] ?? 'role:all');
   $conf = PluginNotificationhubsConfig::getConfig();
   $id   = (int)($conf['id'] ?? 0);
}

$menus = ['config', 'plugins'];
PluginNotificationhubsConfig::displayFullPageForItem($id, $menus, $_GET);
