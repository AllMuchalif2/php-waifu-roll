<nav class="navbar">
    <a href="/index.php" class="navbar-brand">
        <img src="/assets/img/logo.png" alt="MYBINI Logo" class="navbar-logo">
        <span>MYBINI</span>
    </a>
    <div class="flex gap-05">
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="index.php?url=auth/logout" class="btn mb-0 p-05 text-sm bg-555">LOGOUT</a>
        <?php elseif (!isset($hide_auth_links)): ?>
            <a href="index.php?url=auth/login" class="btn mb-0 p-05 text-sm">LOGIN</a>
        <?php endif; ?>
    </div>
</nav>
