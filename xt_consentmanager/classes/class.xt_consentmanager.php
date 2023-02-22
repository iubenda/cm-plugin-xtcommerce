<?php

defined('_VALID_CALL') or die('Direct Access is not allowed.');

require_once _SRV_WEBROOT . _SRV_WEB_PLUGINS. 'xt_consentmanager/classes/class.consentmanager.php';


class xt_consentmanager
{

    private $_master_key = COL_XT_COC__ID_PK;
    private $_table = TABLE_XT_COC_;
    private $_table_lang = '';
    private $_table_seo = '';
    private $_sql_limit = 50;

    public $position = '';
    public $url_data = array();

    function setPosition($position)
    {
        $this->position = $position;
    }

    function _getParams()
    {
        $header = array();
        $header[COL_XT_COC__ID_PK] = array('type' => 'textfield', 'readonly'=>true);
        $params = array();
        $params['header'] = $header;
        $params['master_key'] = $this->_master_key;
        $params['display_deleteBtn'] = true;
        $params['display_resetBtn'] = true;
        $params['display_editBtn'] = true;
        $params['display_newBtn'] = true;
        $params['display_searchPanel']  = false;
        $params['display_statusTrueBtn'] = false;
        $params['display_statusFalseBtn'] = false;

        $rowActionsFunctions = array();
        $rowActions = array();
        if (count($rowActionsFunctions) > 0) {
            $params['rowActions'] = $rowActions;
            $params['rowActionsFunctions'] = $rowActionsFunctions;
        }

        if (count($rowActions) > 0) {
            $params['rowActions'] = $rowActions;
            $params['rowActionsFunctions'] = $rowActionsFunctions;
        }


        return $params;
    }

    public function xt_consentmanager_row_fnc_1($data)
    {
        return 'result of xt_consentmanager_row_fnc_1<br />data:<br />'.print_r($data,true);
    }

    public function _get($ID = 0)
    {
        if ($this->position != 'admin') return false;

        if (!$ID && !isset($this->sql_limit)) {
            $this->sql_limit = "0,25";
        }

        $table_data = new adminDB_DataRead(
        $this->_table, $this->_table_lang, $this->_table_seo, $this->_master_key,'',$this->_sql_limit,
        /*permission*/ '', /*filter*/ '', /*sort*/ '');

        $data = array();

        if ($this->url_data['get_data'])
        {
            $data = $table_data->getData();

        }
        else if($ID==='new')
        {

        }
        elseif($ID) {
            $data = $table_data->getData($ID);
        }
        else {
            $data = $table_data->getHeader();
        }

        if (!$this->url_data['get_data'])
        {
            $defaultOrder = array(
                COL_XT_COC__ID_PK,
            );

            $orderedData = array();
            foreach ($defaultOrder as $key) {
                $orderedData[$key] = $data[0][$key];
            }
            $data = array($orderedData);
        }

        $obj = new stdClass;
        if ($table_data->_total_count != 0 || !$table_data->_total_count)
        {
            $count_data = $table_data->_total_count;
        }
        else
        {
            $count_data = count($data);
        }
        $obj->totalCount = $count_data;
        $obj->data = $data;

        return $obj;
    }


    function _set($data, $set_type = 'edit')
    {
        $o = new adminDB_DataSave($this->_table, $data, false, __CLASS__);
        $result = $o->saveDataSet();

        return $result;
    }


    function _unset($id = 0)
    {
        global $db;

        $delete = "DELETE FROM `".$this->_table. "` WHERE `".$this->_master_key. "`= '$id'";
        $db->Execute($delete);
        $affectedRows = $db->Affected_Rows();

        return $affectedRows >= 1;
    }

}