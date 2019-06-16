<?php
namespace Blog\InputFilter;

use Zend\InputFilter\InputFilter;
use Zend\Filter\StripTags;
use Zend\Filter\StringTrim;

class PostInputFilter extends InputFilter {
 public function __construct(){
     $this->add([
         'name' => 'title',
         'required'=> true,
         'filters'=>[
             ['name' => StringTrim::class],
             ['name'=>StripTags::class]
         ]
     ]);

     $this->add([
        'name' => 'content',
        'required'=> true
    ]);     
 }
}