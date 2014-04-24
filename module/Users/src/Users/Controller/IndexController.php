<?php

/**
 * Description of IndexController
 *
 * @author artem
 */

namespace Users\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {
    public function indexAction() {
        $authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
        if(!$authService->hasIdentity()) {
            $this->redirect()->toUrl('/users/login');
        }
        return new ViewModel();
    }
}
