<?php
// ---------------------------------------------------------
// 🧠 Inicia a sessão — usada para guardar quem está logado
// ---------------------------------------------------------
session_start();

// Verifica se o usuário está logado (nome armazenado na sessão)
$usuario_logado = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : null;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>ConsoleHub - Bem-vindo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Fontes -->
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- CSS (mantidos todos) -->
  <link rel="stylesheet" href="css/base.css">
  <link rel="stylesheet" href="css/header_footer.css">
  <link rel="stylesheet" href="css/estetica.css">
  <link rel="stylesheet" href="css/intro.css">
  <link rel="stylesheet" href="css/botao_login.css">

  <!-- 💡 Pequeno estilo adicional apenas para o nome do usuário -->
  <style>
    .user-info {
      position: absolute;
      top: 25px;
      right: 120px;
      color: #fff;
      font-weight: 500;
      font-family: 'Poppins', sans-serif;
    }
    .user-info span {
      color: #ff7b00;
      font-weight: 600;
    }
  </style>
</head>
<body>

  <div class="background-gif"></div>

  <!-- 📋 Menu lateral -->
  <input type="checkbox" id="sidebarToggle" class="sidebar-checkbox">
  <label for="sidebarToggle" class="sidebar-toggle">
    <span class="material-icons">menu</span>
  </label>

  <div class="sidebar">
    <a href="site_principal.php">🏠 Início</a>
    <a href="vitrine.html">🛍️ Vitrine</a>
    <a href="sobre.html">📘 Sobre</a>
    <a href="cadastro.html">📞 Cadastro</a>
    <a href="produtos.html">🎮 Produtos</a>
  </div>

  <!-- 🧱 Cabeçalho -->
  <header>
    <div class="header-content">
      <img src="imagens/fundo.jpg" alt="Logo ConsoleHub">
      <div class="header-text">
        <h1 class="orbitron-title">ConsoleHub</h1>
        <p>Conectando gerações através dos games</p>
      </div>
    </div>

    <?php if ($usuario_logado): ?>
      <!-- ✅ Exibe quando o usuário está logado -->
      <div class="user-info">
        <i class="material-icons" style="vertical-align: middle;">person</i>
        <span><?= htmlspecialchars($usuario_logado) ?></span>
      </div>
      <a href="logout.php" class="login-btn" style="background-color:#ff4500;">Sair</a>
    <?php else: ?>
      <!-- 🔒 Exibe quando ninguém está logado -->
      <a href="login.html" class="login-btn">Login</a>
    <?php endif; ?>
  </header>

  <!-- 🕹️ Conteúdo principal (sem alterações) -->
  <main>
    <section class="intro">
      <h2>Bem-vindo à ConsoleHub</h2>
      <p>
        Fundada por apaixonados por videogames, a ConsoleHub nasceu com uma missão simples: conectar gerações através dos consoles e jogos que marcaram época — e os que ainda vão marcar. Desde os clássicos como Super Nintendo e Mega Drive, até os lançamentos mais modernos como PlayStation 5 e Xbox Series X, somos o ponto de encontro definitivo para quem vive e respira games.
      </p>
      <p>
        Mais do que uma loja, somos um portal para a nostalgia e a inovação. Trabalhamos com produtos originais, digitais e físicos, oferecendo desde relíquias retrô até os últimos lançamentos em tecnologia de entretenimento.
      </p>
    </section>

    <section class="valores">
      <div class="valor-box">
        <span class="material-icons">history</span>
        <h3>Consoles Clássicos</h3>
        <p>Reviva os grandes momentos com os consoles que marcaram gerações.</p>
      </div>
      <div class="valor-box">
        <span class="material-icons">new_releases</span>
        <h3>Tecnologia Atual</h3>
        <p>Explore os lançamentos mais modernos com desempenho de ponta.</p>
      </div>
      <div class="valor-box">
        <span class="material-icons">groups</span>
        <h3>Comunidade Gamer</h3>
        <p>Junte-se a milhares de jogadores que compartilham a mesma paixão.</p>
      </div>
    </section>

    <section class="avaliacoes">
      <h2>O que dizem nossos clientes</h2>
      <div class="avaliacao">
        <p>“Comprei um Nintendo 64 e chegou impecável! Atendimento excelente.”</p>
        <span class="estrelas">★★★★★</span>
        <small>– João M.</small>
      </div>
      <div class="avaliacao">
        <p>“A ConsoleHub tem tudo! Achei até um Dreamcast em ótimo estado.”</p>
        <span class="estrelas">★★★★★</span>
        <small>– Carla T.</small>
      </div>
      <div class="avaliacao">
        <p>“Entrega rápida e produto original. Recomendo demais!”</p>
        <span class="estrelas">★★★★☆</span>
        <small>– Lucas R.</small>
      </div>
    </section>
  </main>

  <!-- 🧩 Rodapé -->
  <footer>
    <p>&copy; 2025 ConsoleHub - Todos os direitos reservados (marca fictícia)</p>
  </footer>

  <!-- 🎞️ Banner rotativo -->
  <script>
    const slides = document.querySelectorAll('.promo-slide');
    let current = 0;

    setInterval(() => {
      if (slides.length === 0) return;
      slides[current].classList.remove('active');
      current = (current + 1) % slides.length;
      slides[current].classList.add('active');
    }, 4000);
  </script>

</body>
</html>
