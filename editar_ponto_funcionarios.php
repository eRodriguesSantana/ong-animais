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

$id = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="pt-BR"> 
  <head>
    <meta charset="utf-8">
    <title>Editar Ponto</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    
    <style>
      #tamanhoContainer{
        width: 700px;
      }
      
      .element::-webkit-input-placeholder {
        color: black;
        font-weight: bold;
      }
    </style>
    
  </head>
  
  <body>
    <div class="container" id="tamanhoContainer" style="margin-top: 40px">
      
      <h1><strong>Editar Ponto</strong></h1>
      
      <form action="atualizar_ponto_funcionarios.php" method="post" style="margin-top: 20px">
        <input type="number" name="id" value="<?php echo $id; ?>" style="display: none;">
        <?php
          include "conexao.php";
          
          $sql = "SELECT * FROM `registro` where iduser = $id";
          $buscar = mysqli_query($conn, $sql);
          while ($array = mysqli_fetch_array($buscar)){
            $iduser = $array['iduser'];
            $inicio_expediente = $array['inicio_expediente'];
            $inicio_almoco = $array['inicio_almoco'];
            $fim_almoco = $array['fim_almoco'];
            $fim_expediente = $array['fim_expediente'];
            $descricao = trim($array['descricao']);
        ?>
            <div class="form-group">
              <label for="entrada"><strong>Entrada</strong></label>
              <div class="input-group mb-3">
                <div class="input-group-append">
                  <input type="datetime-local" name="entradaExp" value="<?= str_replace(" ", "T", $inicio_expediente); ?>" disabled>
                </div>
              </div>
            </div>
          
            <div class="form-group">
              <label for="saidaAlmoco"><strong>Entrada Almoço</strong></label>
              <div class="input-group mb-3">
                <div class="input-group-append">
                  <input type="datetime-local" name="entradaAlm" value="<?= str_replace(" ", "T", $inicio_almoco); ?>" disabled>          
                </div>
              </div>
            </div>
        
            <div class="form-group">
              <label for="saidaAlmoco"><strong>Saída Almoço</strong></label>
              <div class="input-group mb-3">
                <div class="input-group-append">
                  <input type="datetime-local" name="saidaAlm" value="<?= str_replace(" ", "T", $fim_almoco); ?>" disabled>         
                </div>
              </div>
            </div>
        
            <div class="form-group">
              <label for="saidaExp"><strong>Saída</strong></label>
              <div class="input-group mb-3">
                <div class="input-group-append">
                  <input type="datetime-local" name="saidaExp" value="<?= str_replace(" ", "T", $fim_expediente); ?>" disabled>         
                </div>
              </div>
            </div>
        
            <div class="form-group">
              <label for="descricao"><strong>Descrição</strong></label>
              <div class="input-group mb-3">
                <div class="input-group-append">
                  <textarea class="element" name="descricao" rows="5" cols="33" minlength="20" 
                            maxlength="100" disabled><?php echo htmlspecialchars($descricao, ENT_QUOTES, 'UTF-8') ?>
                  </textarea>   
                </div>
              </div>
            </div>
                      
            <!--<button type="submit" class="btn btn-success">Atualizar</button>-->
            <a class="btn btn-primary" href="listar_pontos_funcionarios.php" 
              role="button"><i class="fas fa-thumbs-up"></i>Voltar
            </a>
    <?php } ?>
      </form>
    </div>
    <script type="text/javascript" src="js/bootstrap.js"></script>  
  </body>
  
</html>

