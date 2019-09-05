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
		
		// Se não foi passado um Controller na URL ($controllerName deve ser settado para o nome do Controller principal)
		if(!isset($tokens[1])){
			$metodReflector = new ReflectionMethod('Home', 'index');
			$paramsCount = $metodReflector->getNumberOfParameters();
			if($paramsCount != 0){
				$controllerName = 'Erro';
				$controllerMethod = 'expectParams';
				$controllerParam = array('index', $paramsCount, 0);
			}else{
				$controllerName = 'Home';			
				$controllerMethod = 'index';
			}
		// Se foi passado um Controller na URL
		}else{

			// Se o Controller Existe
			if(class_exists(ucfirst($tokens[1]))){

				$controllerName = ucfirst($tokens[1]);

				// Se foi passado um Método na URL
				if(isset($tokens[2])){

					// Se o Método Existe
					if(method_exists($controllerName,$tokens[2])){

						$controllerMethod = strtolower($tokens[2]);

						// Se foi passado Parametros na URL
						if(isset($tokens[3])){
							
							// Se URL possuir mais do que um Parametro
							if(sizeof($tokens) > 4){	
								$controllerParam = array();
								for ($i = 3; $i < sizeof($tokens); $i++ ) { 
									array_push($controllerParam, $tokens[$i]);
								}

								$metodReflector = new ReflectionMethod($tokens[1], $tokens[2]);
								$paramsCount = $metodReflector->getNumberOfParameters();

								// Se o Método não espera nenhum Parametro
								if($paramsCount == 0 ){
									$controllerName = 'Erro';
									$controllerMethod = 'dontExpectParams';
									$controllerParam = array($tokens[2], $paramsCount, count($controllerParam));
								// Se o Método espera parametros
								}else{
									if($paramsCount != count($controllerParam)){
									$controllerName = 'Erro';
									$controllerMethod = 'expectParams';
									$controllerParam = array($tokens[2], $paramsCount, count($controllerParam));
									}
								}
							
							// Se URL possuir apenas 1 Parametro
							}else{
								$metodReflector = new ReflectionMethod($tokens[1], $tokens[2]);
								$paramsCount = $metodReflector->getNumberOfParameters();
								// Se Método requer 1 parametro
								if($paramsCount == 1){
									$controllerParam = $tokens[3];
								// Se Método requer mais de 1 parametro
								}elseif($paramsCount > 1){
									$controllerName = 'Erro';
									$controllerMethod = 'expectParams';
									$controllerParam = array($tokens[2], $paramsCount, 1);
								}else{
									$controllerName = 'Erro';
									$controllerMethod = 'dontExpectParams';
									$controllerParam = array($tokens[2], $paramsCount, 1);
								}							
	
							}
						// Se não Foi passado parametros na URL
						}else{
							$metodReflector = new ReflectionMethod($tokens[1], $tokens[2]);
							$paramsCount = $metodReflector->getNumberOfParameters();
							if($paramsCount != 0){
								$controllerName = 'Erro';
								$controllerMethod = 'expectParams';
								$controllerParam = array($tokens[2], $paramsCount, 0);
							}

						}
					
					// Se o Método Não Existir
					}else {

						$controllerName = 'Erro';
						$controllerMethod = 'methodDoesntExist';
						$controllerParam = array($tokens[2], $tokens[1]);
					}				
				
				// Se não foi passado Método na URL (Todo controller deve ter um Método padrão chamado index para ser chamado por Default)
				}else{
					$metodReflector = new ReflectionMethod($tokens[1], 'index');
					$paramsCount = $metodReflector->getNumberOfParameters();
					if($paramsCount != 0){
						$controllerName = 'Erro';
						$controllerMethod = 'expectParams';
						$controllerParam = array('index', $paramsCount, 0);
					}else{
						$controllerMethod = 'index';
					}

				}
			// Se a Classe (Controller) não existir
			}else{
				if(method_exists('Home',$tokens[1])){
					if(isset($tokens[2])){
						if(sizeof($tokens) > 3){	
							$controllerParam = array();
							for ($i = 2; $i < sizeof($tokens); $i++ ) { 
								array_push($controllerParam, $tokens[$i]);
							}

							$metodReflector = new ReflectionMethod('Home', $tokens[1]);
							$paramsCount = $metodReflector->getNumberOfParameters();

							// Se o Método não espera nenhum Parametro
							if($paramsCount == 0 ){
								$controllerName = 'Erro';
								$controllerMethod = 'dontExpectParams';
								$controllerParam = array($tokens[1], $paramsCount, count($controllerParam));
							// Se o Método espera parametros
							}else{
								if($paramsCount != count($controllerParam)){
									$controllerName = 'Erro';
									$controllerMethod = 'expectParams';
									$controllerParam = array($tokens[1], $paramsCount, count($controllerParam));
								}else{
									$controllerName = 'Home';
									$controllerMethod = $tokens[1];									
								}
							}
						
						// Se URL possuir apenas 1 Parametro
						}else{
							$metodReflector = new ReflectionMethod('Home', $tokens[1]);
							$paramsCount = $metodReflector->getNumberOfParameters();
							// Se Método requer 1 parametro
							if($paramsCount == 1){
								$controllerParam = $tokens[2];
							// Se Método requer mais de 1 parametro
							}elseif($paramsCount > 1){
								$controllerName = 'Erro';
								$controllerMethod = 'expectParams';
								$controllerParam = array($tokens[1], $paramsCount, 1);
							}else{
								$controllerName = 'Erro';
								$controllerMethod = 'dontExpectParams';
								$controllerParam = array($tokens[1], $paramsCount, 1);
							}							

						}
					}else{
						$metodReflector = new ReflectionMethod('Home', $tokens[1]);
						$paramsCount = $metodReflector->getNumberOfParameters();
						if($paramsCount != 0){
							$controllerName = 'Erro';
							$controllerMethod = 'expectParams';
							$controllerParam = array($tokens[1], $paramsCount, 0);
						}else{
							$controllerName = 'Home';
							$controllerMethod = $tokens[1];
						}
					}
				}else{
					$controllerName = 'Erro';
					$controllerMethod = 'undefinedController';	
					$controllerParam = $tokens[1];	
				}		
			}
		}	

		//Dispatching
		$controller = new $controllerName();
		if(isset($controllerParam)){
			if(is_array($controllerParam)){
				if(count($controllerParam) == 2){
					$controller->$controllerMethod($controllerParam[0], $controllerParam[1]);
				} elseif(count($controllerParam) == 3){
					$controller->$controllerMethod($controllerParam[0], $controllerParam[1], $controllerParam[2]);
				} else {
					$controller->$controllerMethod($controllerParam[0], $controllerParam[1], $controllerParam[2], $controllerParam[3]);
				}
			}else{
				$controller->$controllerMethod($controllerParam);
			}
		}else{
			$controller->$controllerMethod();
		}
	}
}