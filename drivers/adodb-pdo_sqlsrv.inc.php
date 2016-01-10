<?php

/**
 * Provided by Ned Andre to support sqlsrv library
 */
class ADODB_pdo_sqlsrv extends ADODB_pdo
{

    public $hasTop = 'top';
    public $sysDate = 'convert(datetime,convert(char,GetDate(),102),102)';
    public $sysTimeStamp = 'GetDate()';

    protected function _init(ADODB_pdo $parentDriver)
    {
        $parentDriver->hasTransactions = true;
        $parentDriver->_bindInputArray = true;
        $parentDriver->hasInsertID = true;
        $parentDriver->fmtTimeStamp = "'Y-m-d H:i:s'";
        $parentDriver->fmtDate = "'Y-m-d'";
    }

    public function beginTrans()
    {
        $returnval = parent::BeginTrans();
        return $returnval;
    }

    public function metaColumns($table, $normalize = true)
    {
        return false;
    }

    public function metaTables($ttype = false, $showSchema = false, $mask = false)
    {
        return false;
    }

    public function selectLimit($sql, $nrows = -1, $offset = -1, $inputarr = false, $secs2cache = 0)
    {
        $ret = ADOConnection::SelectLimit($sql, $nrows, $offset, $inputarr, $secs2cache);
        return $ret;
    }

    public function serverInfo()
    {
        return ADOConnection::ServerInfo();
    }
}
