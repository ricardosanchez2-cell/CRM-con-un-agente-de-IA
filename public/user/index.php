<?php
/**
 * Página de Login/Logout
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión - CRM</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    body {
      font-family: 'Nunito', sans-serif;
      background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }
    .login-card {
      background: white;
      border-radius: 16px;
      padding: 40px;
      width: 100%;
      max-width: 400px;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
    .login-logo {
      text-align: center;
      margin-bottom: 32px;
    }
    .login-logo .icon {
      width: 80px;
      height: 80px;
      background: linear-gradient(135deg, #2563eb, #1d4ed8);
      border-radius: 20px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 16px;
    }
    .login-logo .icon i {
      font-size: 36px;
      color: white;
    }
    .login-logo h1 {
      font-size: 24px;
      color: #1e293b;
      margin-bottom: 4px;
    }
    .login-logo p {
      color: #64748b;
      font-size: 14px;
    }
    .form-group {
      margin-bottom: 20px;
    }
    .form-group label {
      display: block;
      font-weight: 600;
      color: #334155;
      margin-bottom: 8px;
      font-size: 14px;
    }
    .form-group input {
      width: 100%;
      padding: 12px 16px;
      border: 2px solid #e2e8f0;
      border-radius: 10px;
      font-size: 15px;
      font-family: inherit;
      transition: border-color 0.2s ease;
    }
    .form-group input:focus {
      outline: none;
      border-color: #2563eb;
    }
    .btn-login {
      width: 100%;
      padding: 14px;
      background: linear-gradient(135deg, #2563eb, #1d4ed8);
      color: white;
      border: none;
      border-radius: 10px;
      font-size: 16px;
      font-weight: 700;
      cursor: pointer;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .btn-login:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 20px rgba(37, 99, 235, 0.3);
    }
    .login-footer {
      text-align: center;
      margin-top: 24px;
      color: #64748b;
      font-size: 13px;
    }
    .login-footer a {
      color: #2563eb;
      text-decoration: none;
      font-weight: 600;
    }
  </style>
</head>
<body>
  <div class="login-card">
    <div class="login-logo">
      <div class="icon">
        <i class="fas fa-chart-line"></i>
      </div>
      <h1>CRM Dashboard</h1>
      <p>Inicia sesión para continuar</p>
    </div>
    
    <form action="../index.php" method="get">
      <div class="form-group">
        <label>Correo electrónico</label>
        <input type="email" name="email" placeholder="tu@email.com" required>
      </div>
      <div class="form-group">
        <label>Contraseña</label>
        <input type="password" name="password" placeholder="••••••••" required>
      </div>
      <button type="submit" class="btn-login">
        Iniciar Sesión
      </button>
    </form>
    
    <div class="login-footer">
      ¿Olvidaste tu contraseña? <a href="#">Recuperar</a>
    </div>
  </div>
</body>
</html>
