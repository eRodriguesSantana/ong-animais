<?php
session_start();

// Se o usuário não estiver logado e tentar acessar a página diretamente pela url
// o mesmo será redirecionado para a tela de login
if(!isset($_SESSION['matricula']) || empty($_SESSION['matricula']))
{
  unset($_SESSION['matricula']);
  header('Location: index.php');
  exit;
}

$matricula = $_SESSION['matricula'];
?> 

<!DOCTYPE html>
<html lang="pt-BR"> 
  <head>
    <meta charset="utf-8">
    <title>Registro de Ponto</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <style>
      #tamanhoContainer{
        width: 500px;
      }
      h1{
        font-size: 27px;
      }
    </style>
    
  </head>
  
  <body>
    <div class="container" id="tamanhoContainer" style="margin-top: 40px">      
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <h1>Registrar Ponto</h1>        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-item nav-link active" href="listar_pontos.php" role="button" class="btn btn-success">Listar Marcações</a>
            <a class="nav-item nav-link active" href="menu.php" role="button" class="btn btn-primary">Voltar</a>
            <a class="nav-item nav-link active" href="sair.php" role="button" class="btn btn-danger">Sair</a>
          </div>
        </div>
      </nav>
      
      <form action="inserir_ponto.php" method="post" style="margin-top: 20px" id="form-dados-pessoais"> 
        <input type="hidden" value="<?php echo $_SESSION['matricula']; ?>" name="<?php echo session_id()?>['matricula']" />
        <div class="form-group">
          <label for="entrada"><strong>Entrada</strong></label>
          <div class="input-group mb-3">
            <input id="entrada" class="form-control" type="text" name="entradaExp" readonly>
            <div class="input-group-append">
              <button id="button" type="submit" class="btn btn-primary" name="btnAcao" value="entradaExpediente"
                      onclick="habilitarCampoAbaixo('iniciarAlmoco', 'entrada', 'button')">
                  Entrada Expediente
              </button>
            </div>
          </div>
        </div>

        <div id="iniciarAlmoco" class="form-group" style="display: none">
          <label for="saidaAlmoco"><strong>Entrada Almoço</strong></label>
          <div class="input-group mb-3">
            <input id="entAlmoco" class="form-control" type="text" name="entradaAlm" readonly>
            <div class="input-group-append">
              <!--<div id="iniciarAlmoco" class="form-group" style="display: none">-->
                <button id="btnEntAlmoco" type="submit" class="btn btn-primary" name="btnAcao" value="entradaAlmoco"
                        onclick="habilitarCampoAbaixo('saidaAlmoco', 'entAlmoco', 'btnEntAlmoco')">
                    Entrada Almoço
                </button>
              <!--</div>-->
            </div>
          </div>
        </div>
        
        <div id="saidaAlmoco" class="form-group" style="display: none">
          <label for="saidaAlmoco"><strong>Saída Almoço</strong></label>
          <div class="input-group mb-3">
            <input id="saiAlmoco" class="form-control" type="text" name="saidaAlm" readonly>
            <div class="input-group-append">
              <button id="btnSaiAlmoco" type="submit" class="btn btn-primary" name="btnAcao" value="saidaAlmoco"
                      onclick="habilitarCampoAbaixo('saidaExp', 'saiAlmoco', 'btnSaiAlmoco')">
                  Saída Almoço
              </button>
            </div>
          </div>
        </div>
   
        <div id="saidaExp" class="form-group" style="display: none">
          <label for="saidaExp"><strong>Saída<strong></label>
          <div class="input-group mb-3">
            <input id="saida" class="form-control" type="text" name="saidaExp" readonly>
            <div class="input-group-append">
              <button id="btnSaida" type="submit" class="btn btn-primary" name="btnAcao" value="saidaExpediente"
                      onclick="habilitarCampoAbaixo('descricao', 'saida', 'btnSaida')">
                  Saída
              </button>
            </div>
          </div>
        </div>
        
        <div id="descricao" class="form-group" style="display: none">
          <label for="descricao">Descrição: </label>
          <div class="input-group mb-3">
            <textarea id="descricao" class="form-control" name="descricao" rows="5" cols="33" minlength="20" maxlength="100" required></textarea>
            <div class="input-group-append">
              <button id="btnDescricao" type="submit" class="btn btn-primary" name="btnAcao" value="descricao"
                      onclick="habilitarCampoAbaixo('descricao', 'saida')">
                  Descrição
              </button>
          </div>
        </div>
      </form>      
    </div>    
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="./js/moment.js"></script>
    <script type="text/javascript">
      
      function habilitarCampoAbaixo(elAbaixo, elData, elButton) {
        const inputDate = document.getElementById(elData);
        inputDate.value = dataHora(elData);
        
        if(inputDate){
          document.getElementById(elAbaixo).style.display = "block";
          document.getElementById(elButton).disabled = true;
          dataHora(elData);
        }
      }
      
      function dataHora(input){
        // Obtém a data/hora atual
        var data = new Date();

        // Guarda cada pedaço em uma variável
        var dia     = data.getDate();           // 1-31
        var dia_sem = data.getDay();            // 0-6 (zero=domingo)
        var mes     = data.getMonth();          // 0-11 (zero=janeiro)
        var ano2    = data.getYear();           // 2 dígitos
        var ano4    = data.getFullYear();       // 4 dígitos
        var hora    = data.getHours();          // 0-23
        var min     = data.getMinutes();        // 0-59
        var seg     = data.getSeconds();        // 0-59
        var mseg    = data.getMilliseconds();   // 0-999
        var tz      = data.getTimezoneOffset(); // em minutos
        
        if(seg < 10)
           seg = "0"+seg;
       
        // Formata a data e a hora (note o mês + 1)
        var str_data = ("0" + dia).slice(-2) + '/' + (("0" + (mes + 1)).slice(-2)) + '/' + ano4;
        var str_hora = ("0" + hora).slice(-2) + ':' + ("0" + min).slice(-2) + ':' + seg;

        // Mostra o resultado
        const dateFormat = document.getElementById(input);
        
        return dateFormat.value = str_data + " " + str_hora;
      }
    </script>
  </body>
</html>