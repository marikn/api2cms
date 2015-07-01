<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace API2CMS\Frontend\Controllers;

use API2CMS\Frontend\Forms\EditInfoForm;
use API2CMS\Frontend\Models\Accounts;
use Phalcon\Mvc\Controller;

class ProfileController extends Controller
{
    public function initialize()
    {
        $identity = $this->auth->getIdentity();

        $account = Accounts::findFirstById($identity['id']);
        $this->view->account = $account;
    }

    public function indexAction()
    {

    }

    public function editAction()
    {
        $form = new EditInfoForm();

        try {
            if ($this->request->isPost()) {
                if ($form->isValid($this->request->getPost()) == false) {
                    foreach ($form->getMessages() as $message) {
                        $this->flash->error($message);
                    }
                } else {
                    $account = new Accounts();

                    $account->assign(array(
                        'email'         => $this->request->getPost('email'),
                        'firstName'     => $this->request->getPost('first', 'striptags'),
                        'lastName'      => $this->request->getPost('last', 'striptags'),
                        'password'      => $this->security->hash($this->request->getPost('password')),
                        'apiKey'        => md5(uniqid('', true)),
                        'role'          => 'user',
                        'params'        => null,
                        'disable'       => 'N',

                    ));

                    if ($account->save()) {
                        $this->auth->check(array(
                            'email'     => $this->request->getPost('email'),
                            'password'  => $this->request->getPost('password'),
                            'remember'  => $this->request->getPost('remember')
                        ));

                        return $this->response->redirect('profile');
                    }

                    $this->flash->error($account->getMessages());
                }
            }
        } catch (\Exception $e) {
            $this->flash->error($e->getMessage());
        }

        $this->view->form = $form;
    }

    public function sitesAction()
    {

    }

    public function logsAction()
    {

    }

    public function settingsAction()
    {

    }
}