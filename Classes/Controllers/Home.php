<?php 


/**
 * Classe Controler
 */
class Home extends Controller
{	
	
	public function index()
	{		

		$menuLinks = array('Docs' => '/docs', 'Contato' => '#', 'Configuração' => array('Perfil' => '#', 'Sair' => '#'));
		$header = "Views/static/dochead.phtml";
		$title = "Bem Vindo-Home";		

		$this->view->render(
			'Views/home/index.phtml', 
			array(
				'welcome' => 'Bem vindo à Página-Home', 
				'menu' => $menuLinks,
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

	public function docs(){

		$menuLinks = array('Docs' => '/docs', 'Contato' => '#', 'Configuração' => array('Perfil' => '#', 'Sair' => '#'));
		$header = "Views/static/dochead.phtml";
		$title = "Bem Vindo-Docs";	
		$this->view->render(
			'Views/home/docs.phtml', 
			array(
				'welcome' => 'Bem vindo à Página-Docs', 
				'menu' => $menuLinks,
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