<?php

defined('_VALID_CALL') or die('Direct Access is not allowed.');

require_once _SRV_WEBROOT . _SRV_WEB_PLUGINS. 'xt_consentmanager/classes/constants.php';


global $xtMinify;

?>

<script type="text/javascript">
	window.XT_CONSENTMANAGER_ID = '<?php echo XT_CONSENTMANAGER_ID;?>';
</script>

<?php
if(XT_CONSENTMANAGER_ID != '' && XT_CONSENTMANAGER_ID != null){
    if(XT_CONSENTMANAGER_CODE != ""){
        echo XT_CONSENTMANAGER_CODE;
    }

    if(XT_CONSENTMANAGER_MODE == 1){
        $xtMinify->add_resource(_SRV_WEB_PLUGINS.'xt_consentmanager/javascript/xt_consentmanager_automatic.js', 1,'footer');
    }
    if(XT_CONSENTMANAGER_MODE == 2){
        $xtMinify->add_resource(_SRV_WEB_PLUGINS.'xt_consentmanager/javascript/xt_consentmanager_semiautomatic.js', 1,'footer');
    }
}

?>