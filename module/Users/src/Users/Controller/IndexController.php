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
        $view = new ViewModel();
        return $view;
    }
    public function registerAction() {
        $view = new ViewModel();
        $view->setTemplate('users/index/register');
        return $view;
    }
    public function loginAction() {
        $view = new ViewModel();
        $view->setTemplate('users/index/login');
        return $view;
    }
}
