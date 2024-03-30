<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR"> 
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acesso a SOS Pirapozinho</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <style type="text/css">
      #tamanho{
        width: 350px;
      }
    </style>
  </head>

  <body>
    <div id="login" class="container-login">
      <div class="row">
        <div class="fundo-img col-lg-6 col-12"></div>
        <div class="col-lg-6 col-12 col-form">
          <h3 class="titulos-ong">Login</h3>
            <form class="form-login" action="login.php" method="post">
              <div class="form-group">
                <!-- <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                      placeholder="Digite sua matrícula *"> -->
                <input type="" name="matricula" class="form-control" 
                   placeholder="Informe sua matrícula"
                   autocomplete="off"
                   required="required">
                <!--<small id="emailHelp" class="form-text text-muted">Nunca vamos compartilhar seu email, com ninguém.</small>-->
              </div>
              <div class="form-group">
                <!-- <input type="password" class="form-control" id="exampleInputPassword1"
                      placeholder="Digite sua senha *"> -->
                <input type="password" name="senha" class="form-control" 
                    placeholder="Informe sua senha"
                    autocomplete="off"
                    required="required">
              </div>
              <?php
              if(isset($_SESSION['message_login'])){
                $_SESSION['message_login'] = false;
                echo '<div class="message">
                <p>Matrícula e/ou senha incorretas!</p>
                </div>';
              };
              ?>
              <div class="grupo-btn-login">
                <!-- <button type="submit" class="btn btn-login">Login</button> -->
                <button type="submit" class="btn btn-login btn-sm btn-success">Entrar</button>
              </div>                    
            </form> 
            <div class="form-group grupo-btn-login">
              Não tem cadastro? <a href="http://sospirapo.br/crud_pessoas/cadastro_pessoa_externo.html" target="_blank">
                Clique aqui</a>
            </div>
        </div>        
      </div>      
    </div>
    <script type="text/javascript" src="js/bootstrap.js"></script>
  </body>
</html>