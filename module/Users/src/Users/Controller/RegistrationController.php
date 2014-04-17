<?php

/**
 * Description of RegistrationController
 *
 * @author artem
 */

namespace Users\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Users\Form\RegistrationForm;
use Users\Form\RegistrationFilter;

class RegistrationController extends AbstractActionController {

    public function indexAction() {
        $form = $this->getServiceLocator()->get('RegistrationForm');
        $viewModel = new ViewModel(array('form' => $form));
        return $viewModel;
    }
}
