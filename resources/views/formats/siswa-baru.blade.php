<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa</title>
    <?php
    $border = 'style="border:1px solid black;"';
    function headers($width){
        return 'style="width:'.$width.'px;border:1px solid black;background-color:#CCCCCC;"';
    }
    ?>
</head>
<body>
<table>
    <thead>
        <tr>
            <th <?= headers(30) ?>>No</th>
            <th <?= headers(100) ?>>NIS</th>
            <th <?= headers(200) ?>>Nama Siswa</th>
            <th <?= headers(30) ?>>P/L</th>
            <th <?= headers(100) ?>>Kelas</th>
            <th <?= headers(80) ?>>Password</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td <?= $border?>>1</td>
            <td <?= $border?>>2020210001</td>
            <td <?= $border?>>Cut Nyak Dien</td>
            <td <?= $border?>>P</td>
            <td <?= $border?>>X RPL A</td>
            <td <?= $border?>>1234</td>
        </tr>
        <tr>
            <td <?= $border?>>2</td>
            <td <?= $border?>>2020210002</td>
            <td <?= $border?>>Pangeran Diponegoro</td>
            <td <?= $border?>>P</td>
            <td <?= $border?>>X RPL B</td>
            <td <?= $border?>>4444</td>
        </tr>
    </tbody>
</table>
</body>
</html>
