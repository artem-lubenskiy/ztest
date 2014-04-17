<?php

/**
 * Description of LoginController
 *
 * @author artem
 */

namespace Users\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class LoginController extends AbstractActionController
{

    protected $_authservice;

    public function indexAction()
    {
        $objectManager = $this->serviceLocator->get('Doctrine\ORM\EntityManager');
        $user = $objectManager->find('Users\Entity\Users', 1);
        echo $user->getEmail();
        $form = $this->serviceLocator->get('LoginForm');
        return new ViewModel(array(
            'form' => $form,
        ));
    }

    public function loginAction()
    {
        if(!$this->request->isPost()) {
            return $this->redirect()->toRoute(NULL, array(
                'controller' => 'login',
                'action' => 'index',
            ));
        }

        $data = $this->getRequest()->getPost();

        $form = $this->getServiceLocator()->get('LoginForm');
        $form->setInputFilter(
            $this->getServiceLocator()->get('LoginFilter')
        );

        $form->setData($data);

        if(!$form->isValid()) {
            $model = new ViewModel(array(
                'form' => $form,
            ));
            $model->setTemplate('users/login/index');
            return $model;
        }

        $authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');

        $adapter = $authService->getAdapter();
        $adapter->setIdentityValue($data['email']);
        $adapter->setCredentialValue($data['password']);

        $authResult = $authService->authenticate();

        if ($authResult->isValid()) {
            return $this->redirect()->toRoute('home');
        }

        $model = new ViewModel(array(
            'error' => 'Your authentication credentials are not valid',
            'form' => $form,
        ));

        $model->setTemplate('users/login/index');
        return $model;
    }

    public function testAction()
    {
        if ($user = $this->identity()) {
            return new ViewModel(array(
                'identity' => 'You are logged in.',
            ));
        } else {
            return new ViewModel(array(
                'identity' => 'You are not logged in',
            ));
        }
    }

    public function logoutAction() {
        $authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
        if ($authService->hasIdentity()) {
            $authService->clearIdentity();
        }

        $this->redirect()->toUrl('/users/login/test');
    }
}
