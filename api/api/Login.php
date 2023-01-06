<?php 
namespace api;

require_once("model/DAO.php");

use model\Sql;

session_start();

class Login 
{
    public static function Login() : void
    {

        $data = json_decode(file_get_contents("php://input"));

        if (empty($data->user)):
            http_response_code(400);
            echo json_encode(['sucesso' => 0, 'mensagem' => 'Adicione o usuário!']);
            exit;
        endif;

        if (empty($data->senha)):
            http_response_code(400);
            echo json_encode(['sucesso' => 0, 'mensagem' => 'Adicione a senha!']);
            exit;
        endif;


        $user = htmlspecialchars(strip_tags($data->user));
        $senha = htmlspecialchars(strip_tags($data->senha));


        $array_params = array(':user' => $user);

        $dados = Sql::select("SELECT senha FROM `bank_auth` WHERE user = :user", $array_params);

        if (count($dados) > 0){     

            $resu = $dados[0];

            if(password_verify($senha, $resu['senha'])){

                session_regenerate_id();
                

                http_response_code(200);  //HTTP 200 OK
                echo json_encode([
                'Sucesso' => 1,
                'Mensagem' => 'Usuário autenticado - '. $user,
                'Session_id' => session_id()]);
                exit; 

            }else{
                http_response_code(400);
                echo json_encode([
                    'Sucesso' => 0,
                   'Mensagem' => 'Usuário ou senha inválidos!'
                ]);
                exit;
            }


        }else{
            http_response_code(400);
            echo json_encode([
                'Sucesso' => 0,
               'Mensagem' => 'Usuário ou senha inválidos!'
            ]);
            exit;
        }
    }
}






?>