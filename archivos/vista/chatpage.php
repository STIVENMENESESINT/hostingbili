<?php
// Incluir el archivo de conexión a la base de datos y otras configuraciones necesarias
include_once('../../include/conex.php');
header('Content-Type: text/html; charset=' . $charset);
header('Cache-Control: no-cache, must-revalidate');
session_name($session_name);
session_start();
$conn = Conectarse();
    $sql = "SELECT * FROM `chat`";
    $query = mysqli_query($conn, $sql);

    if (!$query) {
        die("Error executing query: " . mysqli_error($conn));
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" href="path/to/bootstrap.min.css">
    <style>
    body {
        background-color: #333;
    }

    h2 {
        color: white;
    }

    label {
        color: white;
    }

    span {
        color: #673ab7;
        font-weight: bold;
    }

    .chat-container {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 50%;
        
        transition: transform 0.3s ease-in-out;
        transform: translateY(90%);
    }

    .chat-container:hover {
        transform: translateY(0%);
    }

    .container {
        width: 60%;
        background-color: rgba(38, 38, 43, 0.9);
        padding: 20px;
        border-radius: 10px;
        margin: 0 auto;
        margin-top: 3%;
    }

    .btn-primary {
        background-color: #673AB7;
    }

    .display-chat {
        height: 300px;
        
        margin-bottom: 4%;
        overflow: auto;
        padding: 15px;
        border-radius: 5px;
    }

    .message {
        background-color: #c616e469;
        color: white;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 10px;
    }

    textarea {
        width: 100%;
        height: 80px;
        resize: none;
        border-radius: 5px;
        padding: 10px;
        border: 1px solid #ccc;
    }
    </style>
</head>

<body>
    <div class="chat-container">
        <div class="container">
            <center>
            
                <label>Acá puedes hablar tranquil@</label>
            </center>
            <br />
            <div class="display-chat" id="display-chat">
                <?php
                if(mysqli_num_rows($query) > 0) {
                    while($row = mysqli_fetch_assoc($query)) {
                ?>
                <div class="message">
                    <p>
                        <span><?php echo htmlspecialchars($row['name']); ?> :</span>
                        <?php echo htmlspecialchars($row['message']); ?>
                    </p>
                </div>
                <?php
                    }
                } else {
                ?>
                <div class="message">
                    <p>No hay ninguna conversación previa.</p>
                </div>
                <?php
                } 
                ?>
            </div>

            <form class="form-horizontal" method="post" action="sendMessage.php">
                <div class="form-group">
                    <div class="col-sm-10">
                        <textarea name="msg" class="form-control" placeholder="Ingresa tu mensaje acá..."
                            required></textarea>
                    </div>
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        // Auto-refresh the chat every 20 seconds
        setInterval(function() {
            $('#display-chat').load(window.location.href + ' #display-chat');
        }, 20000); // 20 seconds
    });
    </script>
</body>

</html>