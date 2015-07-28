<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace API2CMS;

use API2CMS\Param\Exception;
use Phalcon\Mvc\User\Component;

class Site extends Component
{
    protected $url;
    protected $token;
    protected $disable;
    protected $cms;
    protected $params;
    protected $version;

    /**
     * @var \API2CMS\Connector $_connector
     */
    private $_connector;

    protected static $_instance;

    private function __construct(){}

    private function __clone(){}

    /**
     * @return \API2CMS\Site
     */
    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function init($site)
    {
        $this->url     = $site->siteUrl;
        $this->token   = $site->siteKey;
        $this->disable = false;
        $this->params  = $site->params;
        $this->cms     = $site->getCms()->code;

        $this->_initConnector();
        $this->_detectVersion();
    }

    public function check()
    {
        $this->_connector->check();
    }

    public function export($entity, $method, $params)
    {
        $cms = '\API2CMS\Cms\\' . $this->cms . '\\' . ucfirst($entity);

        $cmsInstance = new $cms;
        $cmsInstance->$method();
        var_export($cmsInstance);die;
    }

    private function _initConnector()
    {
        $this->_connector = Connector::getInstance();

        $this->_connector->url   = $this->url;
        $this->_connector->token = $this->token;
    }

    private function _detectVersion()
    {
        $version = $this->_connector->detectSiteVersion();

        $cms = '\API2CMS\Cms\\' . ucfirst($this->cms);

        $this->version = $cms::convertVersion($version, $cms::$_versionMapping);
    }

    private function _getPagination($params)
    {
        $pagination = array(

        );

        $page  = 0;
        $limit = 50;

        $result = Param::validate($params, 'int', 'page', false);

        if (Param::PARAM_EXISTS === $result) {
            $page = $params['page'];
        }


        $page   = isset($params['page']) ? $params['page'] : 0;
        $limit  = isset($params['limit']) ? $params['limit'] : 50;
    }
}