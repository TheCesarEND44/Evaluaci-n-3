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
              <button class="dropbtn"><i class="fas fa-user"></i><?php echo $correo=$_SESSION['correo']; ?>
                <i class="fa fa-caret-down"></i>
              </button>
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
<h2>Datos lote - Agregar</h2>
<div class="card">
    <div class="container">
        <form id="datos">
          <div class="row">
            <div class="col-25">
              <label>Responsable</label>
            </div>
            <div class="col-75">
              <input type="text" id="nombre">
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label>Fecha de inicio de producción</label>
            </div>
            <div class="col-75">
              <input type="date" id="fecha_i" min="01-01-2015" max="01-01-2021" required>
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label>Fecha de terminación de producción</label>
            </div>
            <div class="col-75">
              <input type="date" id="fecha_t" min="01-01-2015" max="01-01-2021" required>
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label>Tipo de piezas</label>
            </div>
            <div class="col-75">
              <select id="tipo" name="country">
                <option value="chica">Chica</option>
                <option value="mediana">Mediana</option>
                <option value="grande">Grande</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label >Número de piezas</label>
            </div>
            <div class="col-75">
              <input type="number" id="num_piezas" pattern="[0-9]*" placeholder="Número de piezas" required>
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label>Número de piezas defectuosas</label>
            </div>
            <div class="col-75">
              <input type="number" id="num_d" pattern="[0-9]*" placeholder="Número de piezas defectuosas" required>
            </div>
          </div>
          <div class="row">
            <input type="submit" onclick="post()" value="Guardar">
          </div>
        </form>
      </div>
  </div>

    
    <div class="footer">
      <p>Durango - Mezquital, 34308 Gabino Santillán, Dgo</p>
    </div>


<script>
  function post(){
    var nom = document.getElementById("nombre").value;
    var fi = document.getElementById("fecha_i").value;
    var ft = document.getElementById("fecha_t").value;
    var t = document.getElementById("tipo").value;
    var np = document.getElementById("num_piezas").value;
    var nd = document.getElementById("num_d").value;
    const datos = {"responsable": nom,"inicio_produccion": fi,"termino_produccion": ft,"tipo_piezas": t,"numero_piezas": np,"numero_defectuosas": nd};
    const texto = JSON.stringify(datos);
    //var formElement = document.getElementById("datos");
    var request = new XMLHttpRequest();
    request.open("POST", "http://localhost/apirest/lotes");
    request.send(texto);
    Swal.fire('Se registro el lote')

  }
</script>

</body>
</html>
