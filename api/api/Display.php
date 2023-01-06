<?php 
namespace api;

require_once("model/DAO.php");

use model\Sql;
class Display
{
    public static function min_arr($var)
    {
        $lista = [];

        for ($i=0; $i < sizeof($var); $i++) { 
            
            $temp = $var[$i];

            $lista[$i] = $temp['code'];
        }

        return $lista;
    }


    public static function find_me( $vetor) {

        $query = Sql::select("SELECT caixa FROM `fila` WHERE code = :code", array(':code' => $vetor));


        return $query[0];
    }


    public static function Select_Display() :void
    {

        $sql = Sql::select("SELECT code FROM `fila` WHERE status = :status", array(':status' => "em andamento"));

        
        $lista = Display::min_arr($sql);

        $len = count($lista);

        $var = [];
        $var_comum = [];

        for ($i=0; $i < $len ; $i++) { 

            if (preg_match('/[P]/', $lista[$i])) {
                
                $var[$i] = $lista[$i];

            }else{
                $var_comum[$i] = $lista[$i];
            }

        }


        $comum = null;
        $comum_code = null;

        $prioritario = null;
        $prioritario_code = null;

        if (count($var_comum) > 0) {
            
            $comum = Display::find_me(min($var_comum));
            $comum_code = min($var_comum);

        }
        
        if(count($var) > 0){

            $prioritario = Display::find_me(min($var));
            $prioritario_code = min($var);
        }

    

        echo json_encode([

            'comum_caixa' => $comum,
            'comum_code' => $comum_code,
            'prioritario_caixa' => $prioritario,
            'prioritario_code' => $prioritario_code
        ]);

        exit;
       
    }
}



?>