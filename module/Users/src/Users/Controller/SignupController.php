<?php

/**
 * Description of RegistrationController
 *
 * @author artem
 */

namespace Users\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class SignupController extends AbstractActionController {

    public function indexAction() {
        $form = $this->getServiceLocator()->get('SignupForm');
        $viewModel = new ViewModel(array(
            'form' => $form
        ));
        return $viewModel;
    }

    public function signupAction() {
        if(!$this->request->isPost()) {
            return $this->redirect()->toRoute(NULL, array(
                'controller' => 'signup',
            ));
        }
        $userData = $this->getRequest()->getPost();

        $usersService = $this->getServiceLocator()->get('UsersService');
        $signupResult = $usersService->signup($userData);

        if(is_array($signupResult)) {
            $viewModel = new ViewModel(array(
                'form' => $signupResult['form'],
            ));
            $viewModel->setTemplate('users/signup/index');
            return $viewModel;
        }

        $this->redirect()->toRoute(NULL, array(
            'controller' => 'login',
        ));
    }
}
