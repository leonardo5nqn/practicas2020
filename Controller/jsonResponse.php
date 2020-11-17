<?php 
    class JsonResponse
    {
        public static function Save($status,$message,$data)
        { 
            $res=[];
            $res['status']=$status;
            $res['message']=$message;
            $res['data']=$data;   
            echo json_encode($res);      
            exit();
        }
    }
?>