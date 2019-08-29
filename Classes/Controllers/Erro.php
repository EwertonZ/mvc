<?php 


/**
 * 	
 */
class Erro extends Controller
{

	public function index()
	{
		$this->view->message = "The controller doesn't exists!";
		$this->view->render('Views/errors/index.phtml');
	}

}