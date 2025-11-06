<?php
// glpi/plugins/notificationhubs/inc/log.class.php

class PluginNotificationhubsLog extends CommonDBTM {
   public $dohistory = false;
   static $rightname = PluginNotificationhubsProfile::RIGHT_VIEWLOGS;

   public static function getTypeName($nb = 0) {
      return 'NotificationHubs logg';
   }

   public function getTabNameForItem(CommonGLPI $item, $withtemplate = 0) {
      return [];
   }

   private static function esc($s) {
      return htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
   }

   // Ny metod: konfliktsäker, statisk hjälpmetod för loggrader
   public static function record(array $data) {
      global $DB;

      $sentById   = $data['sent_by_id']   ?? Session::getLoginUserID();
      $sentByName = $data['sent_by_name'] ?? '';
      if ($sentById && $sentByName === '') {
         $u = new User();
         if ($u->getFromDB($sentById)) {
            $sentByName = method_exists($u, 'getFriendlyName') ? $u->getFriendlyName() : $u->getName();
         }
      }

      $row = [
         'title'         => $data['title'] ?? '',
         'message'       => $data['message'] ?? '',
         'severity'      => $data['severity'] ?? 'Info',
         'tags'          => $data['tags'] ?? '',
         'http_code'     => $data['http_code'] ?? null,
         'api_response'  => $data['api_response'] ?? null,
         'message_id'    => $data['message_id'] ?? null,
         'outcome_state' => $data['outcome_state'] ?? null,
         'success_count' => $data['success_count'] ?? null,
         'sent_by_id'    => $sentById ?: null,
         'sent_by_name'  => $sentByName
      ];

      $DB->insert('glpi_plugin_notificationhubs_logs', $row);
   }

   public static function renderList($params = []) {
      global $DB;

      $limit  = max(1, min(100, (int)($_GET['limit']  ?? 25)));
      $page   = max(1, (int)($_GET['page'] ?? 1));
      $offset = ($page - 1) * $limit;

      $where  = [];
      $search = trim($_GET['q'] ?? '');
      if ($search !== '') {
         $esc = $DB->escape("%$search%");
         $where[] = "(title LIKE $esc OR severity LIKE $esc OR tags LIKE $esc OR sent_by_name LIKE $esc)";
      }
      $whereSql = $where ? 'WHERE '.implode(' AND ', $where) : '';

      $cntQ = $DB->query("SELECT COUNT(*) AS c FROM glpi_plugin_notificationhubs_logs $whereSql");
      $total = ($cntQ && $DB->numrows($cntQ)) ? (int)$DB->result($cntQ, 0, 'c') : 0;

      $res = $DB->query("
         SELECT id, created_at, title, severity, tags, sent_by_name, http_code, outcome_state, success_count
         FROM glpi_plugin_notificationhubs_logs
         $whereSql
         ORDER BY created_at DESC
         LIMIT $limit OFFSET $offset
      ");

      echo '<form method="get"><input type="hidden" name="page" value="1">';
      echo '<input type="text" name="q" size="40" placeholder="Sök titel/taggar/användare" value="'.self::esc($search).'"> ';
      echo '<input type="submit" class="btn btn-primary" value="Sök"></form><br>';

      echo '<table class="tab_cadre_fixehov">';
      echo '<tr><th>Datum</th><th>Titel</th><th>Severity</th><th>Taggar</th><th>Skickad av</th><th>HTTP</th><th>Outcome</th><th>OK</th></tr>';
      if ($res) {
         while ($row = $DB->fetchArray($res)) {
            $id          = (int)$row['id'];
            $link        = 'history.list.php?view=' . $id;
            $createdSafe = Html::convDateTime($row['created_at']);
            $titleSafe   = self::esc($row['title']);
            $sevSafe     = self::esc($row['severity']);
            $tagsSafe    = self::esc($row['tags']);
            $bySafe      = self::esc($row['sent_by_name']);
            $httpSafe    = self::esc($row['http_code']);
            $outSafe     = self::esc($row['outcome_state']);
            $okSafe      = self::esc($row['success_count']);

            echo '<tr>';
            echo '<td>' . $createdSafe . '</td>';
            echo '<td><a href="' . self::esc($link) . '">' . $titleSafe . '</a></td>';
            echo '<td>' . $sevSafe . '</td>';
            echo '<td>' . $tagsSafe . '</td>';
            echo '<td>' . $bySafe . '</td>';
            echo '<td>' . $httpSafe . '</td>';
            echo '<td>' . $outSafe . '</td>';
            echo '<td>' . $okSafe . '</td>';
            echo '</tr>';
         }
      }
      echo '</table>';

      $pages = max(1, (int)ceil($total / $limit));
      echo '<div class="center mt2">Sida '.$page.' av '.$pages.' ';
      if ($page > 1)   echo '<a class="vsubmit" href="?page='.($page-1).'&q='.urlencode($search).'">Föregående</a> ';
      if ($page < $pages) echo '<a class="vsubmit" href="?page='.($page+1).'&q='.urlencode($search).'">Nästa</a>';
      echo '</div>';
   }

   public static function renderView($id) {
      global $DB;
      $id = (int)$id;
      $res = $DB->query("SELECT * FROM glpi_plugin_notificationhubs_logs WHERE id = $id");
      if (!$res || !$DB->numrows($res)) {
         echo '<div class="center">Saknas.</div>'; return;
      }
      $r = $DB->fetchArray($res);

      $createdSafe = Html::convDateTime($r['created_at']);
      $rows = [
        'Datum'          => $createdSafe,
        'Titel'          => $r['title'],
        'Meddelande'     => $r['message'],
        'Severity'       => $r['severity'],
        'Taggar'         => $r['tags'],
        'Skickad av'     => $r['sent_by_name'].' (#'.$r['sent_by_id'].')',
        'HTTP'           => $r['http_code'],
        'Outcome'        => $r['outcome_state'],
        'Success count'  => $r['success_count'],
        'MessageId'      => $r['message_id']
      ];

      echo '<table class="tab_cadre_fixe">';
      echo '<tr><th colspan="2">Detaljer</th></tr>';
      foreach ($rows as $k => $v) {
         echo '<tr class="tab_bg_1"><td width="200">'.self::esc($k).'</td><td>'.self::esc($v).'</td></tr>';
      }
      echo '<tr class="tab_bg_1"><td>API-svar</td><td><pre style="white-space:pre-wrap;">'.
           self::esc($r['api_response']).
           '</pre></td></tr>';
      echo '</table>';
   }
}
