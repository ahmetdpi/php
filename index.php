<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Demo</title>
    <style>
        body {
            display: grid;
            place-items: center;
            height: 100vh;
            margin: 0;
            font-family: sans-serif;
        }
    </style>
</head>
<body>
    <?php
    $users = [
            ["id" => 1, "name" => "Ahmet", "age" => 25, "active" => true],
            ["id" => 2, "name" => "Mehmet", "age" => 30, "active" => false],
            ["id" => 3, "name" => "Fatma", "age" => 22, "active" => true],
            ["id" => 4, "name" => "Tarik", "age" => 28, "active" => true],
            ["id" => 5, "name" => "Zeynep", "age" => 19, "active" => false],
            ["id" => 6, "name" => "Tolga", "age" => 35, "active" => true],
            ["id" => 7, "name" => "Elif", "age" => 24, "active" => true],
            ["id" => 8, "name" => "Buiak", "age" => 27, "active" => false],
            ["id" => 9, "name" => "Tuba", "age" => 26, "active" => true],
            ["id" => 10, "name" => "Can", "age" => 17, "active" => false],
            ["id" => 11, "name" => "Adalll", "age" => 17, "active" => false],
            ["id" => 12, "name" => "Arya", "age" => 17, "active" => false],
    ];

    $sesli = [
            'a', 'e', 'ı', 'i', 'o', 'ö', 'u', 'ü'
    ];

    $sessiz = [
            'b', 'c', 'ç', 'd', 'f', 'g', 'ğ', 'h', 'j', 'k', 'l', 'm', 'n', 'p', 'r', 's', 'ş', 't', 'v', 'y', 'z'
    ];


    $ages = array_filter($users, function ($val) {
        return $val["age"] >= 25;
    });

    $harf = array_filter($users, function ($val) {
        return str_contains($val['name'], 't') || str_contains($val['name'], 'T');
    });

    $status = array_filter($users, function ($statu) {
        return $statu['active'] == true ;
    });

    $sesliHarf = array_filter($users, function ($user) use ($sesli) {
        $ilk = mb_strtolower(mb_substr($user['name'], 2, 1));
        return in_array($ilk, $sesli);
    });

    // A ile başla 1
    $Abasla = array_filter($users, function ($user) use ($sesli){
        $a = mb_strtolower(mb_substr($user['name'], 0, 1));
        return str_contains($a, 'a');
    });

    // T son al 2
    $tSon = array_filter($users, function ($user){
        $t = mb_strtolower(mb_substr($user['name'], -1));
        return str_contains($t, 't');
    });

    // 5 karakterden uzun olanlar 3
    $besU = array_filter($users, function ($user){
        return strlen(trim($user['name'])) > 5;
    });

    // 3. karakter seslimi sessiz harf mi kontrolü 4
    $seslilerGroup = [];
    $sessizlerGroup = [];

    $harfSesli = array_filter($users, function ($user) use ($sesli, &$seslilerGroup, &$sessizlerGroup){
        $harf = mb_strtolower(mb_substr($user['name'], 2, 1 ));

        if (in_array($harf, $sesli)) {
            $seslilerGroup[] = [
                    'veri' => $user,
                    'mesaj' => 'seslidir',
                    ];
        } else {
            $sessizlerGroup[] = [
                    'veri' => $user,
                    'mesaj' => 'sessizdir',
            ];
        }
        return true;
    });

    $arraDiffSesli = array_filter($users, function ($user) use ($sesli){
        $harf = mb_strtolower(mb_substr($user['name'], 2, 1));
        return in_array($harf, $sesli);
    });

    $arraDiffSessiz = array_filter($users, function ($user) use ($sessiz){
        $harf = mb_strtolower(mb_substr($user['name'], 2, 1));
        return in_array($harf, $sessiz);
    });


    ?>

    <h1>Adı başlangıcı A olanlar</h1>
    <table border="1" cellpadding="10">
        <tr>
            <th>Ürün Adı</th>
            <th>İndirimli Fiyatı</th>
            <th>Toplam Değer</th>

        </tr>
        <?php foreach ($Abasla as $h): ?>
           <tr>
            <td><?= $h['name'] ?></td>
            <td><?= $h['age']; ?></td>
            <td><?= $h['active'] ? 'Aktif' : 'Pasif'; ?></td>
       </tr>
        <?php endforeach; ?>
    </table>

    <h1>Adı sonu T olanlar</h1>
    <table border="1" cellpadding="10">
        <tr>
            <th>Ürün Adı</th>
            <th>İndirimli Fiyatı</th>
            <th>Toplam Değer</th>

        </tr>
        <?php foreach ($tSon as $h): ?>
            <tr>
                <td><?= $h['name'] ?></td>
                <td><?= $h['age']; ?></td>
                <td><?= $h['active'] ? 'Aktif' : 'Pasif'; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h1>3. harfi Sesliler</h1>
    <table border="1" cellpadding="10">
        <tr>
            <th>Adı</th>
            <th>yaşı</th>
            <th>harf kontrol</th>
            <th>Durum</th>

        </tr>
        <?php foreach ($seslilerGroup as $h): ?>
            <tr>
                <td><?= $h['veri']['name']; ?></td>
                <td><?= $h['veri']['age']; ?></td>
                <td><?= $h['mesaj']; ?></td>
                <td><?= $h['veri']['active'] ? 'Aktif' : 'Pasif'; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h1>3. harfi Sessizler</h1>
    <table border="1" cellpadding="10">
        <tr>
            <th>Adı</th>
            <th>yaşı</th>
            <th>harf kontrol</th>
            <th>Durum</th>

        </tr>
        <?php foreach ($sessizlerGroup as $h): ?>
            <tr>
                <td><?= $h['veri']['name']; ?></td>
                <td><?= $h['veri']['age']; ?></td>
                <td><?= $h['mesaj']; ?></td>
                <td><?= $h['veri']['active'] ? 'Aktif' : 'Pasif'; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>