<!DOCTYPE html>
<html lang="pt-BR"> 
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acesso a SOS Pirapozinho</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <style type="text/css">
      #tamanho{
        width: 350px;
      }
    </style>
  </head>

  <body>
    <div class="container" id="tamanho" style="margin-top: 100px; border-radius: 20px; border: 2px solid #f3f3f3">
      <div style="padding: 15px">
        <center>
          <img src="img/logo_tela_login.jpg" width="100px" height="100px">
        </center>
        <form action="login.php" method="post">
          <div class="form-group">
            <label>Matricula</label>
            <input type="number" name="matricula" class="form-control" 
                   placeholder="Informe sua matrícula"
                   autocomplete="off"
                   required="required">
          </div>

          <div class="form-group">
            <label>Senha</label>
            <input type="password" name="senha" class="form-control" 
                   placeholder="Informe sua senha"
                   autocomplete="off"
                   required="required">
          </div>
        
          <div style="text-align: right">
            <button type="submit" class="btn btn-sm btn-success">Entrar</button>
          </div>
        </form>
      </div>
    </div>
  <center>
      <div style="margin-top: 10px">
        <p>Você não possui cadastro? Clique <a href="crud_pessoas/cadastro_pessoa_externo.php">aqui</a></p>
      </div>
  </center>
    <script type="text/javascript" src="js/bootstrap.js"></script>
  </body>
</html>
