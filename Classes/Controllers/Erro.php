<?php 


/**
 * 	
 */
class Erro extends Controller
{

	public function index()
	{
		$tokens = explode('/', rtrim($_SERVER['REQUEST_URI'], '/'));
		
		if(!isset($tokens[1])){

			$this->view->message = "Internal Error (Verify databases connection)!";

		} else {

			if(!class_exists(ucfirst($tokens[1]))){	

				$this->view->message = "The Controller '<strong>". ucfirst($tokens[1]). "</strong>' doesn't exists!";

			} else {

				if(!isset($tokens[2])){

					$this->view->message = "Internal Error (Verify databases connection or '<strong>". ucfirst($tokens[1]) ."</strong>' Classe Syntaxes)!";

				} else { 

					$this->view->message = "The Method '<strong>". ucfirst($tokens[2]) ."</strong>' don't exist on  '<strong>". ucfirst($tokens[1]) ."</strong>' Controller!";
				}
			}
		}

		$this->view->render('Views/errors/index.phtml');
	}

}