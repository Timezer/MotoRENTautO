<?php

namespace Garage;

use Zend\Router\Http\Segment;

return [
    
    // The following section is new and should be added to your file:
    'router' => [
        'routes' => [
            'garage' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/garage[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\GarageController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            'garage' => __DIR__ . '/../view',
        ],
    ],
];