<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro</title>
    <link rel="stylesheet" href="file/css/estilos.css">
</head>

<header>
  <h1>Computacion en el Servidor WEB</h1>
  <h2>Regristro de nuevos usuarios</h2>
</header>

<body>
    <div class="login-page">
        <div class="form">
            <form id="register-form" class="register-form" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <input placeholder="Usuario" name="regUser" id="regUser" required="required" autocomplete="off" />
                <input placeholder="Constraseña" type="password" name="regPass" id="regPass" required="required" autocomplete="off" />
                <input style="display:none" type="text" name="register" id="register" value="true">
                <button type="submit">Crear</button>
                <p class="message">Ya se ha registrado?</p>
            </form>

            <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <input type="submit" value="Acceder">
            </form>
        </div>
    </div>
</body>

</html>