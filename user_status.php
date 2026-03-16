<?php
session_start();
?>

<div class="user-status">
    <?php
    if (isset($_SESSION['user_nome'])) {
        // Usuário logado: mostra ícone + nome
        echo '<span class="material-icons">account_circle</span> ' . htmlspecialchars($_SESSION['user_nome']);
    } else {
        // Usuário não logado: link para login
        echo '<a href="login.html">Login</a>';
    }
    ?>
</div>

<style>
.user-status {
    position: fixed;
    top: 20px;
    right: 20px;
    color: #fff;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 6px;
    z-index: 2000;
}

.user-status a {
    color: #ff7b00; /* accent solid */
    text-decoration: none;
}

.user-status a:hover {
    text-decoration: underline;
}

.user-status .material-icons {
    font-size: 24px;
    vertical-align: middle;
}
</style>
