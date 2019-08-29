<?php
/**
 * Função para fazer o auto load das Classes
 * @var $folders - Nome das pastas onde se encontram as Classes ('Testes'.DIRECTORY_SEPARATOR.'Testando' (Se for pasta com subpasta))
 * 
 */
spl_autoload_register(function ($nomeClasse){
	
	$folders = array
	(
		//'Testes'.DIRECTORY_SEPARATOR.'Testando' (Se for pasta com subpasta)
		'Dao',
		'Models',		
		'Controllers',
		'Libs',
		'Services'
	);

	if (file_exists($nomeClasse.".php") === true) {
		require_once($nomeClasse.".php");
	}else{
		foreach ($folders as $folder) {
			if(file_exists("Classes" .DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . $nomeClasse.".php") === true){
				require_once("Classes" .DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . $nomeClasse.".php");
			}
		}
	}
});

//Instanciando a Classe que faz o MVC acontecer.
new Bootstrap();

?>