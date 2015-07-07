<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace API2CMS;

use Phalcon\Mvc\User\Component;

class Connector extends Component
{
    protected $uri = '';

    protected static $_instance;

    private function __construct(){}

    private function __clone(){}

    /**
     * @return Connector
     */
    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function __get($name)
    {
        if (isset($this->$name)) {
            return $this->$name;
        }

        throw new \InvalidArgumentException('Column ' . $name . ' not exist!');
    }

    public function __set($name, $value)
    {
        if (isset($this->$name)) {
            $this->$name = $value;
            return true;
        }

        throw new \InvalidArgumentException('Column ' . $name . ' not exist!');
    }

    public function check()
    {
        $request = new \HttpRequest();
        $request->setUrl($this->uri);
        $response = $request->send();

        var_export($response);die;
    }
}