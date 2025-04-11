<?php
global $GO_FIELDS, $LANG;

// Systemägare
$GO_FIELDS['users_id_systemowners_id']['name']       = $LANG['genericobject']['PluginGenericobjectVerksamhetssystem'][1];
$GO_FIELDS['users_id_systemowners_id']['field']       = 'systemowner';
$GO_FIELDS['users_id_systemowners_id']['input_type'] = 'dropdown';

// Systemförvaltare
$GO_FIELDS['users_id_systemmanagers_id']['name']       = $LANG['genericobject']['PluginGenericobjectVerksamhetssystem'][2];
$GO_FIELDS['users_id_systemmanagers_id']['field']       = 'systemmanager';
$GO_FIELDS['users_id_systemmanagers_id']['input_type'] = 'dropdown';

// Systemleverantör
$GO_FIELDS['suppliers_id_systemsuppliers_id']['name']       = $LANG['genericobject']['PluginGenericobjectVerksamhetssystem'][3];
$GO_FIELDS['suppliers_id_systemsuppliers_id']['field']       = 'systemsupplier';
$GO_FIELDS['suppliers_id_systemsuppliers_id']['input_type'] = 'dropdown';
?>