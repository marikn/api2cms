<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace API2CMS;

use Phalcon\Mvc\User\Component;
use API2CMS\Frontend\Models\Accounts;
use API2CMS\Auth\Exception;

class Auth extends Component
{
    private $_apiKey = null;
    private $_token  = null;

    /**
     * Checks the user credentials
     *
     * @param array $credentials
     * @throws Exception
     */
    public function check($credentials)
    {
        $user = Accounts::findFirstByEmail($credentials['email']);

        if ($user == false) {
            throw new Exception('Wrong email/password combination');
        }

        if (!$this->security->checkHash($credentials['password'], $user->password)) {
            throw new Exception('Wrong email/password combination');
        }

        $this->session->set('identity', array(
            'id'        => $user->id,
            'name'      => $user->firstName,
            'role'      => $user->role,
        ));
    }

    /**
     * Check API credentials
     *
     * @param $apiKey
     * @param $token
     *
     * @return boolean
     */
    public function apiCheck($apiKey, $token)
    {
        $this->_apiKey = $apiKey;
        $this->_token  = $token;

        $accounts = new \API2CMS\Models\Accounts();

        return $accounts->checkAPICredentials($apiKey, $token);
    }

    /**
     *  Check User by APIKey
     */
    public function checkAccountByApiKey($apiKey)
    {
        $this->_apiKey = $apiKey;

        $accounts = new \API2CMS\Models\Accounts();
        $accounts->checkAPIKey($apiKey);

        if (!empty($accounts)) {
            return true;
        }

        return false;
    }

    public function getIdentity()
    {
        return $this->session->get('identity');
    }

    public function hasIdentity()
    {
        return $this->session->has('identity');
    }

    public function getName()
    {
        $identity = $this->session->get('identity');
        return $identity['first'];
    }

    public function remove()
    {
        $this->session->remove('identity');
    }

    public function authUserById($id)
    {
        $user = Accounts::findFirstById($id);

        if ($user == false) {
            throw new Exception('The user does not exist');
        }

        $this->checkAccountFlags($user);

        $this->session->set('identity', array(
            'id'        => $user->id,
            'name'      => $user->name,
            'profile'   => $user->profile->name
        ));
    }

    public function getAccount()
    {
        $identity = $this->session->get('identity');

        if (isset($identity['id'])) {
            $user = Accounts::findFirstById($identity['id']);

            if ($user == false) {
                throw new Exception('The user does not exist');
            }

            return $user;
        }

        return false;
    }

    public function checkAccountFlags(Accounts $user)
    {
        if ($user->disable != 'Y') {
            throw new Exception('The user is inactive');
        }
    }

    public function getApiKey()
    {
        return $this->_apiKey;
    }

    public function getToken()
    {
        return $this->_token;
    }

    public function setToken($token)
    {
        $this->_token = $token;
    }

    public function generateToken()
    {
        return md5(uniqid('', true));
    }
}