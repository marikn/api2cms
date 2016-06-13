<?php

class CMS_Bridge
{
    private $_db;
    private $_config;
    
    public function run()
    {
        $this->checkToken($_GET['token']);

        $action = $_GET['action'];

        $funcName = $action . 'Action';
        
        if (!is_callable($funcName)) {
            die('101');
        }
        
        $result = call_user_func(array($this, $funcName));

        return $result;
    }

    private function checkAction()
    {
        die('OK');
    }

    private function queryAction()
    {
        $cmsName = $this->detectCmsType();

        $cms = new $cmsName;
        
        $this->_db      = $cms->getDb();
        $this->_config  = $cms->getConfig();
    }

    private function detectCmsType()
    {
        if (file_exists('../wp-config.php')) {
            return 'Wordpress';
        }

        die('UNKNOWN_CMS_TYPE');
    }

    private function checkToken($token)
    {
        if ($token != SECURITY_TOKEN) {
            die('INVALID TOKEN');
        }
    }
}

require_once 'config.php';

$bridge = new CMS_Bridge();
$bridge->run();
