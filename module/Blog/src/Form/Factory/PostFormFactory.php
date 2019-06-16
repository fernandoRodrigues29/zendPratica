<?php
namespace Blog\Form\Factory;

use Blog\Form\PostForm;
use Blog\InputFilter\PostInputFilter;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class PostFormFactory implements FactoryInterface {
    public function __invoke(ContainerInterface $container,$requestedName, array $options=null){
       $inputFilter = new PostInputFilter();
       $form = new PostForm();
       $form->setInputFilter($inputFilter);
       return $form;  
    }

}