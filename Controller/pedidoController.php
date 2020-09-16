<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    include_once('../Model/pedido.php');
    require_once('./jsonResponse.php');
    class PedidoController
    {
        public function crearPedido(){
            if($_POST)
            {
                if($_POST['username'] != '' && $_POST['descripcionPedido'] != '')
                {
                    $pedido = new Pedido($_POST['descripcionPedido'],$_POST['username'],0,0);
                    $res = $pedido->create();
                    if($res===true) return JsonResponse::Save(True,'Creado con éxito ',$res);
                    return JsonResponse::Save(False,'Error al crear ',$res);
                }
            }
            else return JsonResponse::Save(False,'Error en la peticion',null);
        }
    }

    $login = new PedidoController();
    $login->crearPedido();
?>