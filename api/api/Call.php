<?php
namespace api;

require_once("model/DAO.php");

use model\Sql;

class Call
{

    public static function min_arr($var)
    {
        $lista = [];

        for ($i=0; $i < sizeof($var); $i++) { 
            
            $temp = $var[$i];

            $lista[$i] = $temp['ordem'];
        }

        return $lista;
    }

    public static function Selection_Sort() :void
    {
        $data = json_decode(file_get_contents("php://input"));

          
        if (empty($data->vetor) || empty($data->caixa)) {

            echo json_encode([

                'Mensagem' => "Adicione os valores!"
    
            ]);

            exit;
            

        }


        
        $sql = Sql::select("SELECT ordem FROM `fila` WHERE tipo = :vetor AND status = :aberto", array(':vetor' => $data->vetor, ':aberto' => "aberto"));

        
        if (count($sql) > 0 ) {
            
    
            $arr = Call::min_arr($sql);

        
            Sql::query("UPDATE `fila` SET status = :status, caixa = :caixa WHERE ordem = :ordem AND tipo = :vetor", array(':status' => "em andamento", ':ordem' => min($arr), ':vetor' => $data->vetor, 
            ':caixa' => $data->caixa));


            $query = Sql::select("SELECT code FROM `fila` WHERE ordem = :ordem AND tipo = :vetor", array(':ordem' => min($arr), ':vetor' => $data->vetor));
        
            echo json_encode([

                'Mensagem' => $query

            ]);

            exit;

        }else{

            echo json_encode([

                'Mensagem' => "Sem atentimento !"
    
            ]);

            exit;
        }

       
    }

    public static function Term_Code() :void
    {

        $data = json_decode(file_get_contents("php://input")); 

        if (empty($data->vetor) || empty($data->obs)) {

            echo json_encode([

                'Mensagem' => "Adicione os valores!"
    
            ]);

            exit;

        }



        Sql::query("UPDATE `fila` SET status = :status, obs = :obs WHERE code = :code", array(':status' => "Atendimento finalizado",':obs' => $data->obs ,':code' => $data->vetor));

        echo json_encode([

            'sucesso' => 1

        ]);

        exit;
        
    }
}

?>