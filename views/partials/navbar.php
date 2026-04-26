<!-- Simple Top Header -->
<header style="padding: 2rem 1rem 1rem 1rem; text-align: center;">
    <a href="/index.php" style="text-decoration: none; color: var(--text-dark); font-weight: 800; font-size: 1.5rem; display: flex; align-items: center; justify-content: center; gap: 10px;">
        <img src="/assets/img/logo.png" alt="MYBINI Logo" style="height: 32px;">
        <span>MYBINI</span>
    </a>
</header>

<!-- Floating Bottom Navigation -->
<nav class="bottom-nav">
    <a href="index.php" class="nav-item <?php echo !isset($_GET['url']) || $_GET['url'] == 'home/index' ? 'active' : ''; ?>">
        <i class="fa-solid fa-house"></i>
        <span>Home</span>
    </a>
    <a href="index.php?url=gacha/roll" class="nav-item <?php echo isset($_GET['url']) && $_GET['url'] == 'gacha/roll' ? 'active' : ''; ?>">
        <i class="fa-solid fa-dice"></i>
        <span>Roll</span>
    </a>
    <a href="index.php?url=gacha/index" class="nav-item <?php echo isset($_GET['url']) && ($_GET['url'] == 'gacha/index' || $_GET['url'] == 'player/dashboard') ? 'active' : ''; ?>">
        <i class="fa-solid fa-heart"></i>
        <span>Collection</span>
    </a>
    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="index.php?url=auth/logout" class="nav-item">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span>Logout</span>
        </a>
    <?php else: ?>
        <a href="index.php?url=auth/login" class="nav-item <?php echo isset($_GET['url']) && $_GET['url'] == 'auth/login' ? 'active' : ''; ?>">
            <i class="fa-solid fa-user"></i>
            <span>Login</span>
        </a>
    <?php endif; ?>
</nav>
