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
    /**
     * @var Accounts
     */
    protected $_account = null;

    public function initialize()
    {
        $identity = $this->auth->getIdentity();

        $this->_account = Accounts::findFirstById($identity['id']);

        $this->view->account = $this->_account;
    }

    public function indexAction()
    {

    }

    public function editAction()
    {
        $form = new EditInfoForm();

        if (!is_null($this->_account)) {
            $default = array(
                'email' => $this->_account->email,
                'first' => $this->_account->firstName,
                'last'  => $this->_account->lastName,
            );

            $form->setDefaults($default);
        }

        try {
            if ($this->request->isPost()) {
                if ($form->isValid($this->request->getPost()) == false) {
                    foreach ($form->getMessages() as $message) {
                        $this->flash->error($message);
                    }
                } else {
                    $account = Accounts::findFirst(array(
                        'id = :id:',
                        'bind' => array('id' => $this->_account->id)
                    ));

                    if (!$account) {
                        $this->flash->error("The account was not found");
                    }

                    $account->id        = $this->_account->id;
                    $account->email     = $this->request->getPost('email');
                    $account->firstName = $this->request->getPost('first', 'striptags');
                    $account->lastName  = $this->request->getPost('last', 'striptags');

                    if ($account->save()) {
                        return $this->response->redirect('profile/edit');
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