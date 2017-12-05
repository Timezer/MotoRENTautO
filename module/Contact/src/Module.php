<?php
namespace Contact;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                Model\ContactTable::class => function($container) {
                    $tableGateway = $container->get(Model\ContactTableGateway::class);
                    return new Model\ContactTable($tableGateway);
                },
                Model\ContactTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Contact());
                    return new TableGateway('contact', $dbAdapter, null, $resultSetPrototype); //"garage" = nom de la db"
                },
            ],
        ];
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\ListController::class => function($container) {
                    return new Controller\ListController(
                        $container->get(Model\ContactTable::class)
                    );
                },
            ],
        ];
    }



}