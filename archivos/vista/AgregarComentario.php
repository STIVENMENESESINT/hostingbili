<?php
include_once('../../include/conex.php');
$conn = Conectarse();

$commentId = isset($_POST['comentario_id']) ? $_POST['comentario_id'] : "";
$comment = isset($_POST['comment']) ? $_POST['comment'] : "";
$commentSenderName = isset($_POST['name']) ? $_POST['name'] : "";
$date = date('Y-m-d H:i:s');

$sql = "INSERT INTO comentario(parent_comentario_id, comment, comment_sender_name, date) VALUES ('$commentId', '$comment', '$commentSenderName', '$date')";
$result = mysqli_query($conn, $sql);

$response = array("success" => $result);
if (!$result) {
    $response["error"] = mysqli_error($conn);
}
echo json_encode($response);

mysqli_close($conn);
?>
