<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace API2CMS\Auth;

use Phalcon\Mvc\User\Component;
use API2CMS\Frontend\Models\Accounts;

class Auth extends Component
{
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

        $this->session->set('auth-identity', array(
            'id'        => $user->id,
            'name'      => $user->firstName,
            'role'      => $user->role,
        ));
    }

    public function getIdentity()
    {
        return $this->session->get('auth-identity');
    }

    public function getName()
    {
        $identity = $this->session->get('auth-identity');
        return $identity['first'];
    }

    public function remove()
    {
        $this->session->remove('auth-identity');
    }

    public function authUserById($id)
    {
        $user = Accounts::findFirstById($id);

        if ($user == false) {
            throw new Exception('The user does not exist');
        }

        $this->checkAccountFlags($user);

        $this->session->set('auth-identity', array(
            'id'        => $user->id,
            'name'      => $user->name,
            'profile'   => $user->profile->name
        ));
    }

    public function getAccount()
    {
        $identity = $this->session->get('auth-identity');

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
}