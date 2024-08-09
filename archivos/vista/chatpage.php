<?php

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
    :root {
        --alternate-text: #919191;
        --primary-background: #fff;
        --secondary-background: #E6E6E6;
        --alternate-background: #04324d;
    }

    h2 {
        color: var(--alternate-text);
    }

    label {
        color: white;
    }

    span {
        color: #673;
        font-weight: bold;
    }

    .chat-container {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 50px;
        transition: transform 0.3s ease-in-out, width 0.3s ease-in-out, height 0.3s ease-in-out;
        transform: translateY(calc(100% - 50px));
        background-color: var(--alternate-background);
        border-radius: 5px;
    }

    .chat-container:hover {
        transform: translateY(0%);
        width: 50%;
        height: 500px;
    }

    .btn-primary {
        background-color: var(--alternate-background);
    }

    .display-chat {
        height: 337px;
        margin-bottom: 4%;
        overflow: auto;
        padding: 26px;
        border-radius: 5px;
        background-color: var(--primary-background);
    }

    .message {
        background-color: var(--secondary-background);
        color: var(--alternate-text);
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 10px;
    }
    </style>
</head>

<body>
    <div class="chat-container">
        <div>
            <center>

                <label>Bienvenido </label>
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