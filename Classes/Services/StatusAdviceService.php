<?php

trait StatusAdviceService 
{
    
    public function showCrudMessage($data){
        // $keys = status , modelName , mode
        // $data['status'] = true , false
        // $data['modelName'] = (nomes dos models em portugues para display)
        // $data['mode'] = adicionado, deletado, editado

        switch($data['mode'])
       {
        case 'adcionado':
            if($data['status'] == true){
                return "<h2 class='text-success'>{$data['modelName']} Adicionado(a) com sucesso</h2>";
            }else{
                return "<h2 class='text-danger'>{$data['modelName']} Falhou ao ser Adicionado(a)</h2>";
            }
            break;
        case 'editado':
            if($data['status'] == true){
                return "<h2 class='text-success'>{$data['modelName']} Editado(a) com sucesso</h2>";
            }else{
                return "<h2 class='text-danger'>{$data['modelName']} Falhou ao ser Editado(a)</h2>";
            }
            break;

        case 'deletado':
            if($data['status'] == true){
                return "<h2 class='text-success'>{$data['modelName']} Deletado(a) com sucesso</h2>";
            }else{
                return "<h2 class='text-danger'>{$data['modelName']} Falhou ao ser Deletado(a)</h2>";
            }
            break;
        
        default:
            
            break;
        }
    }
    
}

?>