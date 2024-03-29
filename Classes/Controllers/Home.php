<?php 


/**
 * Classe Controler
 */
class Home extends Controller
{	
	
	public function index()
	{		
		// Essa variável menuLinks pode vir do banco de dados, de um arquivo de configuração ou outro lugar qualquer (Aprimorar)
		$menuLinks = array('Docs' => '/docs', 'Contato' => '#', 'Configuração' => array('Perfil' => '#', 'Sair' => '#'));
		$header = "Views/static/dochead.phtml";
		$title = "Bem Vindo-Home";

		$this->view->render(
			'Views/home/index.phtml', 
			array(
				'welcome' => 'Bem vindo à Página-Home', 
				'menu' => $menuLinks,
				'error' => array(
					'isError' => true, 
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