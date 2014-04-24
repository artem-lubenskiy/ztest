<?php

/**
 * Description of LoginForm
 *
 * @author artem
 */

namespace Users\Form;

use Zend\Form\Form;

class LoginForm extends Form {
    public function __construct() {
        parent::__construct('Login', array(
            'method' => 'post',
        ));

        $this->add(array(
            'name' => 'email',
            'attributes' => array(
                'type' => 'text',
                'autocomplete' => 'off',
                'placeholder' => 'Your Email',
                'id' => 'login-email',
                'class' => 'input-block-level',
                'autofocus' => 'autofocus',
                'tabindex' => 1,
            ),
        ));

        $this->add(array(
            'name' => 'password',
            'attributes' => array(
                'type' => 'password',
                'autocomplete' => 'off',
                'placeholder' => 'Your password',
                'id' => 'login-password',
                'class' => 'input-block-level',
                'tabindex' => 2,
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'class' => 'btn btn-primary btn-block',
                'tabindex' => 3,
                'value' => 'Log in'
            ),
        ));

        $this->add(array(
            'type' => 'Checkbox',
            'name' => 'remember-me',
            'options' => array(
                'label' => 'Remember me',
            ),
            'attributes' => array(
                'id' => 'login-remember-me',
                'class' => 'checkboxInput',
                'tabindex' => 4,
            ),
        ));
    }
}
