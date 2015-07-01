<?php
/**
 * @author  Marik Nazar
 * @package api2cms
 * @link    https://www.api2cms.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace API2CMS\Frontend\Forms;

use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Form;
use Phalcon\Mvc\Model\Validator\Email;
use Phalcon\Validation\Validator\Confirmation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;

class EditInfoForm extends Form
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

        $this->add(new Submit('Save', array(
            'class' => 'btn btn-primary btn-lg'
        )));
    }
}