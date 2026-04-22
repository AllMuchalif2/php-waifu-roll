<?php
require_once 'app/Core/Database.php';
require_once 'app/Models/Waifu.php';

use App\Models\Waifu;

$waifuModel = new Waifu();

$characters = [
    // LIMITED (1)
    ['id' => 38142, 'tier' => 'LIMITED'], // Hatsune Miku
    
    // SSR (5)
    ['id' => 118763, 'tier' => 'SSR'], // Rem
    ['id' => 181966, 'tier' => 'SSR'], // Marin Kitagawa
    ['id' => 171587, 'tier' => 'SSR'], // Makima
    ['id' => 135315, 'tier' => 'SSR'], // Yor Forger
    ['id' => 184513, 'tier' => 'SSR'], // Frieren

    // SR (10)
    ['id' => 40128, 'tier' => 'SR'], // Mikasa Ackerman
    ['id' => 117224, 'tier' => 'SR'], // Megumin
    ['id' => 155679, 'tier' => 'SR'], // Zero Two
    ['id' => 35252, 'tier' => 'SR'], // Kurisu Makise
    ['id' => 147813, 'tier' => 'SR'], // Shinobu Kochou
    ['id' => 124518, 'tier' => 'SR'], // Violet Evergarden
    ['id' => 161404, 'tier' => 'SR'], // Mai Sakurajima
    ['id' => 130704, 'tier' => 'SR'], // Kaguya Shinomiya
    ['id' => 113974, 'tier' => 'SR'], // Raphtalia
    ['id' => 497, 'tier' => 'SR'], // Saber

    // A (15)
    ['id' => 118764, 'tier' => 'A'], // Emilia
    ['id' => 146157, 'tier' => 'A'], // Nezuko Kamado
    ['id' => 146115, 'tier' => 'A'], // Chika Fujiwara
    ['id' => 171590, 'tier' => 'A'], // Power
    ['id' => 94, 'tier' => 'A'], // Asuka
    ['id' => 86, 'tier' => 'A'], // Rei
    ['id' => 498, 'tier' => 'A'], // Rin Tohsaka
    ['id' => 1111, 'tier' => 'A'], // C.C.
    ['id' => 22037, 'tier' => 'A'], // Hitagi
    ['id' => 12064, 'tier' => 'A'], // Taiga
    ['id' => 7373, 'tier' => 'A'], // Holo
    ['id' => 67069, 'tier' => 'A'], // Yui Yuigahama
    ['id' => 67067, 'tier' => 'A'], // Yukino
    ['id' => 117183, 'tier' => 'A'], // Hestia
    ['id' => 50721, 'tier' => 'A'], // Rias Gremory

    // B (18)
    ['id' => 65239, 'tier' => 'B'], // Esdeath
    ['id' => 116239, 'tier' => 'B'], // Albedo
    ['id' => 116231, 'tier' => 'B'], // Shalltear
    ['id' => 117223, 'tier' => 'B'], // Aqua
    ['id' => 117225, 'tier' => 'B'], // Darkness
    ['id' => 97669, 'tier' => 'B'], // Jibril
    ['id' => 97671, 'tier' => 'B'], // Shiro
    ['id' => 97673, 'tier' => 'B'], // Steph
    ['id' => 70069, 'tier' => 'B'], // Kurumi Tokisaki
    ['id' => 70067, 'tier' => 'B'], // Tohka
    ['id' => 70071, 'tier' => 'B'], // Kotori
    ['id' => 70073, 'tier' => 'B'], // Origami
    ['id' => 70075, 'tier' => 'B'], // Yoshino
    ['id' => 94001, 'tier' => 'B'], // Yuzuru
    ['id' => 94003, 'tier' => 'B'], // Kaguya Yamai
    ['id' => 104595, 'tier' => 'B'], // Miku Izayoi
    ['id' => 151529, 'tier' => 'B'], // Natsumi
    ['id' => 185672, 'tier' => 'B'], // Nia Honjou

    // C (18)
    ['id' => 185673, 'tier' => 'C'], // Mukuro
    ['id' => 185674, 'tier' => 'C'], // Mio Takamiya
    ['id' => 185675, 'tier' => 'C'], // Tenka
    ['id' => 215456, 'tier' => 'C'], // Lucy
    ['id' => 215457, 'tier' => 'C'], // Rebecca
    ['id' => 184514, 'tier' => 'C'], // Fern
    ['id' => 159981, 'tier' => 'C'], // Maomao
    ['id' => 55133, 'tier' => 'C'], // Eru Chitanda
    ['id' => 80243, 'tier' => 'C'], // Shouko Nishimiya
    ['id' => 200540, 'tier' => 'C'], // Ai Hoshino
    ['id' => 202660, 'tier' => 'C'], // Ruby Hoshino
    ['id' => 202661, 'tier' => 'C'], // Arima Kana
    ['id' => 202662, 'tier' => 'C'], // Akane Kurokawa
    ['id' => 173003, 'tier' => 'C'], // Chisato Nishikigi
    ['id' => 173004, 'tier' => 'C'], // Takina Inoue
    ['id' => 31237, 'tier' => 'C'], // Ui Hirasawa
    ['id' => 19565, 'tier' => 'C'], // Mio Akiyama
    ['id' => 19566, 'tier' => 'C'], // Azusa Nakano
];

echo "Starting seeding...\n";
foreach ($characters as $char) {
    echo "Fetching ID: {$char['id']}... ";
    $data = $waifuModel->fetchFromJikan($char['id']);
    if ($data) {
        $waifuModel->create($data['jikan_id'], $data['name'], $data['image_url'], $char['tier']);
        echo "Success ({$data['name']} - {$char['tier']})\n";
    } else {
        echo "Failed!\n";
    }
    // Sleep to avoid rate limiting
    usleep(500000); // 0.5 seconds
}

echo "Seeding completed!\n";
?>
