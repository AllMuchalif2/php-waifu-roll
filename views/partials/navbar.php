<!-- Simple Top Header -->
<header class="py-8 px-4 text-center">
    <a href="index.php" class="no-underline text-gray-900 font-extrabold text-2xl inline-flex items-center justify-center gap-2">
        <img src="/assets/img/logo.png" alt="MYBINI Logo" class="h-8">
        <span>MYBINI</span>
    </a>
</header>

<!-- Floating Bottom Navigation -->
<nav class="fixed bottom-5 left-1/2 -translate-x-1/2 w-[calc(100%-40px)] max-w-[440px] h-[70px] bg-gray-900 rounded-[24px] flex justify-around items-center z-[1000] shadow-2xl">
    <a href="index.php" class="flex flex-col items-center text-[0.7rem] font-medium transition-opacity <?php echo !isset($_GET['url']) || $_GET['url'] == 'home/index' ? 'text-yellow-400 opacity-100' : 'text-white opacity-70 hover:opacity-100'; ?>">
        <i class="fa-solid fa-house text-xl mb-1"></i>
        <span>Home</span>
    </a>
    <a href="index.php?url=gacha/roll" class="flex flex-col items-center text-[0.7rem] font-medium transition-opacity <?php echo isset($_GET['url']) && $_GET['url'] == 'gacha/roll' ? 'text-yellow-400 opacity-100' : 'text-white opacity-70 hover:opacity-100'; ?>">
        <i class="fa-solid fa-dice text-xl mb-1"></i>
        <span>Roll</span>
    </a>
    <a href="index.php?url=home/pool" class="flex flex-col items-center text-[0.7rem] font-medium transition-opacity <?php echo isset($_GET['url']) && $_GET['url'] == 'home/pool' ? 'text-yellow-400 opacity-100' : 'text-white opacity-70 hover:opacity-100'; ?>">
        <i class="fa-solid fa-list text-xl mb-1"></i>
        <span>Pool</span>
    </a>
    <a href="index.php?url=gacha/index" class="flex flex-col items-center text-[0.7rem] font-medium transition-opacity <?php echo isset($_GET['url']) && ($_GET['url'] == 'gacha/index' || $_GET['url'] == 'player/dashboard') ? 'text-yellow-400 opacity-100' : 'text-white opacity-70 hover:opacity-100'; ?>">
        <i class="fa-solid fa-heart text-xl mb-1"></i>
        <span>Collection</span>
    </a>
    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="index.php?url=auth/logout" class="flex flex-col items-center text-[0.7rem] font-medium text-white opacity-70 hover:opacity-100 transition-opacity">
            <i class="fa-solid fa-right-from-bracket text-xl mb-1"></i>
            <span>Logout</span>
        </a>
    <?php else: ?>
        <a href="index.php?url=auth/login" class="flex flex-col items-center text-[0.7rem] font-medium transition-opacity <?php echo isset($_GET['url']) && $_GET['url'] == 'auth/login' ? 'text-yellow-400 opacity-100' : 'text-white opacity-70 hover:opacity-100'; ?>">
            <i class="fa-solid fa-user text-xl mb-1"></i>
            <span>Login</span>
        </a>
    <?php endif; ?>
</nav>
