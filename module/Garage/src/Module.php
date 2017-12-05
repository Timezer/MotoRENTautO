<?php  

namespace Garage;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                Model\GarageTable::class => function($container) {
                    $tableGateway = $container->get(Model\GarageTableGateway::class);
                    return new Model\GarageTable($tableGateway);
                },
                Model\GarageTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Garage());
                    return new TableGateway('motorentauto', $dbAdapter, null, $resultSetPrototype); //"garage" = nom de la db"
                },
            ],
        ];
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\GarageController::class => function($container) {
                    return new Controller\GarageController(
                        $container->get(Model\GarageTable::class)
                    );
                },
            ],
        ];
    }
}
