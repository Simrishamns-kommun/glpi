<?php
// glpi/plugins/notificationhubs/setup.php

define('PLUGIN_NOTIFICATIONHUBS_VERSION', '1.0.4');

require_once __DIR__ . '/inc/profile.class.php';
// OBS: ingen menu.class.php behövs längre

function plugin_init_notificationhubs() {
   global $PLUGIN_HOOKS;

   $PLUGIN_HOOKS['csrf_compliant']['notificationhubs'] = true;

   // Config-sidan nås via kugghjulet i Plugins-listan
   $PLUGIN_HOOKS['config_page']['notificationhubs'] = 'front/config.form.php';

   // Visa "Push notifications" under Helpdesk
   $PLUGIN_HOOKS['menu_toadd']['notificationhubs'] = [
      'helpdesk' => '/plugins/notificationhubs/front/send.form.php'
   ];
   // Sätt explicit länktext
   $PLUGIN_HOOKS['submenu_entry']['notificationhubs']['helpdesk'] = [
      'title' => 'Push notifications',
      'page'  => '/plugins/notificationhubs/front/send.form.php'
   ];
}

function plugin_version_notificationhubs() {
   return [
      'name'           => 'NotificationHubs Sender',
      'version'        => PLUGIN_NOTIFICATIONHUBS_VERSION,
      'author'         => 'Simrishamns kommun',
      'homepage'       => 'https://simrishamn.se',
      'license'        => 'AGPLv3+',
      'minGlpiVersion' => '10.0.0'
   ];
}

function plugin_notificationhubs_check_prerequisites() {
   return version_compare(GLPI_VERSION, '10.0.0', '>=');
}

function plugin_notificationhubs_check_config() { return true; }

function plugin_notificationhubs_install() {
   $migration = new Migration(PLUGIN_NOTIFICATIONHUBS_VERSION);

   $migration->addPostQuery("
      CREATE TABLE IF NOT EXISTS `glpi_plugin_notificationhubs_configs` (
        `id`            INT NOT NULL AUTO_INCREMENT,
        `endpoint_url`  VARCHAR(512) DEFAULT NULL,
        `function_key`  VARCHAR(256) DEFAULT NULL,
        `default_tags`  VARCHAR(512) DEFAULT NULL,
        `created_at`    TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at`    TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
   ");

   $migration->addPostQuery("
      INSERT INTO `glpi_plugin_notificationhubs_configs` (`endpoint_url`,`function_key`,`default_tags`)
      SELECT NULL, NULL, 'role:all'
      FROM DUAL
      WHERE NOT EXISTS (SELECT 1 FROM `glpi_plugin_notificationhubs_configs` LIMIT 1);
   ");

   $migration->addPostQuery("
      CREATE TABLE IF NOT EXISTS `glpi_plugin_notificationhubs_logs` (
        `id`             INT NOT NULL AUTO_INCREMENT,
        `title`          VARCHAR(200) NOT NULL,
        `message`        MEDIUMTEXT NOT NULL,
        `severity`       VARCHAR(20) NOT NULL,
        `tags`           MEDIUMTEXT NULL,
        `http_code`      INT NULL,
        `api_response`   MEDIUMTEXT NULL,
        `message_id`     VARCHAR(128) NULL,
        `outcome_state`  VARCHAR(64) NULL,
        `success_count`  INT NULL,
        `sent_by_id`     INT NULL,
        `sent_by_name`   VARCHAR(200) NULL,
        `created_at`     TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`),
        KEY `idx_created_at` (`created_at`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
   ");

   $migration->executeMigration();
   return true;
}

function plugin_notificationhubs_uninstall() {
   $migration = new Migration(PLUGIN_NOTIFICATIONHUBS_VERSION);
   $migration->addPostQuery("DROP TABLE IF EXISTS `glpi_plugin_notificationhubs_logs`;");
   $migration->addPostQuery("DROP TABLE IF EXISTS `glpi_plugin_notificationhubs_configs`;");
   $migration->executeMigration();
   return true;
}
