<?php
namespace Blog\Model\Factory;
use Blog\Model\PostTable;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreateException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;
use Blog\Model;



class PostTableFactory implements FactoryInterface
{
 /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return object
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    
    public function __invoke(ContainerInterface $container,$requestedName, array $options=null){
        #$tableGateway = $container->get(Model\PostTableGateway::class);
        #$commentTable = $container->get(Model\CommentTable::class);
        #return new PostTable($tableGateway,$commentTable);
        #return new PostTable($tableGateway);

        $tableGateway = $container->get(Model\PostTableGateway::class);
        return new PostTable($tableGateway);
    }

}