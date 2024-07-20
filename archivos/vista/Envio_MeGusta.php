<?php
include_once('../../include/conex.php');
$conn = Conectarse();

$commentId = $_POST['comentario_id'];
$likeQuery = "SELECT SUM(like_unlike) AS likesCount FROM megusta_nomegusta WHERE comentario_id = $commentId";
$resultLikeQuery = mysqli_query($conn, $likeQuery);
$fetchLikes = mysqli_fetch_array($resultLikeQuery, MYSQLI_ASSOC);
$totalLikes = $fetchLikes['likesCount'] ?? 0;

echo $totalLikes;
mysqli_close($conn);
?>
