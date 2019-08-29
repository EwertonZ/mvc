<?php 


/**
 * Classe Controler
 */
class Home extends Controller
{	
	
	public function index()
	{		
		
		$header = "Views/static/head.phtml";
		$title = "Bem Vindo-Home";		
		$this->view->render(
			'Views/home/index.phtml', 
			array(
				'welcome' => 'Bem vindo à Página-Home', 
				'error' => array(
					'isError' => false, 
					'errorView' => 'Views/home/index.phtml'
				)
			), 
			null, 
			$title, 
			$header
		);		
	}

	

}