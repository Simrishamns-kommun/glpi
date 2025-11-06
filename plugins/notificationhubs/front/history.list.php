<?php
// glpi/plugins/notificationhubs/front/history.list.php

include('../../../inc/includes.php');

Session::checkRight(PluginNotificationhubsProfile::RIGHT_VIEWLOGS, READ);

Html::header('NotificationHubs historik', $_SERVER['PHP_SELF'], 'tools', 'plugins');

if (isset($_GET['view'])) {
   PluginNotificationhubsLog::renderView($_GET['view']);
   echo '<div class="center mt2"><a class="vsubmit" href="history.list.php">Tillbaka</a></div>';
} else {
   PluginNotificationhubsLog::renderList();
}

Html::footer();
