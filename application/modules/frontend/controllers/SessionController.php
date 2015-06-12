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

        try {
            if ($this->request->isPost()) {
                if ($form->isValid($this->request->getPost()) == false) {
                    foreach ($form->getMessages() as $message) {
                        $this->flash->error($message);
                    }
                } else {
                    $this->auth->check(array(
                        'email'     => $this->request->getPost('email'),
                        'password'  => $this->request->getPost('password'),
                        'remember'  => $this->request->getPost('remember')
                    ));

                    return $this->response->redirect('users');
                }
            }
        } catch (\Exception $e) {
            $this->flash->error($e->getMessage());
        }

        $this->view->form = $form;
    }

    public function forgotPasswordAction()
    {

    }

    public function logoutAction()
    {

    }
}