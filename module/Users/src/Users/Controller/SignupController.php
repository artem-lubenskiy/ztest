<?php

/**
 * Description of RegistrationController
 *
 * @author artem
 */

namespace Users\Controller;

use Users\Entity\Users;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class SignupController extends AbstractActionController {

    public function indexAction() {
        $form = $this->getServiceLocator()->get('SignupForm');
        $viewModel = new ViewModel(array('form' => $form));
        return $viewModel;
    }

    public function signupAction() {
        if(!$this->request->isPost()) {
            return $this->redirect()->toRoute(NULL, array(
                'controller' => 'signup',
            ));
        }
        $data = $this->getRequest()->getPost();
        $form = $this->getServiceLocator()->get('SignupForm');
        $form->setInputFilter(
            $this->getServiceLocator()->get('SignupFilter')
        );
        $form->setData($data);
        if(!$form->isValid()) {
            $model = new ViewModel(array(
                'form' => $form,
            ));
            $model->setTemplate('users/signup/index');
            return $model;
        }
        $objectManager = $this->serviceLocator->get('Doctrine\ORM\EntityManager');

        $emailExists = $objectManager
            ->getRepository('Users\Entity\Users')
            ->findOneBy(array('email' => $data['email']));

        if($emailExists) {
            $model = new ViewModel(array(
                'error' => 'An account with this email is already registered.',
                'form' => $form,
            ));
            $model->setTemplate('users/signup/index');
            return $model;
        }

        $users = new Users();
        $users->addUser($data);
        $objectManager->persist($users);
        $objectManager->flush();

        $this->redirect()->toRoute(NULL, array(
            'controller' => 'login',
        ));
    }
}
