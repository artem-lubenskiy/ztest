<?php

/**
 * Description of RegistrationForm
 *
 * @author artem
 */

namespace Users\Form;

use Zend\Form\Form;

class SignupForm extends Form {

    public function __construct() {
        parent::__construct('Signup', array(
            'method' => 'post',
        ));

        $this->add(array(
            'name' => 'firstName',
            'attributes' => array(
                'type' => 'text',
                'autocomplete' => 'off',
                'placeholder' => 'Your First Name',
                'id' => 'reg-fname',
                'class' => 'form-control',
                'autofocus' => 'autofocus',
                'tabindex' => 1,
            ),
        ));

        $this->add(array(
            'name' => 'secondName',
            'attributes' => array(
                'type' => 'text',
                'autocomplete' => 'off',
                'placeholder' => 'Your Second Name',
                'id' => 'reg-sname',
                'class' => 'form-control',
                'tabindex' => 2,
            ),
        ));

        $this->add(array(
            'name' => 'patrName',
            'attributes' => array(
                'type' => 'text',
                'autocomplete' => 'off',
                'placeholder' => 'Your Patr Name',
                'id' => 'reg-fname',
                'class' => 'form-control',
                'tabindex' => 3,
            ),
        ));

        $this->add(array(
            'name' => 'email',
            'attributes' => array(
                'type' => 'text',
                'autocomplete' => 'off',
                'placeholder' => 'Your Email',
                'id' => 'reg-email',
                'class' => 'form-control',
                'tabindex' => 4,
            ),
        ));

        $this->add(array(
            'name' => 'password',
            'attributes' => array(
                'type' => 'password',
                'autocomplete' => 'off',
                'placeholder' => 'Your password',
                'id' => 'reg-password',
                'class' => 'form-control',
                'tabindex' => 5,
            ),
        ));

        $this->add(array(
            'name' => 'password-repeat',
            'attributes' => array(
                'type' => 'password',
                'autocomplete' => 'off',
                'placeholder' => 'Repeat your password',
                'id' => 'reg-password-repeat',
                'class' => 'form-control',
                'tabindex' => 6,
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'class' => 'btn btn-primary btn-block',
                'tabindex' => 7,
                'value' => 'Sign Up'
            ),
        ));
    }

}
