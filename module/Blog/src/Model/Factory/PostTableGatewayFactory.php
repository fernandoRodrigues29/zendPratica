<?php
namespace Blog\Model\Factory;
use Interop\Container\ContainerInterface;
use Blog\Model\Post;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class PostTableGatewayFactory 
{

    public function __invoke(ContainerInterface $container){
        $dbAdapter = $container->get(AdapterInterface::class);
        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new Post());
        return new TableGateway('post', $dbAdapter, null, $resultSetPrototype);

    }

}