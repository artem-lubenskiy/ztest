<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
    'db' => array(
        'driver' => 'Pdo',
        'dsn' => 'mysql:dbname=ztest;host=localhost',
        'username' => 'root',
        'password' => '123456',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'',
        ),
    ),
    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Home',
                'route' => 'home',
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            //'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
            'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
            'Doctrine\Db\Adapter' => 'DoctrineModule\Service\Authentication\AdapterFactory'
        )
    ),
    'session' => array(
        'SavePath' => __DIR__ . '/../../data/session',
        'GcMaxlifetime' => 86400,
    ),
    'settings' => array(
        // Remember me setting in seconds (defaults to 14 days)
        'rememberMe' => 60*60*24*14,
    ),
);
