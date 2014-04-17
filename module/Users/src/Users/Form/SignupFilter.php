<?php

/**
 * Description of RegistrationFilter
 *
 * @author artem
 */

namespace Users\Form;

use Zend\InputFilter\InputFilter;

class SignupFilter extends InputFilter {

    public function __construct() {

        $this->add(array(
            'name' => 'firstName',
            'required' => TRUE,
            'filters' => array(
                array(
                    'name' => 'StripTags',
                ),
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => 2,
                        'max' => 140,
                    ),
                ),
                array(
                    'name' => 'Alpha',
                    'options' => array(
                        'allowWhiteSpace' => TRUE,
                        'messages' => array(
                            \Zend\I18n\Validator\Alpha::INVALID => 'Invalid first name',
                        )
                    )
                )
            ),
        ));

        $this->add(array(
            'name' => 'secondName',
            'required' => TRUE,
            'filters' => array(
                array(
                    'name' => 'StripTags',
                ),
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => 2,
                        'max' => 140,
                    ),
                ),
                array(
                    'name' => 'Alpha',
                    'options' => array(
                        'allowWhiteSpace' => TRUE,
                        'messages' => array(
                            \Zend\I18n\Validator\Alpha::INVALID => 'Invalid last name',
                        )
                    )
                )
            ),
        ));

        $this->add(array(
            'name' => 'firstName',
            'required' => TRUE,
            'filters' => array(
                array(
                    'name' => 'StripTags',
                ),
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => 2,
                        'max' => 140,
                    ),
                ),
                array(
                    'name' => 'Alpha',
                    'options' => array(
                        'allowWhiteSpace' => TRUE,
                        'messages' => array(
                            \Zend\I18n\Validator\Alpha::INVALID => 'Invalid patr name',
                        )
                    )
                )
            ),
        ));

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

        $this->add(array(
            'name' => 'password-repeat',
            'required' => TRUE,
            'validators' => array(
                array(
                    'name' => 'Identical',
                    'options' => array(
                        'token' => 'password',
                        'messages' => array(
                        \Zend\Validator\Identical::NOT_SAME => 'Passwords do not match'
                        )
                    )
                )
            ),
        ));
    }

}
