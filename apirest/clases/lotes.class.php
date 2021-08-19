<?php
require_once "conexion/conexion.php";
require_once "respuestas.class.php";


class lotes extends conexion {

    private $table = "lotes";
    private $table2 = "prueba";
    private $nombre = "";
    private $codigoLote = "";
    private $responsable = "";
    private $inicio_produccion="";
    private $termino_produccion="";
    private $tipo_piezas="";
    private $numero_piezas="";
    private $numero_defectuosas="";

 
    public function obtenerLotes($codigo){
        $query = "SELECT * FROM " . $this->table . " WHERE codigo = '$codigo'";
        return parent::obtenerDatos($query);
    }

    public function post($json){
        $_respuestas = new respuestas;
        $datos = json_decode($json,true);

                if(!isset($datos['responsable'])){
                    return $_respuestas->error_400();
                }else{
                    $this->responsable = $datos['responsable'];
                    if(isset($datos['inicio_produccion'])) { $this->inicio_produccion = $datos['inicio_produccion']; }
                    if(isset($datos['termino_produccion'])) { $this->termino_produccion = $datos['termino_produccion']; }
                    if(isset($datos['tipo_piezas'])) { $this->tipo_piezas = $datos['tipo_piezas']; }
                    if(isset($datos['numero_piezas'])) { $this->numero_piezas = $datos['numero_piezas']; }
                    if(isset($datos['numero_defectuosas'])) { $this->numero_defectuosas = $datos['numero_defectuosas']; }
                    $resp = $this->insertarLote();
                    if($resp){
                        $respuesta = $_respuestas->response;
                        $respuesta["result"] = array(
                            "lotesId" => $resp
                        );
                        return $respuesta;
                    }else{
                        return $_respuestas->error_500();
                    }
                }

    }

    private function insertarLote(){
        $query = "INSERT INTO " . $this->table . " (responsable,inicio_produccion,termino_produccion,tipo_piezas,numero_piezas,numero_defectuosas) 
        values 
        ('" . $this->responsable . "','" . $this->inicio_produccion ."','" . $this->termino_produccion ."','" . $this->tipo_piezas ."','" . $this->numero_piezas ."','" . $this->numero_defectuosas ."')"; 
        $resp = parent::nonQueryId($query);
        if($resp){
             return $resp;
        }else{
            return 0;
        }
    }


    public function delete($json){
        $_respuestas = new respuestas;
        $datos = json_decode($json,true);

                if(!isset($datos['codigo'])){
                    return $_respuestas->error_400();
                }else{
                    $this->responsable = $datos['codigo'];
                    $resp = $this->eliminarLote();
                    if($resp){
                        $respuesta = $_respuestas->response;
                        $respuesta["result"] = array(
                            "lotesId" => $resp
                        );
                        return $respuesta;
                    }else{
                        return $_respuestas->error_500();
                    }
                }

    }


    private function eliminarLote(){
        $query = "DELETE FROM " . $this->table . " WHERE codigo= '" . $this->codigoLote . "'";
        $resp = parent::nonQuery($query);
        if($resp >= 1 ){
            return $resp;
        }else{
            return 0;
        }
    }

/*
    public function delete($json){
        $_respuestas = new respuestas;
        $datos = json_decode($json,true);

                if(!isset($datos['codigo'])){
                    return $_respuestas->error_400();
                }else{
                    $this->codigoLote = $datos['codigo'];
                    $resp = $this->eliminarLote();
                    if($resp){
                        $respuesta = $_respuestas->response;
                        $respuesta["result"] = array(
                            "lotesId" => $resp
                        );
                        return $respuesta;
                    }else{
                        return $_respuestas->error_500();
                    }
                }

    }


    private function eliminarLote(){
        $query = "DELETE FROM " . $this->table . " WHERE codigo= '" . $this->codigoLote . "'";
        $resp = parent::nonQuery($query);
        if($resp >= 1 ){
            return $resp;
        }else{
            return 0;
        }
    }
    */

}






?>