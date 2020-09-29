<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    include_once('../Model/usuario.php');
    require_once('./jsonResponse.php');
    class LoginController
    {
        public function login()
        {
            $user = $_POST['user'];$password = $_POST['password'];
            if($user!="" && $password!="") 
            {
                $res = Usuario::login($user,$password);
                if($res==True) return JsonResponse::Save(True,'Usuario logeado con éxito!',$res);
                else {
                    return JsonResponse::Save(False,'Usuario o Contraseña incorrecta',NULL);
                }
            }
            else return JsonResponse::Save(False,'Campos vacios',NULL);
        }

        public function register()
        {
            $user = $_POST['user'];$password = $_POST['password'];$email = $_POST['email'];$rol = 2;
            if($user!="" && $password!="" && $email!="")
            {
                $rep = Usuario::findOne(" nombreDeUsuario = '{$user}'");
                echo $rep;
                if($rep) return JsonResponse::Save(False,'Usuario inválido.',NULL);
                else {
                    $usuario = new Usuario($user,$password,$rol,$email);
                    $res = $usuario->create();
                    echo $res;
                    if($res==True) return JsonResponse::Save(True,'Usuario creado con éxito!',$res);
                    else return JsonResponse::Save(False,'Usuario inválido.',$res);
                }
            }
            else return JsonResponse::Save(False,'Campos vacíos.',NULL);
        }
    }


    $login = new LoginController();
    switch($_POST['option'])
    {
        case '1': $login->login(); break;
        case '2': $login->register(); break;
    }
?>