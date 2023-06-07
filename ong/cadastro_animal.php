<?php
session_start();

// Se o usuário não estiver logado e tentar acessar a página diretamente pela url
// o mesmo será redirecionado para a tela de login
if(!isset($_SESSION['matricula']) || empty($_SESSION['matricula']))
{
  unset($_SESSION['matricula']);
  header('Location: index.php');
}

$matricula = $_SESSION['matricula'];
?>

<!DOCTYPE html>
<html lang="pt-BR"> 
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <title>Cadastro de Animal Abandonado</title>
    <link rel="stylesheet" href="css/bootstrap.css">
  </head>

  <body>
    <div class="container" style="width: 400px; margin-top: 40px">
      
      <div style="text-align: right">
        <a href="menu.php" role="button" class="btn btn-success btn-sm" style="margin-left: 25px">Voltar</a>
      </div>
      
      <br>
      
      <h4><strong>Cadastro de Animal Abandonado</strong></h4>
      
      <form action="inserir_animal_externo.php" method="post">
        <div class="form-group">
          <label for="nome_animal">Nome Animal</label>
          <input type="text" name="nome_animal" class="form-control" required="required" 
                 autocomplete="off"
                 placeholder="Nome Animal">
        </div>
        <div class="form-group">
          <label for="peso_aproximado">Peso Aproximado</label>
          <input type="number" name="peso_aproximado" class="form-control" required="required" 
                 autocomplete="off"
                 placeholder="Peso Aproximado">
        </div>
        <div class="form-group">
            <label for="observacao">Observação</label>
            <textarea name="observacao" rows="4" cols="50" class="form-control"></textarea>
        </div>
        <div class="form-group">
          <label for="data_entrada">Data Entrada (informação do sistema)</label>
          <input type="text" name="data_entrada" value="<?php echo date('d/m/Y H:i:s'); ?>" class="form-control" required="required" 
                 autocomplete="off"
                 readonly 
                 placeholder="<?php echo date('d/m/Y H:i:s'); ?>">
        </div>
        <div class="form-group">
          <label for="imagem">Imagem</label>
          <input type="text" name="imagem" class="form-control" 
                 autocomplete="off"
                 placeholder="Imagem do animal">
        </div>
        <div style="text-align: right">
          <button type="submit" class="btn btn-sm btn-success">Cadastrar</button>
        </div>
      </form>
    </div>
    <script type="text/javascript" src="js/bootstrap.js"></script>
  </body>
</html>
