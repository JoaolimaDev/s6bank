<?php
namespace api;

require_once("model/DAO.php");

use model\Sql;

class Fila
{
    private static int $ordem;
    private static int $lista;

    public static function Insert_Sort() : void
    {
        $data = json_decode(file_get_contents("php://input"));

        
        if (empty($data->vetor) || empty($data->cpf)) {

            echo json_encode([

                'Mensagem' => "Adicione os valores!"
    
            ]);

            exit;

        }

        $vetor = $data->vetor;

        $cpf = $data->cpf;

        $sql = Sql::select("SELECT * FROM `fila` WHERE tipo = :vetor AND status = :aberto", array(':vetor' => $vetor, ':aberto' => "aberto"));

        

        if (count($sql) > 0) {


            foreach ($sql as $value) {
                
                Fila::$lista =  $value['ordem'];
            }
        
           
            for ($i= count($sql); $i < count($sql) +2  ; $i++) { 
                

                Fila::$ordem = $i;

            }

          
            if(Fila::$ordem < Fila::$lista){

                Fila::$ordem = Fila::$lista +1 ;

            }

            if ($vetor == "comum") 
            {

                $code = "C-". Fila::$ordem;

            }elseif($vetor == 'prioritario'){

                $code = "P-". Fila::$ordem;

            }

           Sql::query("INSERT INTO `fila` (code, status, cpf_cliente, tipo, ordem) VALUES(:code, :status, :cpf_cliente, :tipo, :ordem)",
            array(':code' => $code, ':status' => 'aberto', ':cpf_cliente' => $cpf, ':tipo' => $vetor, ':ordem' => Fila::$ordem));


            echo json_encode([

                'Mensagem' => $code
    
            ]);

            exit;

        }else{

            if ($vetor == "comum") 
            {
    
                $code = "C-1";
    
            }elseif($vetor == 'prioritario'){
    
                $code = "P-1";
    
            }
    
    
            Sql::query("INSERT INTO `fila` (code, status, cpf_cliente, tipo, ordem) VALUES(:code, :status, :cpf_cliente, :tipo, :ordem)",
            array(':code' => $code, ':status' => 'aberto', ':cpf_cliente' => $cpf, ':tipo' => $vetor, ':ordem' => 1));
    
            echo json_encode([

                'Mensagem' => $code
    
            ]);

            exit;
    
        }

    }
    
}



?>