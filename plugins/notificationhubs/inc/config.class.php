<?php
// glpi/plugins/notificationhubs/inc/config.class.php

class PluginNotificationhubsConfig extends CommonDBTM {
   public $dohistory = false;
   // Använd plugin-rätten för konfiguration i vyer som kontrollerar rättighet
   static $rightname = PluginNotificationhubsProfile::RIGHT_CONFIG;

   /**
    * Hämta första (och enda) konfigraden utan deprecated DBmysqlIterator-signatur.
    */
   public static function getConfig() {
      global $DB;

      $it = $DB->request([
         'SELECT' => ['id', 'endpoint_url', 'function_key', 'default_tags'],
         'FROM'   => 'glpi_plugin_notificationhubs_configs',
         'ORDER'  => 'id',
         'LIMIT'  => 1
      ]);

      $row = null;
      if ($it && count($it)) {
         foreach ($it as $r) { $row = $r; break; }
      }

      if (!$row) {
         return [
            'id'           => 0,
            'endpoint_url' => null,
            'function_key' => null,
            'default_tags' => 'role:all'
         ];
      }
      return $row;
   }

   /**
    * Uppdatera eller skapa konfigraden.
    */
   public static function updateConfig($endpoint, $key, $tags) {
      global $DB;

      $current = self::getConfig();
      $data = [
         'endpoint_url' => ($endpoint !== '') ? $endpoint : null,
         'function_key' => ($key !== '') ? $key : null,
         'default_tags' => ($tags !== '') ? $tags : 'role:all'
      ];

      if (!empty($current['id'])) {
         $DB->update(
            'glpi_plugin_notificationhubs_configs',
            $data,
            ['id' => (int)$current['id']]
         );
      } else {
         $DB->insert('glpi_plugin_notificationhubs_configs', $data);
      }
   }
}
