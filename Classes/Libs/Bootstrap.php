<?php

/**
 * Classe que faz o MVC acontecer.
 * Essa classe utiliza a URL para determinar qual controller chamar.
 * Os parametros são: 
 * @param   $[controllerName] [<Nome do controller, é o texto da URL que vem após a primeira barra (seudominio.com/controllerName)>]
 * @param   $[controllerMethod] [<Nome do metodo, por default é o metodo index do controller, é o texto que vem após a segunda barra (/) da URL seudominio.com/controllerName/controllerMethod>] 
 * @param   $[controllerParam] [<Parametros do método, texto que vem após a terceira barra (/) da URL em diante (cada parametro deve ser separado por uma nova barra(/))>]
 */
class Bootstrap
{
	
	public function __construct()
	{
		
		//Rounting
		$tokens = explode('/', rtrim($_SERVER['REQUEST_URI'], '/'));
		
		if(!isset($tokens[1])){

			$controllerName = 'Home';
			$controllerMethod = 'index';

		}else{

			if(class_exists(ucfirst($tokens[1]))){

				$controllerName = ucfirst($tokens[1]);

				if(isset($tokens[2])){

					$controllerMethod = strtolower($tokens[2]);

					if(isset($tokens[3])){

						if(sizeof($tokens) > 4){

							$controllerParam = array();
							for ($i = 3; $i < sizeof($tokens); $i++ ) { 
								array_push($controllerParam, $tokens[$i]);
							}

						}else{

							$controllerParam = $tokens[3];

						}

					}

				

				}else{

					$controllerMethod = 'index';

				}

			}else{

				$controllerName = 'Home';

				if(method_exists($controllerName,$tokens[1])){

					$controllerMethod = strtolower($tokens[1]);

					if(isset($tokens[2])){

						$controllerParam = $tokens[2];

					}

				}else{

					$controllerName = 'Erro';
					$controllerMethod = 'index';

				}
			}
		}	

		//Dispatching
		$controller = new $controllerName();
		if(isset($controllerParam)){
			$controller->$controllerMethod($controllerParam);
		}else{
			$controller->$controllerMethod();
		}
	}
}