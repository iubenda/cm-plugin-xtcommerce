<?php

defined('_VALID_CALL') or die('Direct Access is not allowed.');

require_once _SRV_WEBROOT . _SRV_WEB_PLUGINS. 'xt_consentmanager/classes/constants.php';

global $db;

$content_id = $db->GetOne("SELECT `config_value` FROM ".TABLE_PLUGIN_CONFIGURATION."  WHERE `config_key`='XT_CONSENTMANAGER_UNINSTALL' AND `shop_id`=1");
$db->Execute("DELETE FROM ".TABLE_CONTENT." WHERE `content_id`=?", array($content_id));