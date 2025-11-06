<?php
// glpi/plugins/notificationhubs/inc/profile.class.php

class PluginNotificationhubsProfile extends Profile {
   const RIGHT_SEND     = 'plugin:notificationhubs:send';
   const RIGHT_CONFIG   = 'plugin:notificationhubs:config';
   const RIGHT_VIEWLOGS = 'plugin:notificationhubs:viewlogs';

   // Ta bort alla direkta DB-operationer i install/uninstall.
   // Rätter exponeras via dessa konstanter och kontrolleras i front/*.php med Session::checkRight(...).
   // Tilldelning av rätter görs i GLPI UI under Profiles.

   // Frivilligt: ge GLPI en beskrivning (används i vissa vyer)
   public static function getAllRights() {
      return [
         self::RIGHT_SEND     => __('Skicka incidentnotiser'),
         self::RIGHT_CONFIG   => __('Konfigurera NotificationHubs plugin'),
         self::RIGHT_VIEWLOGS => __('Visa historik för utskick'),
      ];
   }
}
