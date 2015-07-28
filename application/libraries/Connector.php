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
    protected $url   = '';
    protected $token = '';

    protected static $_instance;

    private function __construct(){}

    private function __clone(){}

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

        throw new \InvalidArgumentException('Property "' . $name . '" not exist!');
    }

    public function __set($name, $value)
    {
        if (isset($this->$name)) {
            $this->$name = $value;
            return true;
        }

        throw new \InvalidArgumentException('Property "' . $name . '" not exist!');
    }

    public function check()
    {
        $this->_request('api2cms/bridge.php', array('ver' => '1.0', 'action' => 'check'));
    }

    public function detectSiteVersion()
    {
        return '1.0.0';
    }

    private function _request($url, $params = array())
    {
        $request = new \HttpRequest();
        $request->setUrl('https://www.api2cart.com');   //TODO Temporary, after testing change to $this->url . $url);
        $request->setOptions(array('timeout'=>100, 'useragent'=>"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_4) AppleWebKit/600.7.12 (KHTML, like Gecko) Version/8.0.7 Safari/600.7.12"));
        $request->setPostFields($params);

        $request->addPostFields(array('token' => $this->token));

        try {
            $response = $request->send();
        } catch (\HttpInvalidParamException $e) {
            throw new \API2CMS\Connector\Exception('Site is unreacheble or not exists', 404);
        } catch (\Exception $e) {
            throw new \API2CMS\Connector\Exception('Internal service error', 500);
        }

        if (!in_array($response->getResponseCode(), array(200, 302))) {
            throw new \API2CMS\Connector\Exception($response->getResponseStatus(), $response->getResponseCode());
        }

        return (isset($response)) ? $request : false;
    }
}