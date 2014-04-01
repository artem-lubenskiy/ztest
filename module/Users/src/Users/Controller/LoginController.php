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
use Users\Form\LoginFilter;

class LoginController extends AbstractActionController {
    public function indexAction() {
        $form = new LoginForm();
        $viewModel = new ViewModel(array('form' => $form));
        return $viewModel;
    }
    public function loginAction() {
        if(!$this->request->isPost()) {
            return $this->redirect()->toRoute(NULL, array(
                        'controller' => 'login',
                        'action' => 'index'
            ));
        }
        $post = $this->request->getPost();
        $form = new LoginForm;
        $inputFilter = new LoginFilter();
        $form->setInputFilter($inputFilter);
        $form->setData($post);
        
        if (!$form->isValid()) {
            $viewModel = new ViewModel(array(
                'error' => TRUE,
                'form' => $form,
            ));
            $viewModel->setTemplate('users/login/index');
            return $viewModel;
        }
        
        return $this->redirect()->toRoute(NULL, array(
                    'controller' => 'index',
                    'action' => 'index'
        ));
    }
}
