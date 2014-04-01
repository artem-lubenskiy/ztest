<?php

/**
 * Description of LoginController
 *
 * @author artem
 */

namespace Users\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Users\Form\LoginForm;

class LoginController extends AbstractActionController {
    public function indexAction() {
        $form = new LoginForm();
        $viewModel = new ViewModel(array('form' => $form));
        return $viewModel;
    }
    public function loginAction() {
        $viewModel = new ViewModel();
        $viewModel->setTemplate('users/index/index');
        return $viewModel;
    }
}
