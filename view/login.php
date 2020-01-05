<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
<div style="display:<?php echo ($result == "LOGIN_FAIL") ? "block": "none" ; ?>">Por favor ingrese credenciales validas o registre su usuario.</div>
<div style="display:<?php echo ($result == "REGISTER_OK") ? "block": "none" ; ?>">Registro exitoso.</div>
<div style="display:<?php echo ($result == "REGISTER_USED_ERROR") ? "block": "none" ; ?>">Usuario no disponible.</div>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
    Usuario: <input type="text" name="mUser" id="mUser" required="required">
    Constraseña: <input type="password" name="mPass" id="mPass" required="required">
  <input type="submit">
</form>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
    <input style="display:none" type="text" name="register" id="register" value="true">
  <input type="submit" value="Registrar">
</form>
</body>
</html>