<?php

namespace Users\Service;

use Users\Entity\Users as UsersEntity;
use Zend\Session\Container as Session;

class Users
{
    protected $_serviceLocator;

    public function setServiceLocator($serviceLocator)
    {
        $this->_serviceLocator = $serviceLocator;
        return $this;
    }

    public function addUser($userData)
    {
        $userData['password'] = $this->_hashPassword($userData['password']);
        $entityManager = $this->_serviceLocator->get('Doctrine\ORM\EntityManager');
        $users = new UsersEntity();
        $users->addUser($userData);
        $entityManager->persist($users);
        $entityManager->flush();
    }

    public function signup($userData)
    {
        $form = $this->_serviceLocator->get('SignupForm');
        $form->setInputFilter(
            $this->_serviceLocator->get('SignupFilter')
        );
        $form->setData($userData);
        if (!$form->isValid()) {
            $form->get('password')->setValue('');
            $form->get('password-repeat')->setValue('');
            return array(
                'error' => TRUE,
                'form' => $form,
            );
        }

        if ($this->emailExists($userData['email'])) {
            $form->get('password')->setValue('');
            $form->get('password-repeat')->setValue('');
            $form->get('email')
                ->setMessages(array(
                    'Email already exists.'
                ));
            return array(
                'error' => TRUE,
                'form' => $form,
            );
        }

        $this->addUser($userData);
    }

    public function emailExists($email)
    {
        $entityManager = $this->_serviceLocator->get('Doctrine\ORM\EntityManager');

        $emailExists = $entityManager
            ->getRepository('Users\Entity\Users')
            ->findOneBy(array('email' => $email));

        if ($emailExists) {
            return TRUE;
        }

        return FALSE;
    }

    public function editUser($userData)
    {
    }

    public function deleteUser($id)
    {
    }

    public function authenticate($userData)
    {
        $form = $this->_serviceLocator->get('LoginForm');
        $form->setInputFilter(
            $this->_serviceLocator->get('LoginFilter')
        );
        $form->setData($userData);

        if (!$form->isValid()) {
            return array(
                'error' => TRUE,
                'form' => $form,
            );
        }
        $salt = $this->_getSalt($userData['email']);

        if (!$salt) {
            $form->get('password')->setValue('');
            $form->get('submit')->setMessages(array(
                'Your authentication credentials are not valid',
            ));
            return array(
                'error' => TRUE,
                'form' => $form,
            );
        }

        $userData['password'] = $this->_hashPassword($userData['password'], $salt);

        $authService = $this->_serviceLocator->get('Zend\Authentication\AuthenticationService');

        $adapter = $authService->getAdapter();
        $adapter->setIdentityValue($userData['email']);
        $adapter->setCredentialValue($userData['password']);

        $authResult = $authService->authenticate();

        if (!$authResult->isValid()) {
            $form->get('password')->setValue('');
            $form->get('submit')->setMessages(array(
                'Your authentication credentials are not valid',
            ));
            return array(
                'error' => TRUE,
                'form' => $form,
            );
        }

        $identity = $authResult->getIdentity();

        $authService->getStorage()->write($identity);

        $container = new Session('initialized');
        $container->httpClient = md5($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);

        $config = $this->_serviceLocator->get('Configuration');

        if ($userData['remember-me'] === '1') {
            $container->getDefaultManager()->rememberMe(
                isset($config['settings']) && isset($config['settings']['rememberMe']) ? $config['settings']['rememberMe'] : 60 * 60 * 24 * 14
            );
        }
    }

    public function logout()
    {
        $authService = $this->_serviceLocator->get('Zend\Authentication\AuthenticationService');
        if ($authService->hasIdentity()) {
            Session::getDefaultManager()->forgetMe();
            $authService->clearIdentity();
        }
    }

    /**
     * Hashing password
     *
     * @param string $password
     * @param string $salt
     *
     * @return array|string
     */
    protected function _hashPassword($password, $salt = NULL)
    {
        if (!$salt) {
            $salt = hash('md5', time());
            $passwordHash = hash('sha512', $salt . $password);

            $password = array(
                'hash' => $passwordHash,
                'salt' => $salt
            );
            return $password;
        } else {
            $password = hash('sha512', $salt . $password);
            return $password;
        }
    }

    protected function _getSalt($email)
    {
        $entityManager = $this->_serviceLocator->get('Doctrine\ORM\EntityManager');

        $user = $entityManager
            ->getRepository('Users\Entity\Users')
            ->findOneBy(array('email' => $email));

        if ($user) {
            return $user->getSalt();
        }

        return FALSE;
    }
} 