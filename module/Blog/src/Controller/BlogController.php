<?php 

namespace Blog\Controller;

use Blog\Model\PostTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Blog\Form\PostForm;
use Blog\Model\Post;

#use Zend\Filter\StringTrim;
#use Zend\Filter\Digits;

use Zend\Validator\Digits;
use Blog\InputFilter\PostInputFilter;

class BlogController extends AbstractActionController
{

	private $table;
	private $form;
	public function __construct(PostTable $table, PostForm $form)
	{
		$this->table = $table;
		$this->form = $form;
	}
	public function indexAction()
	{
		$postTable = $this->table;
		 return new ViewModel([
		 	'posts'=>$postTable->fetchAll()
		 ]);
	}

	public function addAction(){
		/* para filtros
		$cpf = "   000.000.000-00   ";
		$filter = new Digits();
		$cpfFiltrado = $filter->filter($cpf);
		echo "resolvido ".$cpfFiltrado;
		/** */
		/*
		$cpf = "   000.000.000-00   ";
		$validator = new Digits();
		$validator->setMessage("Numeros Invalidos",Digits::NOT_DIGITS);
		echo $validator->isValid($cpf)? "Valido":"Invalido";
		echo "<pre>".var_dump($validator->getMessages())."</pre>";
		*/
		$data = [
			'title'=> '  Titiulo  ',
			'content'=>'<a href="#">Gibraltar</a>'
		];
		/*
		$inputFilter = new PostInputFilter();
		$inputFilter->setData($data);

		echo $inputFilter->isValid() ? "Valido":"inválido";
		var_dump($inputFilter->getValues());
		*/
		/*
		$form = new PostForm();
		$form->setInputFilter(new PostInputFilter());
		*/
		$form = $this->form;
		$form->get('submit')->setValue('Add Post');
		$request = $this->getRequest();
		if(!$request->isPost()) {
			return ['form' => $form];
		}
		$form->setData($request->getPost());
		if(!$form->isValid()) {
				return ['form' => $form];
		}

		$post = new Post();
		$post->exchangeArray($form->getData());
		$this->table->save($post);
		return $this->redirect()->toRoute('post');

	}

	public function editAction(){
		$id = (int)  $this->params()->fromRoute('id',0);

		if(!$id) {
			return $this->redirect()->toRoute('post');
		}

		try {
			$post = $this->table->find($id);
		} catch(\Exception $e) {
			return $this->redirect()->toRoute('post');
		}

		#$form = new PostForm();
		$form = $this->form;
		$form->bind($post);
		$form->get('submit')->setAttribute('value', 'Edit Post');

		$request =  $this->getRequest();
		if(!$request->isPost()) {
			return [
				'id'=>$id,
				'form'=>$form
			];
		}

		$form->setData($request->getPost());
		if(!$form->isValid()) {
			return [
				'id'=>$id,
				'form'=>$form
			];
		}

		$this->table->save($post);
		return $this->redirect()->toRoute('post');
	}

	public function deleteAction() {
		$id = (int) $this->params()->fromRoute('id', 0);
		if(!$id) {
			return $this->redirect()->toRoute('post');
		}

		$this->table->delete($id);
		return $this->redirect()->toRoute('post');
	}
}