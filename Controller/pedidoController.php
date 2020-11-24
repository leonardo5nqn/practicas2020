<?php
    error_reporting(0);
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    include_once('../Model/pedido.php');
    include_once('../Model/historicoPedido.php');
    require_once('./jsonResponse.php');
    class PedidoController
    {
        public function crearPedido(){
            if($_POST['username'] != '' && $_POST['descripcionPedido'] != '')
            {
                $pedido = new Pedido(null,$_POST['descripcionPedido'],$_POST['username'],Date('Y-m-d'));
                $res = $pedido->create(); // consultar para bindear nuevo pedido con estado histórico nuevo
                if($res===true) return JsonResponse::Save(True,'Creado con éxito ',$res);
                return JsonResponse::Save(False,'Error al crear ',$res);
            }
        }

        public function listarPedidos(){
            $pedidos = Pedido::findAll();
            return ($pedidos!=false ? JsonResponse::Save(true,'Listado de pedidos',$pedidos) : JsonResponse::Save(false,'Error en la solicitud',null));
        }

        public function updatePedido()
        {
            
        }

        public function historicoPedido() {
            $pedidos = Pedido::findOne(" idSolicitud = '{$_POST['id']}'");
            $historicoPedido = HistoricoPedido::find("Solicitud = '{$pedidos[0]['idSolicitud']}'");
            return ($pedidos!= false ? JsonResponse::Save(true,'Listado histórico de pedidos',$historicoPedido) : JsonResponse::Save(false,'Error al recolectar el histórico',null));
        }
    }
    $pedido = new PedidoController();
    if($_POST)
    switch($_POST['option'])
    {
        case '1': $pedido->crearPedido(); break;
        case '2': $pedido->listarPedidos(); break;
        case '3': $pedido->updatePedido(); break;
        case '4': $pedido->historicoPedido(); break;
    }
    else return JsonResponse::Save(false,'Error de la petición',null);
    
?>