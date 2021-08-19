<?php
require_once 'clases/respuestas.class.php';
require_once 'clases/lotes.class.php';

$_respuestas = new respuestas;
$_lotes = new lotes;


if($_SERVER['REQUEST_METHOD'] == "GET"){

    if(isset($_GET['codigo'])){
        $loteid = $_GET['codigo'];
        $datosLote = $_lotes->obtenerLotes($loteid);
        header("Content-Type: application/json");
        echo json_encode($datosLote);
        http_response_code(200);
    }
    

}else if($_SERVER['REQUEST_METHOD'] == "POST"){
    $postBody = file_get_contents("php://input");
    $datosArray = $_lotes->post($postBody);
     header('Content-Type: application/json');
     if(isset($datosArray["result"]["error_id"])){
         $responseCode = $datosArray["result"]["error_id"];
         http_response_code($responseCode);
     }else{
         http_response_code(200);
     }
     echo json_encode($datosArray);
    
}else if($_SERVER['REQUEST_METHOD'] == "DELETE"){
    $headers = getallheaders();
    if(isset($headers["codigo"])){
        $send = [
            "codigo" =>$headers["codigo"]
        ];
        $postBody = json_encode($send);
    }else{
        $postBody = file_get_contents("php://input");
    }
    $datosArray = $_lotes->delete($postBody);
    header('Content-Type: application/json');
    if(isset($datosArray["result"]["error_id"])){
        $responseCode = $datosArray["result"]["error_id"];
        http_response_code($responseCode);
    }else{
        http_response_code(200);
    }
    echo json_encode($datosArray);
}else{
  header('Content-Type: application/json');
  $datosArray = $_respuestas->error_405();
  echo json_encode($datosArray);
}

?>