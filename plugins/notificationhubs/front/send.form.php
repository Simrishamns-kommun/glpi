<?php
// glpi/plugins/notificationhubs/front/send.form.php

include('../../../inc/includes.php');

// Hjälpfunktion för HTML-escaping
if (!function_exists('esc')) {
   function esc($s) { return htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
}

Session::checkRight(PluginNotificationhubsProfile::RIGHT_SEND, READ);

$config = PluginNotificationhubsConfig::getConfig();
$errors = [];
$okmsg  = null;

if (isset($_POST['send'])) {
   // CSRF-validering kräver post-datan i denna GLPI-signatur
   Session::checkCSRF($_POST);

   $title    = trim($_POST['title'] ?? '');
   $message  = trim($_POST['message'] ?? '');
   $severity = trim($_POST['severity'] ?? 'Info');
   $tagsRaw  = trim($_POST['tags'] ?? '');
   $tags     = array_values(array_filter(array_map('trim', explode(',', $tagsRaw ?: $config['default_tags']))));

   if (!$config['endpoint_url']) $errors[] = 'Saknar endpoint URL i konfigurationen.';
   if (!$config['function_key']) $errors[] = 'Saknar function key i konfigurationen.';
   if ($title === '' || $message === '') $errors[] = 'Titel och meddelande krävs.';

   if (!$errors) {
      $payload = json_encode([
         'title'    => $title,
         'message'  => $message,
         'severity' => $severity,
         'tags'     => $tags
      ], JSON_UNESCAPED_UNICODE);

      $ch = curl_init();
      curl_setopt_array($ch, [
         CURLOPT_URL            => $config['endpoint_url'],
         CURLOPT_POST           => true,
         CURLOPT_HTTPHEADER     => [
            'Content-Type: application/json',
            'x-functions-key: '.$config['function_key']
         ],
         CURLOPT_POSTFIELDS     => $payload,
         CURLOPT_RETURNTRANSFER => true,
         CURLOPT_TIMEOUT        => 15
      ]);
      $resp = curl_exec($ch);
      $http = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      $err  = curl_error($ch);
      curl_close($ch);

      $parsed = null;
      if ($http >= 200 && $http <= 299) {
         $parsed = json_decode($resp, true);
         $okmsg  = 'Utskick skickat.';
      }

      // Hämta aktuell användare
      $sentById   = Session::getLoginUserID();
      $sentByName = '';
      if ($sentById) {
         $u = new User();
         if ($u->getFromDB($sentById)) {
            // getFriendlyName ger "Efternamn Förnamn (inloggnamn)" beroende på inställning
            $sentByName = method_exists($u, 'getFriendlyName') ? $u->getFriendlyName() : $u->getName();
         }
      }

      // Logga alltid
      PluginNotificationhubsLog::add([
         'title'         => $title,
         'message'       => $message,
         'severity'      => $severity,
         'tags'          => implode(',', $tags),
         'http_code'     => $http ?: null,
         'api_response'  => $resp ?: $err,
         'message_id'    => $parsed['messageId'] ?? null,
         'outcome_state' => $parsed['outcome']['State']  ?? null,
         'success_count' => $parsed['outcome']['Success'] ?? null,
         'sent_by_id'    => $sentById ?: null,
         'sent_by_name'  => $sentByName
      ]);

      if ($err) {
         $errors[] = 'cURL error: '.$err;
      } elseif ($http < 200 || $http > 299) {
         $errors[] = 'API svarade HTTP '.$http.'; kropp: '.esc($resp);
      }
   }
}

Html::header('Skicka incidentnotis', $_SERVER['PHP_SELF'], 'tools', 'plugins');

echo '<form method="post" action="'.esc($_SERVER['PHP_SELF']).'">';
// CSRF-token
echo Html::hidden('_glpi_csrf_token', ['value' => Session::getNewCSRFToken()]);

echo '<table class="tab_cadre_fixe">';
echo '<tr><th colspan="2">Skicka meddelande via Notification Hubs</th></tr>';

if ($errors) {
   echo '<tr class="tab_bg_1"><td colspan="2"><div class="b">'.implode('<br>', array_map(
      fn($e) => esc($e),
      $errors
   )).'</div></td></tr>';
}
if ($okmsg) {
   echo '<tr class="tab_bg_1"><td colspan="2"><div class="b">'.esc($okmsg).'</div></td></tr>';
}

echo '<tr class="tab_bg_1"><td>Titel</td><td><input type="text" name="title" size="80" required></td></tr>';
echo '<tr class="tab_bg_1"><td>Meddelande</td><td><textarea name="message" rows="5" cols="80" required></textarea></td></tr>';

echo '<tr class="tab_bg_1"><td>Allvarlighetsgrad</td><td>';
echo '<select name="severity">';
foreach (['Info','Low','Medium','High','Critical'] as $s) {
   echo '<option value="'.$s.'">'.$s.'</option>';
}
echo '</select></td></tr>';

echo '<tr class="tab_bg_1"><td>Taggar (komma-separerade)</td><td>';
echo '<input type="text" name="tags" size="80" placeholder="'.esc($config['default_tags']).'">';
echo '<div class="comment">Lämna tomt för standard: '.esc($config['default_tags']).'</div>';
echo '</td></tr>';

echo '<tr class="tab_bg_2 center"><td colspan="2">';
echo '<input type="submit" name="send" class="btn btn-primary" value="Skicka">';
echo ' <a class="vsubmit" href="history.list.php">Visa historik</a>';
echo '</td></tr>';

echo '</table></form>';

Html::footer();
