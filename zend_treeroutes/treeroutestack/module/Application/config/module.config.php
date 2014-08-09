<?php

$module_config = array(
    'service_manager' => array(
        'factories' => array(
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            'apps' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/apps',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Apps',
                        'action' => 'list'
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'app' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '[/[:appid]][/]',
                            'constraints' => array(
                                'appid' => '[a-zA-Z0-9_-]+'
                            ),
                            'defaults' => array(
                                'action' => 'details'
                            )
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'widget' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '[/]widget[/[:file]]',
                                    'defaults' => array(
                                        'action' => 'widget'
                                    )
                                )
                            )
                        ),
                    ),
                )
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'Application\Controller\Apps' => 'Application\Controller\AppsController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);

return $module_config;