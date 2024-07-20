<?php
include_once('../../include/conex.php');
$conn = Conectarse();

$memberId = 1;
$commentId = $_POST['comentario_id'];
$likeOrUnlike = $_POST['like_unlike'] ?? 0;

$sql = "SELECT * FROM megusta_nomegusta WHERE comentario_id = $commentId AND member_id = $memberId";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

if (!empty($row)) {
    $query = "UPDATE megusta_nomegusta SET like_unlike = $likeOrUnlike WHERE comentario_id = $commentId AND member_id = $memberId";
} else {
    $query = "INSERT INTO megusta_nomegusta(member_id, comentario_id, like_unlike) VALUES ('$memberId', '$commentId', '$likeOrUnlike')";
}
mysqli_query($conn, $query);

$likeQuery = "SELECT SUM(like_unlike) AS likesCount FROM megusta_nomegusta WHERE comentario_id = $commentId";
$resultLikeQuery = mysqli_query($conn, $likeQuery);
$fetchLikes = mysqli_fetch_array($resultLikeQuery, MYSQLI_ASSOC);
$totalLikes = $fetchLikes['likesCount'] ?? 0;

echo $totalLikes;
mysqli_close($conn);
?>
