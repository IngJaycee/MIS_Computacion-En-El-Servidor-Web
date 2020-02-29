<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio</title>
    <link rel="stylesheet" href="file/css/estilos.css">
</head> 

<header>
  <h1>Computación en el Servidor WEB</h1>
  <h2>Bienvenid@<?php echo " $user,";?> has accedido correctamente.</h2>
</header>

<body>
    <div class="home-page">
        <div class="form">
            <form id="profile-form" class="profile-form" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
                Usuario:<input placeholder="Usuario" type="text" name="mUser" id="mUser" required="required" value ="<?php echo $user["name"];?>" disabled/>
                Contraseña:<input placeholder="Constraseña" type="password" name="mPass" id="mPass" required="required" disabled/>
                Nombre Completo:<input placeholder="Nombre completo" type="text" name="mFullName" id="mFullName" value ="<?php echo $user["name"]; ?>" disabled/>
                <button id = "saveBtn">Guardar</button>
            </form>

            <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <input style="display:none" type="text" name="deleteUser" id="deleteUser" value="true">
                <input class="delete" type="submit" value="Eliminar Usuario">
            </form>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <input style="display:none" type="text" name="closeSession" id="closeSession" value="true">
                <button class="close" type ="summit">CERRAR SESIÓN</button>
            </form>
        </div>
    </div>
</body>

</html>