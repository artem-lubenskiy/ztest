<?php

/**
 * Description of RegisterController
 *
 * @author artem
 */

namespace Users\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Users\Form\RegisterForm;
use Users\Form\RegisterFilter;
use Users\Model\Users;
use Users\Model\UsersTable;

class RegisterController extends AbstractActionController {

    public function indexAction() {
        $form = new RegisterForm;
        $viewModel = new ViewModel(array('form' => $form));
        return $viewModel;
    }

    public function confirmAction() {
        $viewModel = new ViewModel();
        return $viewModel;
    }

    public function processAction() {
        if (!$this->request->isPost()) {
            return $this->redirect()->toRoute(NULL, array(
                        'controller' => 'register',
                        'action' => 'index'
            ));
        }
        $post = $this->request->getPost();
        $form = new RegisterForm;
        $inputFilter = new RegisterFilter();
        $form->setInputFilter($inputFilter);
        $form->setData($post);

        if (!$form->isValid()) {
            $viewModel = new ViewModel(array(
                'error' => TRUE,
                'form' => $form,
            ));
            $viewModel->setTemplate('users/register/index');
            return $viewModel;
        }
        
        $this->createUser($form->getData());
        
        return $this->redirect()->toRoute(NULL, array(
                    'controller' => 'register',
                    'action' => 'confirm'
        ));
    }

    protected function createUser(array $data) {
        $sm = $this->getServiceLocator();
        $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
        $resultSetPrototype = new \Zend\Db\ResultSet\ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new \Users\Model\Users);
        $tableGateway = new \Zend\Db\TableGateway\TableGateway('users', $dbAdapter, null, $resultSetPrototype);
        $users = new Users();
        $users->exchangeArray($data);
        $usersTable = new UsersTable($tableGateway);
        $usersTable->saveUser($users);
        return TRUE;
    }

}
