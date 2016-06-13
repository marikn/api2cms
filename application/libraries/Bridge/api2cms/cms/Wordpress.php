<?php

class Wordpress extends Cms
{
    public function __construct()
    {
        $this->_getConfig();
        $this->_getDb();
    }

    public function getConfig()
    {
        return $this->_config;
    }

    public function getDb()
    {
        return $this->_db;
    }

    protected function _getConfig()
    {
        $config = file_get_contents('../wp-config.php');
        preg_match("/define\(\'DB_NAME\', \'(.+)\'\);/", $config, $match);
        $this->_config['db_name'] = $match[1];
        preg_match("/define\(\'DB_USER\', \'(.+)\'\);/", $config, $match);
        $this->_config['db_user'] = $match[1];
        preg_match("/define\(\'DB_PASSWORD\', \'(.*)\'\);/", $config, $match);
        $this->_config['db_pass'] = $match[1];
        preg_match("/define\(\'DB_HOST\', \'(.+)\'\);/", $config, $match);
        $this->_setHostPort($match[1]);
        preg_match("/(table_prefix)(.*)(')(.*)(')(.*)/", $config, $match);
        $this->_config['db_prefix'] = $match[4];
        
        $version = $this->_getCmsVersion("option_value", "options", "option_name = 'woocommerce_db_version'");

        if ($version != '') {
            $this->_config['db_version'] = $version;
        }
    }
}