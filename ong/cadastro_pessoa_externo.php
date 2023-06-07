<!DOCTYPE html>
<html lang="pt-BR"> 
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <title>Cadastro de Usuário / Adotante</title>
    <link rel="stylesheet" href="css/bootstrap.css">
  </head>

  <body>
    <div class="container" style="width: 400px; margin-top: 40px">
      
      <div style="text-align: right">
        <a href="menu.php" role="button" class="btn btn-success btn-sm" style="margin-left: 25px">Voltar</a>
      </div>
      
      <br>
      
      <h4><strong>Cadastrar Usuário / Adotante</strong></h4>
      
      <form action="inserir_pessoa_externo.php" method="post">
        <div class="form-group">
          <label for="nomeusuario">Nome Usuário</label>
          <input type="text" name="nomeusuario" class="form-control" required="required" 
                 autocomplete="off"
                 placeholder="Nome completo do usuário">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" class="form-control" required="required" 
                 autocomplete="off"
                 placeholder="Email do usuário">
        </div>
        <div class="form-group">
          <label for="telefone">Telefone</label>
          <input type="text" name="telefone" class="form-control" required="required" 
                 autocomplete="off"
                 placeholder="Telefone do usuário">
        </div>
        <div class="form-group">
          <label for="cpf">CPF</label>
          <input type="text" name="cpf" class="form-control" required="required" 
                 autocomplete="off"
                 placeholder="CPF do usuário">
        </div>
        <div class="form-group">
          <label for="endereco">Endereço</label>
          <input type="text" name="endereco" class="form-control" required="required" 
                 autocomplete="off"
                 placeholder="Endereço do usuário">
        </div>
        <div class="form-group">
          <label>Tipo Usuário</label>
          <select name="nivelUsuario" class="form-control">
            <option value="Voluntario">Voluntario</option>
            <option value="NaoVoluntario">Não Voluntário</option>
            <option value="Adotante">Adotante</option>
          </select>
        </div>
        <div class="form-group">
          <label>Matrícula Usuário(Voluntário/Não-Voluntário)</label>
          <input type="text" name="matriculausuario" class="form-control" required="required" 
                autocomplete="off"
                placeholder="Matrícula do usuário">
        </div>
        <div style="text-align: right">
          <button type="submit" class="btn btn-sm btn-success">Cadastrar</button>
        </div>
      </form>
    </div>
    <script type="text/javascript" src="js/bootstrap.js"></script>
  </body>
</html>
