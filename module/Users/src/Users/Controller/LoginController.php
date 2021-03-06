<?php

/**
 * Description of LoginController
 *
 * @author artem
 */

namespace Users\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container as Session;


class LoginController extends AbstractActionController
{

    protected $_authservice;

    public function indexAction()
    {
        $form = $this->getServiceLocator()->get('LoginForm');
        return new ViewModel(array(
            'form' => $form,
        ));
    }

    public function loginAction()
    {
        if(!$this->request->isPost()) {
            return $this->redirect()->toRoute(NULL, array(
                'controller' => 'login',
            ));
        }

        $userData = $this->getRequest()->getPost();

        $usersService = $this->getServiceLocator()->get('UsersService');
        $authResult = $usersService->authenticate($userData);

        if(is_array($authResult)) {
            $model = new ViewModel(array(
                'form' => $authResult['form'],
            ));
            $model->setTemplate('users/login/index');
            return $model;
        }
            return $this->redirect()->toRoute('home');
    }

    public function testAction()
    {
        $authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');

        if ($authService->hasIdentity()) {
            $identity = $authService->getStorage()->read();
            $container = new Session('initialized');
            $result = ($container->httpClient === md5($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']));

            return new ViewModel(array(
                'identity' => 'You are logged in.'.var_dump($result).$identity->getEmail(),
            ));
        } else {
            return new ViewModel(array(
                'identity' => 'You are not logged in',
            ));
        }
    }

    public function logoutAction() {
        $this->getServiceLocator()
            ->get('UsersService')
            ->logout();
        $this->redirect()->toUrl('/users/login/test');
    }
}
