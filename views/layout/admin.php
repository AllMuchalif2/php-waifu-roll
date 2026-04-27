<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MYBINI PANEL - Admin Panel</title>
    <link rel="icon" href="/assets/img/logo.png" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @media (max-width: 767px) {
            .sidebar {
                width: 100%;
                padding: 1rem;
                display: block;
            }
            .sidebar-nav {
                display: flex;
                gap: 0.5rem;
                flex-wrap: wrap;
            }
            .sidebar-nav li {
                flex: 1;
                min-width: 120px;
            }
            .sidebar-nav a {
                margin-bottom: 0;
                padding: 0.8rem;
                font-size: 0.7rem;
            }
            .main-content {
                padding: 1rem;
            }
        }
    </style>
</head>

<body style="padding-bottom: 0;">
    <div class="admin-layout">
        <aside class="sidebar" style="display: flex; flex-direction: column; gap: 1.5rem;">
            <div class="sidebar-brand" style="display: flex; align-items: center; justify-content: center; gap: 10px; font-weight: 800; font-size: 1.2rem; padding: 1rem; background: rgba(255,255,255,0.05); border-radius: 12px;">
                <i class="fa-solid fa-screwdriver-wrench"></i> 
                <span>MYBINI PANEL</span>
            </div>
            <ul class="sidebar-nav" style="list-style: none; display: flex; flex-direction: column; gap: 0.8rem;">
                <li>
                    <a href="index.php?url=admin/index" class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-blue-600 text-white border-2 border-gray-900 rounded-xl font-bold uppercase transition-all shadow-[6px_6px_0px_#ffea00] active:translate-x-[3px] active:translate-y-[3px] active:shadow-[3px_3px_0px_#ffea00] mb-4 text-sm <?php echo !isset($_GET['url']) || $_GET['url'] == 'admin/index' ? '' : 'bg-yellow-400 text-gray-900 shadow-[6px_6px_0px_#3d5afe] active:shadow-[3px_3px_0px_#3d5afe]'; ?> mb-0" style="text-align: left; justify-content: flex-start; width: 100%;">
                        <i class="fa-solid fa-house" style="width: 20px;"></i> DASHBOARD
                    </a>
                </li>
                <li>
                    <a href="index.php?url=admin/waifus" class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-blue-600 text-white border-2 border-gray-900 rounded-xl font-bold uppercase transition-all shadow-[6px_6px_0px_#ffea00] active:translate-x-[3px] active:translate-y-[3px] active:shadow-[3px_3px_0px_#ffea00] mb-4 text-sm <?php echo isset($_GET['url']) && $_GET['url'] == 'admin/waifus' ? '' : 'bg-yellow-400 text-gray-900 shadow-[6px_6px_0px_#3d5afe] active:shadow-[3px_3px_0px_#3d5afe]'; ?> mb-0" style="text-align: left; justify-content: flex-start; width: 100%;">
                        <i class="fa-solid fa-heart" style="width: 20px;"></i> KELOLA WAIFU
                    </a>
                </li>
                <li style="margin-top: auto; padding-top: 2rem;">
                    <a href="index.php?url=auth/logout" class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-blue-600 text-white border-2 border-gray-900 rounded-xl font-bold uppercase transition-all shadow-[6px_6px_0px_#ffea00] active:translate-x-[3px] active:translate-y-[3px] active:shadow-[3px_3px_0px_#ffea00] mb-4 text-sm bg-red-500 shadow-[6px_6px_0px_#1a1a1a] mb-0" style="text-align: left; justify-content: flex-start; width: 100%;">
                        <i class="fa-solid fa-right-from-bracket" style="width: 20px;"></i> LOGOUT
                    </a>
                </li>
            </ul>
        </aside>

        <main class="main-content">
            <?php echo $content; ?>
        </main>
    </div>
</body>

</html>