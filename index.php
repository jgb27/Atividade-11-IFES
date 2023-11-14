<?php
include_once 'includes/header.php';
?>

<div class="d-flex justify-content-center align-items-center" style="height: 90vh;">
  <div class="col-md-4">
    <div class="login-box">
      <h2 class="text-center">Login</h2>
      <form method="post" action="./controles/processar_login.php">
        <div class="mb-3">
          <label for="username" class="form-label">Usuário</label>
          <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Senha</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Entrar</button>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<?php
include_once 'includes/footer.php';
?>
