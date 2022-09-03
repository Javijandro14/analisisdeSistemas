<html lang="en">

<?php
include 'conexion.php';
// $sql = "SELECT U.ID_USER, U.NAMES, U.USERNAME, U.PASSWD, U.EMAIL, A.AREA FROM [TBLUSER] U, [TBLAREA] A WHERE U.ID_AREA = A.ID_AREA";
// $usuarios = sqlsrv_query($con, $sql);
$sql = "SELECT * FROM [TBLSERVICE]";
$servicios = sqlsrv_query($con, $sql);
?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <title>Crear Nuevo Caso</title>
    <script src="script.js"></script>
</head>

<body>
    <nav id="nav" style="text-align: left; display:flex; height:60px;">
        <img src="logo.jpg" width="80px" ><h3 style="padding-top:10px;padding-bottom:10px;padding-left:10px;">Freshservice.inc</h3>
    </nav>

    <?php
    include 'caso.php'
    ?>
    <div id="menu">
        <nav id="formTitle">
            <h2 style="font-weight: 600;">Crear un nuevo Caso </h2>
        </nav>
        <form method="POST" id="Nuevo" action="index.php">
            <h2 for="comments">Informacion del Usuario</h2>
            <label for="correo">Ingrese su Correo Electronico</label>

            <input type="text" name="correo" placeholder="email@example.com" required id="email" onkeyup="showResult(this.value)">
            <!-- <button type="button" onclick="showUser(document.getElementById('email').value)" for="correo" >Ingresar</button> -->
            <div id="livesearch" for="correo">

            </div>
            <br>
            <label for="usuario">Usuario</label>
            <input type="text" name="usuario" id="user" placeholder="Usuario" readonly disabled>

            <label for="usuario">Departamento</label>
            <input type="text" name="departamento" id="area" placeholder="Departamento" readonly disabled>

            <h2>Servicios</h2>
            <label style='color:red;' for='service'>Elige solo un servicio</label> <br>
            <div id="service">
                <?php
                while ($serv = sqlsrv_fetch_array($servicios, SQLSRV_FETCH_NUMERIC)) {
                    echo "<div><input type='radio' name='option' value='" . $serv[0] . "' required>" . "<label for='" . $serv[0] . "'>" . $serv[1] . "</label></div>";
                }
                ?>
            </div>

            <h2 for="comments">Comentarios Adicionales</h2>
            <h5 style="display: inline;">Caracteres disponible: <strong id="char">150</strong></h5><br>
            <textarea name="comments" id="comments" cols="60" rows="4" placeholder="Describa mas sobre su caso..." onkeyup="countdown()"></textarea>
            <br><br>

            <button type="submit" class="btn btn-info" id="new" name="new" value="Add Case">Crear Caso</button><br>
            <br><button class="btn btn-outline-primary" id="borrar" type="reset">Borrar Ingreso de Datos</button>
        </form>
    </div>

</body>

</html>