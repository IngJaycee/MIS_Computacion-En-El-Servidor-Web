<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso</title>
    <link rel="stylesheet" href="file/css/estilos.css">
</head>

<header>
  <h1>Computación en el Servidor WEB</h1>
  <h2>Acceso a sistema</h2>
</header>   

<body>
    <div class="login-page">
        <div class="form">
            <form id="login-form" class="login-form" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <input placeholder="Usuario" type="text" name="mUser" id="mUser" required="required" />
                <input placeholder="Constraseña" type="password" name="mPass" id="mPass" required="required" />

                <div style="display:<?php echo ($result == "LOGIN_FAIL") ? "block": "none" ; ?>">Por favor ingrese credenciales validas o registre su usuario.</div>
                <div style="display:<?php echo ($result == "REGISTER_OK") ? "block": "none" ; ?>">Registro exitoso.</div>
                <div style="display:<?php echo ($result == "REGISTER_USED_ERROR") ? "block": "none" ; ?>">Usuario no disponible.</div>

                <button>Acceder</button>
                <p class="message">no se ha registrado?</p>
            </form>

            <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <input style="display:none" type="text" name="register" id="register" value="true">
                <input type="submit" value="Registrar">
            </form>
        </div>
    </div>
</body>

</html>