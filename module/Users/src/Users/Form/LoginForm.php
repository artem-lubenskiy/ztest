<?php

/**
 * Description of LoginForm
 *
 * @author artem
 */

namespace Users\Form;

use Zend\Form\Form;

class LoginForm extends Form {
    public function __construct($name = null) {
        parent::__construct('Login');
        $this->setAttribute('method', 'post');
        $this->setAttribute('enctype', 'multipart/form-data');
        $this->setAttribute('class', 'form-signin');
    
        $this->add(array(
            'name' => 'email',
            'attributes' => array(
                'class' => 'input-block-level',
                'type' => 'email',
                'required' => 'required',
                'placeholder' => 'Your e-mail'
            ),
            'filters' => array(
                array(
                    'name' => 'StringTrim'
                )
            ),
            'validators' => array(
                array(
                    'name' => 'EmailAddress',
                    'options' => array(
                        'messages' => array(
                            \Zend\Validator\EmailAddress::INVALID_FORMAT => 'Email address format is invalid'
                        )
                    )
                )
            )
        ));
        
        $this->add(array(
            'name' => 'password',
            'attributes' => array(
                'class' => 'input-block-level',
                'type' => 'password',
                'required' => 'required',
                'placeholder' => 'Password'
            ),
        ));
        
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'class' => 'btn btn-large btn-primary',
                'type' => 'submit',
                'value' => 'Login'
            ),
        ));
        
    }
}
