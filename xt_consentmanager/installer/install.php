<?php

defined('_VALID_CALL') or die('Direct Access is not allowed.');

require_once _SRV_WEBROOT . _SRV_WEB_PLUGINS. 'xt_consentmanager/classes/constants.php';

global $db, $language, $store_handler;

$supported_langs = array('de','en');

$maxContentId = $db->GetOne("SELECT MAX(content_id) FROM ".TABLE_CONTENT_ELEMENTS);
if ($maxContentId==false) $maxContentId = 0;
$maxContentId++;

$store_id_col_exists = $this->_FieldExists('content_store_id', TABLE_CONTENT_ELEMENTS);


$sql = "INSERT IGNORE INTO ".TABLE_CONTENT." (content_id,content_parent,content_status,content_hook,content_form,content_image,content_sort) VALUES (?, ?, ?, ?, ?, ?, ?)";
$db->Execute($sql, array(
    $maxContentId,
    0,
    1,
    0,
    0,
    '',
    0
));


// set default for all stores in plg config
$db->Execute("UPDATE ".TABLE_PLUGIN_CONFIGURATION." SET `config_value`=? WHERE `config_key`='XT_CONSENTMANAGER'", array($maxContentId));
// set the content-id to be uninstalled
$db->Execute("UPDATE ".TABLE_PLUGIN_CONFIGURATION." SET `config_value`=? WHERE `config_key`='XT_CONSENTMANAGER_UNINSTALL'", array($maxContentId));