<?php
    include_once('../Model/usuario.php');
    require_once('./jsonResponse.php');
    class LoginController
    {
        public static function login()
        {
            $user = $_POST['user'];$password = $_POST['password'];
            if($user!="" || $password!="") 
            {
                $res = Usuario::login($user,$password);
                if($res!=False) return JsonResponse::Save(True,'Usuario logeado con éxito!',$res);
                else {
                    echo JsonResponse::Save(False,'Usuario o Contraseña incorrecta',NULL);
                    return JsonResponse::Save(False,'Usuario o Contraseña incorrecta',NULL);
                    
                }
            }
            return JsonResponse::Save(False,'Campos vacios',NULL);
        }

        public function register($user, $password, $email)
        {

        }
    }

    LoginController::login();
?>