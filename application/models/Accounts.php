<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace API2CMS\Models;

use API2CMS\Account;
use API2CMS\Auth\Exception;
use API2CMS\Connector;
use API2CMS\Site;
use Phalcon\Di;
use Phalcon\Mvc\Model;

class Accounts extends Model
{
    protected $id;
    protected $email;
    protected $firstName;
    protected $lastName;
    protected $password;
    protected $apiKey;
    protected $role;
    protected $params;
    protected $disable;

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

    public function initialize()
    {
        $this->setSource("accounts");
        $this->hasMany('id', 'API2CMS\Models\Sites', 'accountId', array('alias' => 'Sites'));
        $this->hasMany('id', 'API2CMS\Models\Articles', 'author', array('alias' => 'Articles'));
    }

    public function columnMap()
    {
        return array(
            'id'        => 'id',
            'email'     => 'email',
            'first'     => 'firstName',
            'last'      => 'lastName',
            'password'  => 'password',
            'api_key'   => 'apiKey',
            'role'      => 'role',
            'params'    => 'params',
            'disable'   => 'disable'
        );
    }

    public static function findFirstByEmail($email)
    {
        return self::findFirst('email=\'' . $email . '\'');
    }

    public static function findFirstById($id)
    {
        return self::findFirst('id=\'' . $id . '\'');
    }

    public function checkAPICredentials($apiKey, $token)
    {
        $account = self::findFirst("apiKey='$apiKey'");

        if (!$account) {
            throw new Exception('Incorrect API key', 403);
        }

        $site = $account->getSites("siteKey='$token'")->toArray();

        if (empty($site)) {
            throw new Exception('Incorrect site key', 403);
        }

        return true;
    }
}
