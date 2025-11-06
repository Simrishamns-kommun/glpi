<?php
// glpi/plugins/notificationhubs/inc/menu.class.php

class PluginNotificationhubsMenu extends CommonGLPI {

   public static function getTypeName($nb = 0) {
      return 'NotificationHubs';
   }

   public static function getMenuName() {
      return self::getTypeName();
   }

   // Bygger menyn under Plugins. Barnlänkar pekar på våra front-sidor.
   public static function getMenuContent() {
      $menu = [];

      $menu['title'] = self::getTypeName();

      // Standardsida när man klickar på pluginets namn
      $menu['page']  = 'plugins/notificationhubs/front/send.form.php';

      $children = [];

      if (Session::haveRight(PluginNotificationhubsProfile::RIGHT_SEND, READ)) {
         $children['send'] = [
            'title' => 'Skicka meddelande',
            'page'  => 'plugins/notificationhubs/front/send.form.php'
         ];
      }

      if (Session::haveRight(PluginNotificationhubsProfile::RIGHT_VIEWLOGS, READ)) {
         $children['history'] = [
            'title' => 'Historik',
            'page'  => 'plugins/notificationhubs/front/history.list.php'
         ];
      }

      if (!empty($children)) {
         $menu['children'] = $children;
      }

      return $menu;
   }
}
