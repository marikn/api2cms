<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace API2CMS\Frontend\Controllers;

use API2CMS\Frontend\Forms\LoginForm;
use Phalcon\Mvc\Controller;

class SessionController extends Controller
{
    public function signupAction()
    {

    }

    public function loginAction()
    {
        $form = new LoginForm();
        $this->view->form = $form;
    }

    public function forgotPasswordAction()
    {

    }

    public function logoutAction()
    {

    }
}