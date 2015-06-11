<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace API2CMS\Models;

use Phalcon\Mvc\Model;

class Accounts extends Model
{
    public $id;
    public $email;
    public $first;
    public $last;
    public $password;
    public $apiKey;
    public $role;
    public $params;
    public $disable;

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
            $this->$name = $value ;
        }

        throw new \InvalidArgumentException('Column ' . $name . ' not exist!');
    }

    public function initialize()
    {
        $this->setSource("accounts");
    }

    public function columnMap()
    {
        return [
            'id'        => 'id',
            'email'     => 'email',
            'first'     => 'firstName',
            'last'      => 'lastName',
            'password'  => 'password',
            'api_key'   => 'apiKey',
            'role'      => 'role',
            'params'    => 'params',
            'disable'   => 'disable'
        ];
    }
}