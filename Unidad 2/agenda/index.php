<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Agenda</title>
    <style>
        body { padding-top: 30px; background-color: #f8f9fa; }
        .container { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

<div class="container">
    <h2 class="mb-4">Nueva Agenda de Contactos</h2>
    <form action="wagenda.php" method="POST">

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" placeholder="Escribe tu nombre" id="nombre" name="nombre" required>
        </div>

        <div class="form-group">
            <label for="apellidos">Apellidos</label>
            <input type="text" class="form-control" placeholder="Escribe tus apellidos" id="apellidos" name="apellidos" required>
        </div>

        <div class="form-group">
            <label for="fnacimiento">Fecha de nacimiento</label>
            <input type="date" class="form-control" id="fnacimiento" name="fnacimiento" required>
        </div>

        <div class="form-group">
            <label for="estadocivil">Estado civil</label>
            <select class="form-control" id="estadocivil" name="estadocivil" required>
                <option value="">Selecciona una opción...</option>
                <option>Soltero</option>
                <option>Casado</option>
                <option>Divorciado</option>
                <option>Viudo</option>
                <option>Unión Libre</option>
            </select>
        </div>

        <div class="form-group">
            <label for="origen">Origen</label>
            <input list="origenes" id="origen" name="origen" class="form-control" placeholder="Escribe el municipio de origen" required>
            <datalist id="origenes">
                <option value="Gómez Palacio">
                <option value="Lerdo">
                <option value="Torreón">
                <option value="Matamoros">
                <option value="Tlahualilo">
                <option value="Santa Clara">
            </datalist>
        </div>

        <div class="form-group">
            <label for="correo">Correo electrónico</label>
            <input type="email" class="form-control" id="correo" name="correo" placeholder="you@example.com" required>
        </div>

        <div class="form-group">
            <label for="redess">Redes Sociales</label>
            <input type="text" id="redess" name="redess" class="form-control" placeholder="Escribe tus redes sociales separados por comas">
        </div>

        <button type="submit" class="btn btn-primary btn-block">Guardar Contacto</button>
    </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</body>
</html>