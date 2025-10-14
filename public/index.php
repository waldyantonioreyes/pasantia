<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="../assests/css/loginR.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
   <!-- 🔔 SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<body>
  

  <div class="container">
    <div class="left-side">
      <img src="../assests/img/imglogin.jpg" alt="Imagen login">
    </div>
    <div class="right-side">
      <div class="card">
        <i class='fas fa-user-alt'
            style='font-size:48px;color:rgb(1, 1, 1); display: block; text-align: center; margin-bottom: 20px;'></i>
        <h1>LOGIN</h1>

        <form action="../controllers/login.php" method="post">
            <div class="input-group">
                <label for="usuario">usuario</label>
                <input type="text" name="usuario" id="usuario"
                    required><!-- required hace que sea un requisito completar el campo-->
                <br>
                <label for="contrasena">contrasena</label>
                <input type="password" name="contrasena" id="contrasena"
                    required><!-- required hace que sea un requisito completar el campo-->
                <br>

         
                <!-- Mostrar mensaje de error o éxito --> 
                 <script>
                      <?php
                          if (isset($_SESSION['error'])) {
                          echo "
                          Swal.fire({
                              icon: 'error',
                              title: 'Oops...',
                              text: '" . $_SESSION['error'] . "',
                              confirmButtonText: 'Intentar de nuevo',
                              confirmButtonColor: '#d33'
                          });
                          ";
                          unset($_SESSION['error']);
                      }

                      if (isset($_SESSION['success'])) {
                          echo "
                          Swal.fire({
                              icon: 'success',
                              title: '¡Éxito!',
                              text: '" . $_SESSION['success'] . "',
                              confirmButtonColor: '#3085d6'
                          });
                          ";
                          unset($_SESSION['success']);
                      }
                  ?>
              </script>
                <!-- esto es para que sea verticalmente centrado -->
                <input type="submit" value="iniciar"> <!-- esto es para crear el botton -->
            </div>
            <br>
          </form>
    </div>
    </div>
  </div>
</body>
</html>
