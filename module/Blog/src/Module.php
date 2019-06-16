<?php
namespace Blog;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

use Blog\Controller\BlogController;
use Blog\Controller\Factory\BlogControllerFactory;
use Blog\Model\Factory\PostTableGatewayFactory;
use Blog\Model\Factory\PostTableFactory;

use Blog\Form\Factory\PostFormFactory;
use Blog\Form\PostForm;


use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\ControllerProviderInterface;

class Module implements ConfigProviderInterface, ServiceProviderInterface, ControllerProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig()
    {
    	return  [
			'factories' => [
                Model\PostTable::class =>PostTableFactory::class,
                /*
                function ($conteiner){
					$tableGateway = $conteiner->get(Model\PostTableGateway::class);
					return new Model\PostTable($tableGateway);
                },
                /***/
                Model\PostTableGateway::class => PostTableGatewayFactory::class,
                PostForm::class=>PostFormFactory::class
                /**
                function($conteiner){
					$dbAdapter = $conteiner->get(AdapterInterface::class);
					$resultSetPrototype = new ResultSet();
					$resultSetPrototype->setArrayObjectPrototype(new Model\Post());

					return new tableGateway('post', $dbAdapter, null, $resultSetPrototype);
                }
                **/ 
			]
		];
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\BlogController::class => BlogControllerFactory::class 
                /** *
                function($container){
                    return new Controller\BlogController(
                        $container->get(Model\PostTable::class)
                    );
                }
                /** */
            ]
        ];
    }
}