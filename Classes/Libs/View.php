<?php 
/**
 * 	Classe que renderiza a View a ser exibida na tela.		
 */
class View
{	

	
	/** 
	* Comentário de variáveis 
	* Variável recebe o caminho padrão do html de erro. 
	* @access private 
	* @name $defaultErrorScript 
	*/ 	
	private $defaultErrorScript = 'Views/errors/index.phtml';
	
	/**
	* Método para renderizar a view
	* @param String $viewScript = caminho para o html
	* @param Array $variables = variavéis que estarão disponiveis no html
	* @param String $errorViewScript = caminho para o html em caso de erro
	* @param String $title = titulo da pagina
	* @param String $header = caminho para o header da página
	* @return void
	*/
	public function render($viewScript, $variables = null, $errorViewScript = null, $title = 'Home', $header = 'Views/static/head.phtml')
	{
		
		$variables['title'] = $title;	
		

		if(isset($variables)){
			$this->compact($variables);
		}		
		if(isset($this->auth))
		{
			if ($this->auth) 
			{			
				require($header);	
				require($viewScript);
			} else {
				if(isset($this->error) && $this->error['isError'] == true)					
				{
					if($this->error['errorView'] != null)
					{
						require($header);
						require($this->error['errorView']);
					} else {
						require($header);
						require($this->defaultErrorScript);
					}
				} else {
					require($header);
					require($this->defaultErrorScript);
				}				
			}			
		} else {
			require($header);
			require($viewScript);	
		}
		
	}

	/**
	* Método para settar as váriaveis no html
	* @param Array $variables
	* @return void
	*/
	public function compact($variables)
	{
		if(is_array($variables)){
			foreach ($variables as $key => $value) {
				$this->$key = $value;
			}
		}
	}
}