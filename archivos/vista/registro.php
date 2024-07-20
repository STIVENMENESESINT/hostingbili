<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('https://www.sena.edu.co/es-co/Noticias/NoticiasImg/SemanaIdiomas_19oct2018.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: 'Roboto', sans-serif;
            position: relative;
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .main-container {
            background: rgba(255, 255, 255, 0.5);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            animation: fadeIn 1s ease-in-out;
            width: 50%;
            max-width: 500px;
            margin: 20px;
            text-align: center;
        }
        .title {
            color: #6a0dad;
            font-size: 1.5em;
            margin-bottom: 20px;
        }
        .label {
            color: black;
        }
        .input {
            background: rgba(255, 255, 255, 0.8);
            border: none;
            border-radius: 5px;
            padding: 10px;
            font-size: 1em;
        }
        .input:focus {
            outline: none;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
        }
        .button {
            background-color: #17a2b8;
            color: #fff;
            border: none;
            border-radius: 25px;
            padding: 10px 20px;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #138496;
        }
        .has-text-centered {
            text-align: center;
        }
        .mb-4 {
            margin-bottom: 1.5rem;
        }
        .mt-3 {
            margin-top: 1rem;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body>
    <div class="overlay">
        <div class="main-container">
            <h5 class="title is-5 has-text-centered is-uppercase">Registro de Nuevo Usuario</h5>
            <form action="./php/usuario_guardar.php" method="POST" autocomplete="off">
                <div class="field">
                    <label class="label">Nombres:</label>
                    <div class="control">
                        <input class="input" type="text" name="usuario_nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Apellidos:</label>
                    <div class="control">
                        <input class="input" type="text" name="usuario_apellido" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Usuario:</label>
                    <div class="control">
                        <input class="input" type="text" name="usuario_usuario" pattern="[a-zA-Z0-9]{4,20}" maxlength="20" required>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Email:</label>
                    <div class="control">
                        <input class="input" type="email" name="usuario_email" maxlength="70">
                    </div>
                </div>
                <div class="field">
                    <label class="label">Clave:</label>
                    <div class="control">
                        <input class="input" type="password" name="usuario_clave_1" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Repetir clave:</label>
                    <div class="control">
                        <input class="input" type="password" name="usuario_clave_2" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required>
                    </div>
                </div>
                <p class="has-text-centered mb-4 mt-3">
                    <button type="submit" class="button is-info is-rounded">Guardar</button>
                </p>
            </form>
        </div>
    </div>
</body>
</html>
