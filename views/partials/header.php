<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Waifu Gacha'; ?></title>
    <link rel="icon" href="/assets/img/logo.png" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style type="text/tailwindcss">
        @layer base {
            body {
                @apply bg-gray-50 text-gray-900 pb-24 min-h-screen font-[Lexend];
                background-image: radial-gradient(#d1d1d1 1px, transparent 1px);
                background-size: 20px 20px;
            }
        }
    </style>
</head>
<body>
