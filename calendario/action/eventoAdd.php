<?php
require_once('conexao.php');

header('Content-Type: text/html; charset=' . $charset);
session_name($session_name);
session_start();

$database = new Database();
$db = $database->conectar();

if (isset($_POST['titulo']) && isset($_POST['descricao']) && isset($_POST['inicio']) && isset($_POST['termino']) && isset($_POST['cor']) && isset($_POST['id_competencia']) && isset($_POST['id_resultado_aprendizaje']) && isset($_POST['convidado'])) {

    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $inicio = $_POST['inicio'];
    $termino = $_POST['termino'];
    $cor = $_POST['cor'];
    $convidado = $_POST['convidado'];
    $competencia = $_POST['id_competencia'];
    $ra = $_POST['id_resultado_aprendizaje'];

    if (isset($_SESSION['id_userprofile'])) {
        $id_usuario = $_SESSION['id_userprofile'];

        $inicio = date('Y-m-d H:i:s', strtotime($inicio));
        $termino = date('Y-m-d H:i:s', strtotime($termino));

        $sql = "INSERT INTO eventos(fk_id_usuario, titulo, descricao, inicio, termino, cor, id_competencia, id_resultado_aprendizaje) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $query = $db->prepare($sql);
        if ($query === false) {
            print_r($db->errorInfo());
            die('Error al preparar la consulta.');
        }

        $sth = $query->execute([$id_usuario, $titulo, $descricao, $inicio, $termino, $cor, $competencia, $ra]);
        if ($sth === false) {
            print_r($query->errorInfo());
            die('Error al ejecutar la consulta.');
        }

        $ultimoEvento = "SELECT * FROM eventos ORDER BY id_evento DESC LIMIT 1";
        $req = $db->prepare($ultimoEvento);
        $req->execute();
        $linhas = $req->rowCount();
        if ($linhas == 1) {
            $dados = $req->fetch(PDO::FETCH_ASSOC);
            $id_evento = $dados['id_evento'];

            $sql2 = "INSERT INTO convites(fk_id_destinatario, fk_id_remetente, fk_id_evento, status) VALUES (?, ?, ?, null)";
            $query2 = $db->prepare($sql2);
            if ($query2 === false) {
                print_r($db->errorInfo());
                die('Error al preparar la consulta para convites.');
            }
            $query2->execute([$convidado, $id_usuario, $id_evento]);
            if ($query2 === false) {
                print_r($query2->errorInfo());
                die('Error al ejecutar la consulta para convites.');
            }
        }
    } else {
        die('Error: Variable de sesión no está definida.');
    }
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
