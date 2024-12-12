<?php

    require "adminonly.php";
    require "../koneksi.php";

    $queryKuliner = mysqli_query($conn, "SELECT * FROM tempat_kuliner");
    $jumlahKuliner = mysqli_num_rows($queryKuliner);
    
    $queryWisata = mysqli_query($conn, "SELECT * FROM tempat_wisata");
    $jumlahWisata = mysqli_num_rows($queryWisata);
    
    $queryEvent = mysqli_query($conn, "SELECT * FROM event");
    $jumlahEvent = mysqli_num_rows($queryEvent);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .card {
            display: inline-block;
            width: 200px; /* Atur lebar card sesuai kebutuhan */
            margin: 10px; /* Jarak antar card */
            padding: 20px;
            border: 1px solid #ccc; /* Border untuk card */
            border-radius: 5px; /* Sudut melengkung */
            text-align: center; /* Teks di tengah */
            text-decoration: none; /* Menghilangkan garis bawah pada link */
            color: black; /* Warna teks */
            transition: background-color 0.3s; /* Efek transisi */
        }
        .card:hover {
            background-color: #f0f0f0; /* Warna latar belakang saat hover */
        }
</style>
</head>
<body>



<div>
    <a href="kelolapost.php?type=kuliner"class="card">
        <h3>Total Kuliner</h3>
        <p><?php echo $jumlahKuliner; ?></p>
    </a>

    <a href="kelolapost.php?type=wisata" class="card">
        <h3>Total Wisata</h3>
        <p><?php echo $jumlahWisata; ?></p>
    </a>
    
    <a href="kelolapost.php?type=event"class="card">
        <h3>Total Event</h3>
        <p><?php echo $jumlahEvent; ?></p>
    </a>
</div>

</body>
</html>