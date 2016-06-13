<?php

abstract class Cms 
{
    protected $_db      = false;
    protected $_config  = array();

    abstract public function getConfig();
    abstract public function getDb();

    abstract protected function _getConfig();
    
    protected function _getDb()
    {
        $link = null;

        $host = $this->_config['db_host'] . ($this->_config['db_port'] ? ':' . $this->_config['db_port'] : '');

        $link = @mysql_connect($host, $this->_config['db_user'], $this->_config['db_pass']);

        if ($link) {
            mysql_select_db($this->_config['db_name'], $link);
        }

        return $link;
    }

    protected function _setHostPort($source)
    {
        $source = trim($source);

        if ($source == '') {
            $this->_config['db_host'] = 'localhost';

            return;
        }

        $conf = explode(":", $source);

        if (isset($conf[0]) && isset($conf[1])) {
            $this->_config['db_host'] = $conf[0];
            $this->_config['db_port'] = $conf[1];
        } else if ($source[0] == '/') {
            $this->_config['db_host'] = 'localhost';
            $this->_config['db_port'] = $source;
        } else {
            $this->_config['db_host'] = $source;
        }
    }

    protected function _getCmsVersion($field, $tableName, $where)
    {
        $version ='';

        if (!$this->_db && !$this->_getDb()) {
            return '[ERROR] MySQL Query Error: Can not connect to DB';
        }

        $sql = "SELECT $field AS version FROM $this->_config['db_prefix']$tableName WHERE $where";

        $query = mysql_query($sql, $this->_db);

        if ($query !== false) {
            $row = mysql_fetch_assoc($query);

            $version = $row['version'];
        }

        return $version;
    }
}