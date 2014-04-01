<?php

/**
 * Description of LoginFilter
 *
 * @author artem
 */
namespace Users\Form;

use Zend\InputFilter\InputFilter;

class LoginFilter extends InputFilter {
    public function __construct() {
        $this->add(array(
            'name' => 'email',
            'required' => TRUE,
            'validators' => array(
                array(
                    'name' => 'EmailAddress',
                    'options' => array(
                        'domain' => TRUE,
                    )
                )
            ),
        ));
        
        $this->add(array(
            'name' => 'password',
            'required' => TRUE,
        ));
    }
}
