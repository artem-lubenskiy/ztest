<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Users\Controller\Index' => 'Users\Controller\IndexController',
            'Users\Controller\Signup' => 'Users\Controller\SignupController',
            'Users\Controller\Login' => 'Users\Controller\LoginController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'users' => array(
                'type' => 'Literal',
                'options' => array(
// Change this to something specific to your module
                    'route' => '/users',
                    'defaults' => array(
// Change this value to reflect the namespace in which
// the controllers for your module are found
                        '__NAMESPACE__' => 'Users\Controller',
                        'controller' => 'Index',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
// This route is a sane default when developing a module;
// as you solidify the routes for your module, however,
// you may want to remove it and replace it with more
// specific routes.
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Users' => __DIR__ . '/../view',
        ),
    ),
    'service_manager' => array(
        'invokables' => array(
            'LoginFilter' => 'Users\Form\LoginFilter',
            'SignupFilter' => 'Users\Form\SignupFilter',
            'LoginForm' => 'Users\Form\LoginForm',
            'SignupForm' => 'Users\Form\SignupForm',
        ),
        'factories' => array(
        )
    ),
    'doctrine' => array(
        'driver' => array(
            'users_entity' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Users/Entity'),
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Users\Entity' => 'users_entity'
                )
            ),
        ),
        'authentication' => array(
            'orm_default' => array(
                'object_manager' => 'Doctrine\ORM\EntityManager',
                'identity_class' => 'Users\Entity\Users',
                'identity_property' => 'email',
                'credential_property' => 'password',
            ),
        ),
    ),
);
