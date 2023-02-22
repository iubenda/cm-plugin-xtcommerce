<?php

defined('_VALID_CALL') or die('Direct Access is not allowed.');

require_once _SRV_WEBROOT . _SRV_WEB_PLUGINS. 'xt_consentmanager/classes/constants.php';

switch ($request['get'])
{
    case 'url_XT_CONSENTMANAGER_MODE':
        $data=array();

        $data[] =  array(
            'id' => '1',
            'name' => __define('TEXT_TX_CONSENTMANAGER_AUTOMATIC'));
        $data[] =  array(
            'id' => '2',
            'name' => __define('TEXT_XT_CONSENTMANAGER_SEMIAUTOMATIC'));

        $result=$data;
        break;

}