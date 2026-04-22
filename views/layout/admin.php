<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MYBINI PANEL - Admin Panel</title>
    <link rel="icon" href="/assets/img/logo.png" type="image/png">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <div class="admin-layout">
        <aside class="sidebar">
            <div class="sidebar-brand" style="display: flex; align-items: center; gap: 10px; justify-content: center;">
                <!-- <img src="/assets/img/logo.png" style="height: 30px;"> -->
                MYBINI PANEL
            </div>
            <ul class="sidebar-nav">
                <li><a href="index.php?url=admin/index"><i class="fa-solid fa-house"></i> DASHBOARD</a></li>
                <li><a href="index.php?url=admin/waifus"><i class="fa-solid fa-heart"></i> KELOLA WAIFU</a></li>
                <li><a href="index.php?url=auth/logout" style="background: var(--accent2);"><i
                            class="fa-solid fa-right-from-bracket"></i> LOGOUT</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <?php echo $content; ?>
        </main>
    </div>
</body>

</html>