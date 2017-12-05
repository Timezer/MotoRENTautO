<?php
namespace Contact;

use Zend\Router\Http\Literal;
use Zend\ServiceManager\Factory\InvokableFactory;

return [

    

	'controllers' => [
        'factories' => [
            Controller\ListController::class => InvokableFactory::class,
        ],
    ],
    // This lines opens the configuration for the RouteManager
    'router' => [
        // Open configuration for all possible routes
        'routes' => [
            // Define a new route called "blog"
            'contact' => [
                // Define a "literal" route type:
                'type' => Literal::class,
                // Configure the route itself
                'options' => [
                    // Listen to "/blog" as uri:
                    'route' => '/contact',
                    // Define default controller and action to be called when
                    // this route is matched
                    'defaults' => [
                        'controller' => Controller\ListController::class,
                        'action'     => 'index',
                    ],
                ],

                'may_terminate' => true,
                    'child_routes' => [
                        'thank' => [
                            'type' => Literal::class,
                            'options' => [
                                'route' => '/thank',
                                'defaults' => [
                                    //'controller' => Controller\ListController::class,
                                    'action' => 'thank',
                                ],
                            ],
                        ],
                    

                        'error' => [
                            'type' => Literal::class,
                            'options' => [
                                'route' => '/error',
                                'defaults' => [
                                    //'controller' => Controller\ListController::class,
                                    'action' => 'error',
                                ],
                            ],
                        ],
                    ],

            ],
        ],
    ],
    
    'view_manager' => [
        'template_path_stack' => [
           __DIR__ . '/../view',
        ],
    ],

];