<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace API2CMS\Frontend\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Check;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Identical;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Confirmation;

class SignUpForm extends Form
{
    public function initialize($entity = null, $options = null)
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

        $first = new Text('first', array(
            'placeholder' => 'First name',
            'class'       => 'form-control',
        ));

        $first->addValidators(array(
            new PresenceOf(array(
                'message' => 'The first name is required'
            ))
        ));

        $this->add($first);

        $last = new Text('last', array(
            'placeholder' => 'Last name',
            'class'       => 'form-control',
        ));

        $last->addValidators(array(
            new PresenceOf(array(
                'message' => 'The last name is required'
            ))
        ));

        $this->add($last);

        $password = new Password('password', array(
            'placeholder' => 'Password',
            'class'       => 'form-control',
        ));

        $password->addValidators(array(
            new PresenceOf(array(
                'message' => 'The password is required'
            )),
            new StringLength(array(
                'min' => 8,
                'messageMinimum' => 'Password is too short. Minimum 8 characters'
            )),
            new Confirmation(array(
                'message' => 'Password doesn\'t match confirmation',
                'with' => 'confirmPassword'
            ))
        ));

        $this->add($password);

        $confirmPassword = new Password('confirmPassword', array(
            'placeholder' => 'Password',
            'class'       => 'form-control',
        ));

        $confirmPassword->addValidators(array(
            new PresenceOf(array(
                'message' => 'The confirmation password is required'
            ))
        ));

        $this->add($confirmPassword);

        $terms = new Check('terms', array(
            'value'       => 'yes',
        ));

        $terms->setLabel('Accept terms and conditions');
        $terms->addValidator(new Identical(array(
            'value'   => 'yes',
            'message' => 'Terms and conditions must be accepted'
        )));

        $this->add($terms);

//        $csrf = new Hidden('csrf');
//
//        $csrf->addValidator(new Identical(array(
//            'value' => $this->security->getSessionToken(),
//            'message' => 'CSRF validation failed'
//        )));
//
//        $this->add($csrf);

        $this->add(new Submit('Sign Up', array(
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
