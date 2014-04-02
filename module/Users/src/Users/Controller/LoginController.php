<?php

/**
 * Description of LoginController
 *
 * @author artem
 */

namespace Users\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable as DbTableAuthAdapter;
use Users\Form\LoginForm;
use Users\Form\LoginFilter;

class LoginController extends AbstractActionController {
    
    protected $_authservice;
    
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
        $this->getAuthService()->getAdapter()
                ->setIdentity($this->request->getPost('email'))
                ->setCredential($this->request->getPost('password'));
        $result = $this->getAuthService()->authenticate();
        if($result->isValid()){
            $this->getAuthService()->getStorage()->write($this->request->getPost('email'));
            return $this->redirect()->toRoute(NULL, array(
                    'controller' => 'login',
                    'action' => 'confirm'
                    ));
        }
    }
    public function getAuthService() {
        if (!$this->_authservice) {
            $dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
            $dbTableAuthAdapter = new DbTableAuthAdapter($dbAdapter, 'users', 'email', 'password', 'MD5(?)');
            $this->_authservice = new AuthenticationService();
            $this->_authservice->setAdapter($dbTableAuthAdapter);
        }
        return $this->_authservice;
    }
    public function confirmAction() {
        $user_email = $this->getAuthService()->getStorage()->read();
        $viewModel = new ViewModel(array(
            'user_email' => $user_email
        ));
        return $viewModel;
    }
}
