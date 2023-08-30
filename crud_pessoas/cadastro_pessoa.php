<!DOCTYPE html>
<html lang="pt-BR"> 
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css" media="screen" />
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <title>ONG Sistema de Adoção Pet</title>
  </head>

  <body>
    <div id="ong" class="container-ong">
      <div class="row">
        <div id="menu-lateral" class="col-2">
          <div class="titulos-ong">
            <h4>ONG</h4>
            <h4>Animais Pirapozinho</h4>
          </div>
          <div class="btn-group-vertical" role="group" aria-label="Basic example">
            <a href="../menu.php" class="btn-menu btn" role="button">Início</a> 
            <button type="button" class="btn-menu btn">Gerenciar Pessoas</button>
            <div class="btn-group" role="group">
              <button type="button" class="btn-menu btn dropdown-toggle" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false"> Gerenciar Pets</button>
              <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                <a class="dropdown-item" href="#">Entrada Pet</a>
                <a class="dropdown-item" href="#">Saída Pet</a>
              </div>
            </div>
            <button type="button" class="btn-menu btn">Gerenciar Produtos</button>
            <button type="button" class="btn-menu btn">Gerenciar Fornecedores</button>
              <div class="btn-group" role="group">
                <button type="button" class="btn-menu btn dropdown-toggle" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false"> Financeiro</button>
                  <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <a class="dropdown-item" href="#">Registrar Despesas</a>
                    <a class="dropdown-item" href="#">Registrar Compras</a>
                    <a class="dropdown-item" href="#">Registrar Doação</a>
                  </div>
              </div>
          </div>
          <div class="sair-rodape">
            <?php
              session_start();

              // Se o usuário não estiver logado e tentar acessar a página diretamente pela url
              // o mesmo será redirecionado para a tela de login
              if(!isset($_SESSION['matricula']) || empty($_SESSION['matricula']))
              {
                unset($_SESSION['matricula']);
                header('Location: ../index.php');
              } else //(isset($_SESSION['matricula']) || !empty($_SESSION['matricula']))
              {
                $matricula = $_SESSION['matricula'];

                include "../sql/conexao.php";

                $sql = "SELECT nivelUsuario, nome_completo FROM pessoas WHERE matriculausuario = $matricula and status='Ativo'";
                $buscar = mysqli_query($conn, $sql);
                $arr = mysqli_fetch_array($buscar);
                $nome_completo = $arr['nome_completo'];
            ?>
              <a class="btn-sair" href="#"><span><i class="bi bi-person-circle"></i></span>Nome do Usuário
                Logado: <?php echo $nome_completo; ?>
              </a>
            <?php } ?>
            <a class="btn-sair" href="../sair.php"><span><i class="bi bi-box-arrow-right"></i></span>Sair</a>
          </div>
        </div> <!--Menu lateral FIM-->
        <div id="container-cadastro-pet" class="principal col">
          <h4 class="titulos-topo">Cadastrar Pessoa</h4>
          <div class="btn-grupo-principal">
            <a href="../menu.php" role="button" class="btn-grupo btn">Voltar</a>
            <a href="listar_pessoas.php" role="button" class="btn-grupo btn">Listar Pessoas</a>
          </div>

          <hr>

          <div class="cadastro-pet">
            <h5 class="titulo-cad">Cadastro de Pessoas</h5>
            <form action="inserir_pessoa.php" method="post">
              <div class="form-group">
                <label for="nomeusuario">Nome Usuário</label>
                <input 
                  type="text" 
                  name="nomeusuario" 
                  class="form-control" 
                  autocomplete="off"
                  placeholder="Nome completo do usuário"
                  aria-describedby="nomeusuario"
                  required 
                    oninvalid="this.setCustomValidity('Nome obrigatório')" 
                    oninput="setCustomValidity('')"
                  >
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input 
                  type="email" 
                  name="email" 
                  class="form-control" 
                  required
                    oninvalid="this.setCustomValidity('Email obrigatório')" 
                    oninput="setCustomValidity('')"
                  autocomplete="off"
                  aria-describedby="email"
                  placeholder="Email do usuário">
              </div>
              <div class="form-group">
                <label for="telefone">Telefone</label>
                <input 
                  onkeypress="maskphone(this, mphone);" 
                  onblur="maskphone(this, mphone);"
                  type="text" 
                  id="telefone"
                  name="telefone" 
                  class="form-control" 
                  required
                    oninvalid="this.setCustomValidity('Telefone obrigatório')" 
                    oninput="setCustomValidity('')" 
                  aria-describedby="telefone"
                  autocomplete="off"
                  placeholder="Telefone do usuário">
              </div>
              <div class="form-group">
                <label for="cpf">CPF</label>
                <input
                  id="cpf" 
                  maxlength="11"
                  type="text" 
                  name="cpf" 
                  class="form-control" 
                  required
                    oninvalid="this.setCustomValidity('CPF obrigatório')" 
                    oninput="setCustomValidity('')"
                  aria-describedby="cpf"
                  autocomplete="off"
                  placeholder="CPF do usuário">
              </div>
              <div class="form-group">
                <label for="endereco">Endereço</label>
                <input 
                  type="text" 
                  name="endereco" 
                  class="form-control" 
                  required
                    oninvalid="this.setCustomValidity('Endereço obrigatório')" 
                    oninput="setCustomValidity('')" 
                  autocomplete="off"
                  aria-describedby="endereco"
                  placeholder="Endereço do usuário">
              </div>
              <div class="form-group">
                <label>Tipo Usuário</label>
                <select 
                  id="nivelUsuario"
                  name="nivelUsuario" 
                  class="form-control"
                  onchange='habilitarCampos()'
                  required 
                    oninvalid="this.setCustomValidity('Tipo obrigatório')" 
                    oninput="setCustomValidity('')">
                  <option value="">Selecione</option>
                  <option value="Voluntario">Voluntario</option>
                  <option value="NaoVoluntario">Não Voluntário</option>
                  <option value="Adotante">Adotante</option>
                </select>
              </div>
              <div class="form-group">
                <label>Matrícula Usuário(Voluntário/Não-Voluntário)</label>
                <input
                  id="matriculausuario"
                  type="text" 
                  name="matriculausuario" 
                  class="form-control" 
                  required="required" 
                  autocomplete="off"
                  required 
                    oninvalid="this.setCustomValidity('Matrícula obrigatório')" 
                    oninput="setCustomValidity('')"
                  placeholder="Matrícula do usuário">
              </div>
              <div class="form-group">
                <label for="senha">Senha Usuário</label>
                <input 
                  id="senha"
                  type="password" 
                  name="senha" 
                  class="form-control" 
                  required="required" 
                  autocomplete="off"
                  aria-describedby="senha"
                  required 
                    oninvalid="this.setCustomValidity('Senha obrigatório')" 
                    oninput="setCustomValidity('')"
                  placeholder="Senha do usuário">
              </div>
              <div style="text-align: right">
                <button type="submit" class="btn btn-sm btn-success">Cadastrar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!--JS do Bootstrap-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>

    <script>
      function habilitarCampos() {
        if($("#nivelUsuario").val() == 'Voluntario' || $("#nivelUsuario").val() == 'NaoVoluntario') {
            $("#matriculausuario").prop('disabled', false);
            $("#senha").prop('disabled', false);
        } else {
            $("#matriculausuario").prop('disabled', true);
            $("#senha").prop('disabled', true);
        }
      }

      var cpf = document.querySelector("#cpf");

      cpf.addEventListener("blur", function(){
        if(cpf.value) cpf.value = cpf.value.match(/.{1,3}/g).join(".").replace(/\.(?=[^.]*$)/,"-");
      });

      function maskphone(o, f) {
        setTimeout(function() {
          var v = mphone(o.value);
          if (v != o.value) {
            o.value = v;
          }
        }, 1);
      }

      function mphone(v) {
        var r = v.replace(/\D/g, "");
        r = r.replace(/^0/, "");
        if (r.length > 10) {
          r = r.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
        } else if (r.length > 5) {
          r = r.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
        } else if (r.length > 2) {
          r = r.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
        } else {
          r = r.replace(/^(\d*)/, "($1");
        }
        return r;
      }
    </script>
  </body>
</html>
