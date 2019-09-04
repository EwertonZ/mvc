<?php 


/**
 * 	
 */
class Erro extends Controller
{	

	public function index()
	{
		$this->view->message = "Index, Internal Error (Verify databases connection)!";
		$this->view->render('Views/errors/index.phtml');
	}

	public function internalError(){
		$this->view->message = "Internal Error (Verify databases connection)!";
		$this->view->render('Views/errors/index.phtml');
	}

	public function undefinedController($controller){
		$this->view->message = "The Controller '<strong>". $controller. "</strong>' doesn't exists!";
		$this->view->render('Views/errors/index.phtml');
	}

	public function sintaxError($controller){
		$this->view->message = "Internal Error (Verify databases connection or '<strong>". $controller ."</strong>' Classe Syntaxes)!";
		$this->view->render('Views/errors/index.phtml');
	}

	public function expectParams($method, $expectedParamsCount, $paramsPassedCount){
		$this->view->message = "The Method '<strong>". ucfirst($method) ."</strong>' expects at least '<strong>". $expectedParamsCount ."</strong>' parameters: <strong> $paramsPassedCount </strong> passed to the method!";
		$this->view->render('Views/errors/index.phtml');
	}

	public function dontExpectParams($method, $expectedParamsCount, $paramsPassedCount){
		$this->view->message = "The Method '<strong>". ucfirst($method) ."</strong>' doesn't expects parameteres: <strong> $paramsPassedCount </strong> parameters passed to the method!";
		$this->view->render('Views/errors/index.phtml');
	}

	public function methodDoesntExist($method, $controller){
		$this->view->message = "The Method '<strong>". ucfirst($method) ."</strong>' don't exist on  '<strong>". $controller ."</strong>' Controller!";
		$this->view->render('Views/errors/index.phtml');
	}
}