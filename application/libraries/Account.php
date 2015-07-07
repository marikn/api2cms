<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace API2CMS;

use Phalcon\Mvc\User\Component;

class Account extends Component
{
    protected $email;
    protected $firstName;
    protected $lastName;
    protected $apiKey;
    protected $role;
    protected $params;
    protected $disable;

    protected static $_instance;

    private function __construct(){}

    private function __clone(){}

    /**
     * @return Account
     */
    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function init($account)
    {
        $this->email       = $account->email;
        $this->firstName   = $account->firstName;
        $this->lastName    = $account->lastName;
        $this->apiKey      = $account->apiKey;
        $this->role        = $account->role;
        $this->params      = $account->params;
        $this->disable     = $account->disable;
    }

    public function isActive()
    {
        return ($this->disable == 'Y') ? false : true;

    }
}