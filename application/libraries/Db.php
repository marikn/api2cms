<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace API2CMS;

use Phalcon\Mvc\User\Component;

class Db extends Component
{
    protected static $_instance;

    /**
     * @var \API2CMS\Connector $_connector
     */
    private $_connector;

    private function __construct(){}

    private function __clone(){}

    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function setConnector($connector)
    {
        $this->_connector = $connector;
    }

    public function query($sql)
    {

    }
}