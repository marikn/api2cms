<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace API2CMS;

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

    /**
     * @var \API2CMS\Db $_db
     */
    private $_db;

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
        $this->_initDb();
        $this->_detectVersion();
    }

    public function check()
    {
        $this->_connector->check();
    }

    public function export($entity, $method, $params)
    {
        $cms = '\API2CMS\Cms\\' . ucfirst($this->cms) . '\\' . ucfirst($entity);

        $cmsInstance = new $cms;

        $pagination = $this->_getPagination($params);

        $data = $cmsInstance->$method($pagination['page'], $pagination['limit'], $params, array());
    }

    private function _initConnector()
    {
        $this->_connector = Connector::getInstance();

        $this->_connector->url   = $this->url;
        $this->_connector->token = $this->token;
    }

    private function _initDb()
    {
        $dbInstance = Db::getInstance();

        $this->_db = $dbInstance;
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
            'page'  => 0,
            'limit' => 50
        );

        $result = Param::validate($params, 'int', 'page', false);

        if (Param::PARAM_EXISTS === $result) {
            $pagination['page'] = $params['page'];
        }

        unset($result);

        $result = Param::validate($params, 'int', 'limit', false);

        if (Param::PARAM_EXISTS === $result) {
            $pagination['limit'] = $params['limit'];
        }

        return $pagination;
    }
}