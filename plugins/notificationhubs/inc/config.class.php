<?php
// glpi/plugins/notificationhubs/inc/config.class.php

class PluginNotificationhubsConfig extends CommonDBTM {
   public $dohistory = false;

   // Följ SCCM-mönstret: använd global konfig-rätt
   static $rightname = 'config';

   // VIKTIGT: tala om vilken tabell som hör till denna klass
   public static $table = 'glpi_plugin_notificationhubs_configs';

   public static function getTypeName($nb = 0) {
      return 'NotificationHubs konfiguration';
   }

   // Hämta första (enda) konfigraden
   public static function getConfig() {
      global $DB;

      $it = $DB->request([
         'SELECT' => ['id', 'endpoint_url', 'function_key', 'default_tags'],
         'FROM'   => self::$table,
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

   // Spara konfig
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
            self::$table,
            $data,
            ['id' => (int)$current['id']]
         );
      } else {
         $DB->insert(self::$table, $data);
      }
   }

   // Formulär-UI, renderas av displayFullPageForItem
   public function showForm($ID, array $options = []) {
      if (!Session::haveRight(self::$rightname, UPDATE)) {
         Html::displayRightError();
         return false;
      }

      $c = self::getConfig();
      $esc = function($s) { return htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); };

      echo '<form method="post" action="'.Toolbox::getItemTypeFormURL(__CLASS__).'" >';
      echo Html::hidden('_glpi_csrf_token', ['value' => Session::getNewCSRFToken()]);
      echo '<table class="tab_cadre_fixe">';
      echo '<tr><th colspan="2">'.self::getTypeName().'</th></tr>';

      echo '<tr class="tab_bg_1"><td>Azure Function endpoint URL</td><td>';
      echo '<input type="text" name="endpoint_url" size="80" value="'.$esc($c['endpoint_url']).'">';
      echo '</td></tr>';

      echo '<tr class="tab_bg_1"><td>Function key (x-functions-key)</td><td>';
      echo '<input type="password" name="function_key" size="60" value="'.$esc($c['function_key']).'">';
      echo '</td></tr>';

      echo '<tr class="tab_bg_1"><td>Default tags (komma-separerade)</td><td>';
      echo '<input type="text" name="default_tags" size="60" value="'.$esc($c['default_tags']).'">';
      echo '</td></tr>';

      echo '<tr class="tab_bg_2 center"><td colspan="2">';
      echo '<input type="submit" name="update" class="btn btn-primary" value="Spara">';
      echo '</td></tr>';

      echo '</table></form>';

      return true;
   }
}
