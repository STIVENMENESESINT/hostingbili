<?php

require_once('conexao.php');

// Establecer el tipo de contenido a HTML con el charset especificado en la configuración
header('Content-Type: text/html; charset='.$charset);

// Iniciar la sesión con el nombre de sesión configurado
session_name($session_name);
session_start();

$database = new Database();
$db = $database->conectar();

if (isset($_POST['titulo']) && isset($_POST['descricao']) && isset($_POST['inicio']) && isset($_POST['termino']) && isset($_POST['cor'])) {

    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $inicio = $_POST['inicio'];
    $termino = $_POST['termino'];
    $cor = $_POST['cor'];
    $convidado = $_POST['convidado'];
    $competencia = $_POST['id_competencia'];
    $ra = $_POST['id_resultado_aprendizaje'];
    $id_programaformacion = $_POST['id_programaformacion'];

    // Asegurarse de que la variable de sesión está definida
    if (isset($_SESSION['id_userprofile'])) {
        $id_usuario = $_SESSION['id_userprofile'];

        // Convertir las fechas a formato MySQL
        $inicio = date('Y/m/d H:i:s', strtotime($inicio));
        $termino = date('Y/m/d H:i:s', strtotime($termino));

        // Preparar la consulta SQL
        $sql = "INSERT INTO eventos(fk_id_usuario, titulo, descricao, inicio, termino, cor,id_competencia,id_resultado_aprendizaje,id_programaformacion) values (?, ?, ?, ?, ?, ?,?,?,?)";
        // Preparar y ejecutar la consulta
        $query = $db->prepare($sql);
        if ($query === false) {
            print_r($db->errorInfo());
            die('Erro ao carregar');
        }

        $sth = $query->execute([$id_usuario, $titulo, $descricao, $inicio, $termino, $cor, $competencia, $ra,$id_programaformacion]);
        if ($sth === false) {
            print_r($query->errorInfo());
            die('Erro ao executar');
        }

        // Seleccionar el último evento insertado y agregar un registro en la tabla 'convites' si es necesario
        $ultimoEvento = "SELECT * FROM eventos ORDER BY id_evento DESC LIMIT 1";
        $req = $db->prepare($ultimoEvento);
        $req->execute();
        $linhas = $req->rowCount();
        if ($linhas == 1) {
            $dados = $req->fetch(PDO::FETCH_ASSOC);
            $id_evento = $dados['id_evento'];

            $sql2 = "INSERT INTO convites(fk_id_destinatario, fk_id_remetente, fk_id_evento, status) values (?, ?, ?, null)";
            $query2 = $db->prepare($sql2);
            $query2->execute([$convidado, $id_usuario, $id_evento]);
        }
    } else {
        die('Error: Variable de sesión no está definida.');
    }
}
header('Location: '.$_SERVER['HTTP_REFERER']);
?>
