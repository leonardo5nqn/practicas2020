<?php
    error_reporting(0);
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    include_once('../Model/pedido.php');
    require_once('./jsonResponse.php');
    class PedidoController
    {
        public function crearPedido(){
            if($_POST)
            {
                if($_POST['username'] != '' && $_POST['descripcionPedido'] != '')
                {
                    $pedido = new Pedido(null,$_POST['descripcionPedido'],$_POST['username'],Date('dmY'));
                    $res = $pedido->create();
                    if($res===true) return JsonResponse::Save(True,'Creado con éxito ',$res);
                    return JsonResponse::Save(False,'Error al crear ',$res);
                }
            }
            else return JsonResponse::Save(False,'Error en la peticion',null);
        }

        public function listarPedidos(){
            if($_POST)
            {
                $pedidos = Pedido::findAll();
                return ($pedidos!=false ? JsonResponse::Save(true,'Listado de pedidos',$pedidos) : JsonResponse::Save(false,'Error en la solicitud',null));
            }
            else return JsonResponse::Save(False,'Error en la peticion',null);
        }

        public function updatePedido()
        {
            
        }
    }
    $pedido = new PedidoController();
    switch($_POST['option'])
    {
        case '1': $pedido->crearPedido(); break;
        case '2': $pedido->listarPedidos(); break;
        case '3': $pedido->updatePedido(); break;
    }
    
    
?>