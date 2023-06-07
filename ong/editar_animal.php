<?php
session_start();

// Se o usu�rio n�o estiver logado e tentar acessar a p�gina diretamente pela url
// o mesmo ser� redirecionado para a tela de login
if(!isset($_SESSION['matricula']) || empty($_SESSION['matricula']))
{
  unset($_SESSION['matricula']);
  header('Location: index.php');
}

$matricula = $_SESSION['matricula'];

$id_animal = $_GET['id_animal'];
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
      
      <h1><strong>Editar Animal</strong></h1>
      
      <form action="atualizar_ponto.php" method="post" style="margin-top: 20px">
        <input type="number" name="id_animal" value="<?php echo $id_animal; ?>" style="display: none;">
        <?php
            include "conexao.php";
          
            $sql = "SELECT * 
                   FROM animal 
                   WHERE id_animal = $id_animal";
            $busca = mysqli_query($conn, $sql);

            while ($array = mysqli_fetch_array($busca)){
                $id_animal = $array['id_animal'];
                $nome_animal = $array['nome_animal'];
                $peso_aproximado = $array['peso_aproximado'];
                $observacao = $array['observacao'];
                $data_entrada = $array['data_entrada'];
                $imagem = $array['image'];
               
        ?>
            <div class="form-group">
              <label for="id_animal"><strong>ID Animal</strong></label>
              <div class="input-group mb-3">
                <div class="input-group-append">
                  <input type="text" name="id_animal" value="<?php echo $id_animal; ?>" disabled>
                </div>
              </div>
            </div>
          
            <div class="form-group">
              <label for="nome_animal"><strong>Nome Animal</strong></label>
              <div class="input-group mb-3">
                <div class="input-group-append">
                  <input type="text" name="nome_animal" value="<?php echo $nome_animal; ?>" disabled>          
                </div>
              </div>
            </div>
        
            <div class="form-group">
              <label for="pesoAproximado"><strong>Peso Aproximado</strong></label>
              <div class="input-group mb-3">
                <div class="input-group-append">
                  <input type="text" name="pesoAproximado" value="<?php echo $peso_aproximado; ?>" disabled>         
                </div>
              </div>
            </div>
        
            <div class="form-group">
              <label for="dataEntrada"><strong>Data Entrada Animal</strong></label>
              <div class="input-group mb-3">
                <div class="input-group-append">
                <input type="text" name="dataEntrada" value="<?php echo htmlspecialchars($data_entrada, ENT_QUOTES, 'UTF-8') ?>"
                  disabled>   
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="observacao"><strong>Observação</strong></label>
              <div class="input-group mb-3">
                <div class="input-group-append">
                <textarea class="element" name="observacao" rows="5" cols="33" minlength="20" 
                            maxlength="100" disabled><?php echo htmlspecialchars($observacao, ENT_QUOTES, 'UTF-8') ?>
                  </textarea>            
                </div>
              </div>
            </div>
      
            <!--<button type="submit" class="btn btn-success">Atualizar</button>-->
            <a class="btn btn-primary" href="listar_pontos.php" 
              role="button"><i class="fas fa-thumbs-up"></i>Voltar
            </a>
    <?php } ?>
      </form>
    </div>
    <script type="text/javascript" src="js/bootstrap.js"></script>  
  </body>
  
</html>

