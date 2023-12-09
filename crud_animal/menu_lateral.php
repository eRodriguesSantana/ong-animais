<?php
session_start();

// Se o usuário não estiver logado e tentar acessar a página diretamente pela url
// o mesmo será redirecionado para a tela de login
if (!isset($_SESSION['matricula']) || empty($_SESSION['matricula'])) {
  unset($_SESSION['matricula']);
  header('Location: ../index.php');
}

$matricula = $_SESSION['matricula'];

include "../sql/conexao.php";

$sql = "SELECT nivelUsuario, nome_completo FROM pessoas WHERE matriculausuario = $matricula and status='Ativo'";
$buscar = mysqli_query($conn, $sql);
$arr = mysqli_fetch_array($buscar);
$nome_completo = $arr['nome_completo'];
$nivel = $arr['nivelUsuario']
?>

<div id="menu-lateral" class="col-12 col-md-2">
    <div class="titulos-ong">
        <a href="">ONG</a></br>
        <a href="">Animais Pirapozinho</a>
    </div>
    <div class="btn-group-vertical" role="group" aria-label="Basic example">
        <a href="../menu.php" class="btn-menu btn">Início</a>
        <a href="listar_animais.php" class="btn-menu btn">Gerenciar Animais</a>
        <a href="../crud_adocao/listar_adocao.php" class="btn-menu btn">Gerenciar Adoção</a>
        <a href="../crud_pessoas/listar_pessoas.php" class="btn-menu btn">Gerenciar Pessoas</a>
        <a href="../crud_pessoas/aprovar_pessoa.php" class="btn-menu btn">Ativar Voluntários</a>
        <a href="../crud_doacao/cadastro_doacao.php" class="btn-menu btn">Gerenciar Doação</a>
        <a href="../lancar_despesa/sub_menu_lancar_despesas.php" class="btn-menu btn">Lançar Despesas</a>
    </div>
    <div class="sair-rodape">
        <a class="btn-sair" href="#"><span><i class="bi bi-person-circle"></i></span>Nome do Usuário
            Logado: <?php echo $nome_completo; ?></a>
        <a class="btn-sair" href="../sair.php"><span><i class="bi bi-box-arrow-right"></i></span>Sair</a>
    </div>
</div>