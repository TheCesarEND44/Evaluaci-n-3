<?php
session_start();
$correo=$_SESSION['correo'];
if($correo==null || $correo=''){
header('location:login.html');
die();
}
?>
<!DOCTYPE html>
<html>
<head>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <link href="css/styles.css" rel="stylesheet">
    <link rel="icon" type="image/icon" href="img/logoutd.png" />
    <script src="https://kit.fontawesome.com/ca1ea61cbb.js" crossorigin="anonymous"></script>
    <div class="navbar">
      <img src="img/logoutd.png" alt="logo" class="logo">
        <a href="#"><i class="fas fa-cog"></i>Configuración</a>
        <div class="dropdown">
          <button class="dropbtn"><i class="fas fa-user"></i><?php echo $correo=$_SESSION['correo']; ?></button>
            <div class="dropdown-content">
              <a href="log_out.php">Salir</a>
            </div>
          </div> 
        <div class="dropdown">
          <button class="dropbtn">Producción 
            <i class="fa fa-caret-down"></i>
          </button>
          <div class="dropdown-content">
            <a href="index.php">Agregar</a>
            <a href="eliminar.php">Eliminar</a>
          </div>
        </div> 
      </div>
</head>
<body>
<h2>Datos vendedor - Eliminar</h2>
<div class="card">
    <div class="container">
        <form>
          <div class="row">
            <div class="col-25">
              <label>Número de lote</label>
            </div>
            <div class="col-75">
              <input type="text" id="codigo" pattern="[0-9]*" placeholder="Ingresar número de lote" required>
              <div class="row">
              <button type="button" onclick="get()">Buscar</button>
          </div>

              <script>
             
                function get() {
                  var c = document.getElementById("codigo").value;
                  var url="http://localhost/apirest/lotes?codigo="+c;
                  var xhttp = new XMLHttpRequest();
                  xhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200) {
                         Swal.fire(
                              'Listo!',
                              'Lote encontrado!',
                              'success'
                      )
                    var jsonResponse = JSON.parse(this.responseText);
                    console.log(jsonResponse[0]["codigo"]);
                    document.getElementById("nombre").value = jsonResponse[0]["responsable"];
                    document.getElementById("fecha_i").value = jsonResponse[0]["inicio_produccion"];
                    document.getElementById("fecha_t").value = jsonResponse[0]["termino_produccion"];
                    document.getElementById("tipo").value = jsonResponse[0]["tipo_piezas"];
                    document.getElementById("num_p").value = jsonResponse[0]["numero_piezas"];
                    document.getElementById("num_d").value = jsonResponse[0]["numero_defectuosas"];
                    //document.getElementById("demo").innerHTML = this.responseText.JSON;
                 }
               };
               xhttp.open("GET", url, true);
               xhttp.send();
             }
             </script>
             <span id="demo"></span>
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label>Responsable</label>
            </div>
            <div class="col-75">
              <input type="text" id="nombre" disabled>
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label>Fecha de inicio de producción</label>
            </div>
            <div class="col-75">
              <input type="date" min="01-01-2015" max="01-01-2021" id="fecha_i" disabled>
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label>Fecha de terminación de producción</label>
            </div>
            <div class="col-75">
              <input type="date" id="fecha_t" min="01-01-2015" max="01-01-2021" disabled>
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label>Tipo de piezas</label>
            </div>
            <div class="col-75">
              <select id="tipo" name="country" disabled>
                <option value="chica">Chica</option>
                <option value="mediana">Mediana</option>
                <option value="grande">Grande</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label>Número de piezas</label>
            </div>
            <div class="col-75">
              <input type="number" id="num_p" pattern="[0-9]*" disabled>
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label>Número de piezas defectuosas</label>
            </div>
            <div class="col-75">
              <input type="number" id="num_d" pattern="[0-9]*" disabled>
            </div>
          </div>
          <div class="row">
            <input type="submit" onclick="del()" value="Guardar">
          </div>
        </form>
      </div>
  </div>

  <script>
    function del(){
      var c = document.getElementById("codigo").value;
      const datos = {"codigo": c};
      const texto = JSON.stringify(datos);
      //var formElement = document.getElementById("datos");
      var request = new XMLHttpRequest();
      request.open("DELETE", "http://localhost/apirest/lotes");
      request.send(texto);    
      Swal.fire('Se elimino el lote')
    }
  </script>

    
    <div class="footer">
      <p>Durango - Mezquital, 34308 Gabino Santillán, Dgo</p>
    </div>

</body>
