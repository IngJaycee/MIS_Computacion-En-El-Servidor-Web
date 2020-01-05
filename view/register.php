<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro</title>
</head>
<body>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
    <input style="display:none" type="text" name="register" id="register" value="true">
    Nuevo Usuario: <input type="text" name="regUser" id="regUser" required="required">
    Nueva Constraseña: <input type="password" name="regPass" id="regPass" required="required">
  <input type="submit" value="Guardar">
</form>
</body>
</html>