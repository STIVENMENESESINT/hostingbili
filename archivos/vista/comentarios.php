<?php
// Incluir el archivo de conexión a la base de datos y otras configuraciones necesarias
include_once('../../include/conex.php');
header('Content-Type: text/html; charset='.$charset);
header('Cache-Control: no-cache, must-revalidate');
session_name($session_name);
session_start();
$conn = Conectarse();

// Verificar si hay una sesión activa
if (isset($_SESSION['id_userprofile'])) {
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>MURO DE COMENTARIOS BILINGUISMO</title>
    <!-- Incluir enlaces a los archivos CSS y otros metadatos necesarios -->
    <?php include_once('cabecera.php'); ?>
    <link rel="stylesheet" type="text/css" href="../../herramientas/css/css/styles.css">
    <link rel="stylesheet" type="text/css" href="../../herramientas/css/css/layout.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">
    <meta charset="utf-8">
    
</head>

<body>
    <div class="layout">
        <!-- Menú de navegación -->
        <aside class="layout__aside">
            <div class="aside__user-info">
                <?php include_once('menu.php'); ?>
            </div>
            <div>
                <?php include_once('cabeceraMenu.php'); ?>
            </div>
        </aside>
        <!-- Contenido principal -->
        <div class="layout__content">
            <div class="content__page">



                <div id="contenido">
                    <!-- Integrar el muro de comentarios -->
                <div class="container">
  <div class="row">
    <div class="col-md-12">
      <h4>MURO DE COMENTARIOS BILINGUISMO </h4>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
<div class="panel-body">

<!--Inicio elementos contenedor-->

<div class="comment-form-container">
            <form id="frm-comment">
                <div class="input-row">
                    <input type="hidden" name="comentario_id" id="commentId"
                           placeholder="Name" /> <input class="input-field"
                           type="text" name="name" id="name" placeholder="Nombres" />
                </div>
                <div class="input-row">
                    <textarea class="input-field" type="text" name="comment"
                              id="comment" placeholder="Agregar comentario">  </textarea>
                </div>
                <div>
                    <input type="button" class="btn-submit" id="submitButton"
                           value="Publicar Ahora" /><div id="comment-message">Comentario ha sido agregado exitosamente!</div>
                </div>
				<div style="clear:both"></div>
            </form>
        </div>
        <div id="output"></div>
        <script>
            var totalLikes = 0;
            var totalUnlikes = 0;
           
            function postReply(commentId) {
                $('#commentId').val(commentId);
                $("#name").focus();
            }

            $("#submitButton").click(function () {
                $("#comment-message").css('display', 'none');
                var str = $("#frm-comment").serialize();

                $.ajax({
                    url: "AgregarComentario.php",
                    data: str,
                    type: 'post',
                    success: function (response)
                    {
                        var result = eval('(' + response + ')');
                        if (response)
                        {
                            $("#comment-message").css('display', 'inline-block');
                            $("#name").val("");
                            $("#comment").val("");
                            $("#commentId").val("");
                            listComment();
                        } else
                        {
                            alert("Failed to add comments !");
                            return false;
                        }
                    }
                });
            });

            $(document).ready(function () {
                listComment();
            });

            function listComment() {
                $.post("ListaDeComentarios.php",
                        function (data) {
                            var data = JSON.parse(data);

                            var comments = "";
                            var replies = "";
                            var item = "";
                            var parent = -1;
                            var results = new Array();

                            var list = $("<ul class='outer-comment'>");
                            var item = $("<li>").html(comments);

                            for (var i = 0; (i < data.length); i++)
                            {
                                var commentId = data[i]['comentario_id'];
                                parent = data[i]['parent_comentario_id'];

                                var obj = getLikesUnlikes(commentId);
                                
                                if (parent == "0")
                                {
                                	if(data[i]['like_unlike'] >= 1) 
                                    {
                                        like_icon = "<img src='img/MeGusta.png'  id='unlike_" + data[i]['comentario_id'] + "' class='like-unlike'  onClick='likeOrDislike(" + data[i]['comentario_id'] + ",-1)' />";
                                        like_icon += "<img style='display:none;' src='img/NoMeGusta.png' id='like_" + data[i]['comentario_id'] + "' class='like-unlike' onClick='likeOrDislike(" + data[i]['comentario_id'] + ",1)' />";
                                    }
                                    else
                                    {
                                    	   like_icon = "<img style='display:none;' src='img/MeGusta.png'  id='unlike_" + data[i]['comentario_id'] + "' class='like-unlike'  onClick='likeOrDislike(" + data[i]['comentario_id'] + ",-1)' />";
                                        like_icon += "<img src='img/NoMeGusta.png' id='like_" + data[i]['comentario_id'] + "' class='like-unlike' onClick='likeOrDislike(" + data[i]['comentario_id'] + ",1)' />";
                                        
                                    }
                                    
                                    comments = "\
                                        <div class='comment-row'>\
                                            <div class='comment-info'>\
                                                <span class='commet-row-label'>De</span>\
                                                <span class='posted-by'>" + data[i]['comment_sender_name'] + "</span>\
                                                <span class='commet-row-label'>a las </span> \
                                                <span class='posted-at'>" + data[i]['date'] + "</span>\
                                            </div>\
                                            <div class='comment-text'>" + data[i]['comment'] + "</div>\
                                            <div>\
                                                <a class='btn-reply' onClick='postReply(" + commentId + ")'>Responder</a>\
                                            </div>\
                                            <div class='post-action'>\ " + like_icon + "&nbsp;\
                                                <span id='likes_" + commentId + "'> " + totalLikes + " Me Gusta </span>\
                                            </div>\
                                        </div>";

                                    var item = $("<li>").html(comments);
                                    list.append(item);
                                    var reply_list = $('<ul>');
                                    item.append(reply_list);
                                    listReplies(commentId, data, reply_list);
                                }
                            }
                            $("#output").html(list);
                        });
            }

            function listReplies(commentId, data, list) {

                for (var i = 0; (i < data.length); i++)
                {

                    var obj = getLikesUnlikes(data[i].comentario_id);
                    if (commentId == data[i].parent_comentario_id)
                    {
                        if(data[i]['like_unlike'] >= 1) 
                        {
                            like_icon = "<img src='img/MeGusta.png'  id='unlike_" + data[i]['comentario_id'] + "' class='like-unlike'  onClick='likeOrDislike(" + data[i]['comentario_id'] + ",-1)' />";
                            like_icon += "<img style='display:none;' src='img/NoMeGusta.png' id='like_" + data[i]['comentario_id'] + "' class='like-unlike' onClick='likeOrDislike(" + data[i]['comentario_id'] + ",1)' />";
                            
                        }
                        else
                        {
                         like_icon = "<img style='display:none;' src='img/NoMeGusta.png'  id='unlike_" + data[i]['comentario_id'] + "' class='like-unlike'  onClick='likeOrDislike(" + data[i]['comentario_id'] + ",-1)' />";
                         like_icon += "<img src='img/NoMeGusta.png' id='like_" + data[i]['comentario_id'] + "' class='like-unlike' onClick='likeOrDislike(" + data[i]['comentario_id'] + ",1)' />";
                            
                        }
                        var comments = "\
                                        <div class='comment-row'>\
                                            <div class='comment-info'>\
                                                <span class='commet-row-label'>De </span>\
                                                <span class='posted-by'>" + data[i]['comment_sender_name'] + "</span>\
                                                <span class='commet-row-label'>a las </span> \
                                                <span class='posted-at'>" + data[i]['date'] + "</span>\
                                            </div>\
                                            <div class='comment-text'>" + data[i]['comment'] + "</div>\
                                            <div>\
                                                <a class='btn-reply' onClick='postReply(" + data[i]['comentario_id'] + ")'>Responder</a>\
                                            </div>\
                                            <div class='post-action'> " + like_icon + "&nbsp;\
                                                <span id='likes_" + data[i]['comentario_id'] + "'> " + totalLikes + " Me Gusta </span>\
                                            </div>\
                                        </div>";

                        var item = $("<li>").html(comments);
                        var reply_list = $('<ul>');
                        list.append(item);
                        item.append(reply_list);
                        listReplies(data[i].comentario_id, data, reply_list);
                    }
                }
            }

            function getLikesUnlikes(commentId)
            {

                $.ajax({
                    type: 'POST',
                    async: false,
                    url: 'Envio_MeGusta.php',
                    data: {comentario_id: commentId},
                    success: function (data)
                    {
                        totalLikes = data;
                    }

                });

            }
            
                         
           function likeOrDislike(comentario_id,like_unlike)
            {
              
                $.ajax({
                    url: 'MeGusta_NoMeGusta.php',
                    async: false,
                    type: 'post',
                    data: {comentario_id:comentario_id,like_unlike:like_unlike},
                    dataType: 'json',
                    success: function (data) {
                        
                        $("#likes_"+comentario_id).text(data + " likes");
                        
                        if (like_unlike == 1) { 
                            $("#like_" + comentario_id).css("display", "none");
                            $("#unlike_" + comentario_id).show();
                        }

                        if (like_unlike == -1) {
                            $("#unlike_" + comentario_id).css("display", "none");
                            $("#like_" + comentario_id).show();
                        }
                        
                    },
                    error: function (data) {
                        alert("error : " + JSON.stringify(data));
                    }
                });
            }
           
            

        </script>

<!--Fin elementos contenedor-->
</div>
</div>
  </div>
</div>


</body>
</html>

</html>
<?php
} else {
    // Si no hay una sesión activa, redirigir al usuario a la página de inicio de sesión
    header("Location: ../../index.php");
}
?>
