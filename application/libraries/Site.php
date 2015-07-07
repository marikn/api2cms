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
    protected $params;

    protected static $_instance;

    private function __construct(){}

    private function __clone(){}

    /**
     * @return Site
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
        $this->url     = $site['siteUrl'];
        $this->token   = $site['siteKey'];
//        $this->disable = $site->disable;
        $this->params  = $site['params'];
    }

    public function isActive()
    {
        return ($this->disable == 'Y') ? false : true;
    }
}