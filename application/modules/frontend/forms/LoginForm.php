<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace API2CMS\Frontend\Forms;

use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Form;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Identical;
use Phalcon\Validation\Validator\PresenceOf;

class LoginForm extends Form
{
    public function initialize()
    {
        $email = new Text('email', array(
            'placeholder' => 'Email',
            'class'       => 'form-control',
        ));

        $email->addValidators(array(
            new PresenceOf(array(
                'message' => 'The e-mail is required'
            )),
            new Email(array(
                'message' => 'The e-mail is not valid'
            ))
        ));

        $this->add($email);

        $password = new Password('password', array(
            'placeholder' => 'Password',
            'class'       => 'form-control',
        ));

        $password->addValidator(new PresenceOf(array(
            'message' => 'The password is required'
        )));

        $this->add($password);

//        $csrf = new Hidden('csrf');
//
//        $csrf->addValidator(new Identical(array(
//            'value' => $this->security->getSessionToken(),
//            'message' => 'CSRF validation failed'
//        )));
//
//        $this->add($csrf);

        $this->add(new Submit('Login', array(
            'class' => 'btn btn-primary btn-lg'
        )));
    }

    /**
     * Prints messages for a specific element
     *
     * @param $name
     */
    public function messages($name)
    {
        if ($this->hasMessagesFor($name)) {
            foreach ($this->getMessagesFor($name) as $message) {
                $this->flash->error($message);
            }
        }
    }
}