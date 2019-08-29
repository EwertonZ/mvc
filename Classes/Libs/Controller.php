<?php 

/**
 * Classe que por padrão instancia um Objeto View.
 */
class Controller
{
	
	public function __construct()
	{
		$this->view = new View();
	}
}