<?php
    require "adminonly.php";
    require "../koneksi.php";

    $queryKuliner = mysqli_query($conn, "SELECT * FROM tempat_kuliner");
    $jumlahKuliner = mysqli_num_rows($queryKuliner);

    $queryWisata = mysqli_query($conn, "SELECT * FROM tempat_wisata");
    $jumlahWisata = mysqli_num_rows($queryWisata);

    $queryEvent = mysqli_query($conn, "SELECT * FROM event");
    $jumlahEvent = mysqli_num_rows($queryEvent);

    $queryAdmin = "SELECT nama_lengkap AS nama, foto FROM akun WHERE id_akun = " . $_SESSION["id_akun"];
    $informasiAdmin = mysqli_query($conn, $queryAdmin);
    $dataAdmin = mysqli_fetch_assoc($informasiAdmin);

    $currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <style>
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            margin: 0;
            padding: 20px 40px;
            background-color: rgb(255, 251, 239);
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .header h1 {
            font-size: 24px;
            margin: 0;
        }
        .admin-text {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .container {
            display: flex;
            gap: 30px;
        }
        .sidebar {
            width: 250px;
        }
        .sidebar a {
            text-decoration: none;
        }
        .menu-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 20px;
            margin: 5px 0;
            border-radius: 10px;
            color: #333;
            font-size: 16px;
            background-color: transparent;
        }
        .menu-item.active {
            background-color: #D7EAE4;
        }
        .content {
            flex: 1;
            background-color: #D7EAE4;
            border-radius: 20px;
            padding: 30px;
            height: 600px;
        }
        .content h2 {
            margin-top: 0;
            font-size: 24px;
            margin-bottom: 30px;
        }
        .stats-container {
            display: flex;
            gap: 20px;
        }
        .stat-box {
            background: white;
            padding: 20px;
            border-radius: 15px;
            flex: 1;
            display: flex;
            align-items: center;
            gap: 15px;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
        }
        .stat-box:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .icon-box {
            background: #FFD966;
            padding: 15px;
            border-radius: 12px;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .stat-info div:first-child {
            color: #666;
            margin-bottom: 5px;
        }
        .stat-number {
            font-size: 32px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>SudutPurwokerto</h1>
        <div class="admin-text">
            <img src="../userimage/pp.png" width="24" height="24">
            <?php echo $dataAdmin['nama']; ?>
        </div>
    </div>

    <div class="container">
        <div class="sidebar">
            <a href="../adminpage/">
                <div class="menu-item <?php echo $currentPage === 'index.php' ? 'active' : ''; ?>">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M4 13h6c.55 0 1-.45 1-1V4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v8c0 .55.45 1 1 1zm0 8h6c.55 0 1-.45 1-1v-4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v4c0 .55.45 1 1 1zm10 0h6c.55 0 1-.45 1-1v-8c0-.55-.45-1-1-1h-6c-.55 0-1 .45-1 1v8c0 .55.45 1 1 1zM13 4v4c0 .55.45 1 1 1h6c.55 0 1-.45 1-1V4c0-.55-.45-1-1-1h-6c-.55 0-1 .45-1 1z" fill="currentColor"/>
                    </svg>
                    Dashboard
                </div>
            </a>
            <a href="kelolapost.php?type=kuliner">
                <div class="menu-item <?php echo isset($_GET['type']) && $_GET['type'] === 'kuliner' ? 'active' : ''; ?>">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <path d="M11 9H9V2H7v7H5V2H3v7c0 2.12 1.66 3.84 3.75 3.97V22h2.5v-9.03C11.34 12.84 13 11.12 13 9V2h-2v7zm5-3v8h2.5v8H21V2c-2.76 0-5 2.24-5 4z"/>
                    </svg>
                    Kelola Kuliner
                </div>
            </a>
            <a href="kelolapost.php?type=wisata">
                <div class="menu-item <?php echo isset($_GET['type']) && $_GET['type'] === 'wisata' ? 'active' : ''; ?>">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <path d="M14 6l-4.22 5.63 1.25 1.67L14 9.33 19 16h-8.46l-4.01-5.37L1 18h22L14 6zM5 16l1.52-2.03L8.04 16H5z"/>
                    </svg>
                    Kelola Wisata
                </div>
            </a>
            <a href="kelolapost.php?type=event">
                <div class="menu-item <?php echo isset($_GET['type']) && $_GET['type'] === 'event' ? 'active' : ''; ?>">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10zM9 14H7v-2h2v2zm4 0h-2v-2h2v2zm4 0h-2v-2h2v2zm-8 4H7v-2h2v2zm4 0h-2v-2h2v2zm4 0h-2v-2h2v2z"/>
                    </svg>
                    Kelola Event
                </div>
            </a>
        </div>

        <div class="content">
            <h2>Ringkasan</h2>
            <div class="stats-container">
                <a href="kelolapost.php?type=kuliner" class="stat-box">
                    <div class="icon-box">
                        <svg width="24" height="24" viewBox="0 0 24 24">
                            <path d="M11 9H9V2H7v7H5V2H3v7c0 2.12 1.66 3.84 3.75 3.97V22h2.5v-9.03C11.34 12.84 13 11.12 13 9V2h-2v7zm5-3v8h2.5v8H21V2c-2.76 0-5 2.24-5 4z"/>
                        </svg>
                    </div>
                    <div class="stat-info">
                        <div>Total Kuliner</div>
                        <div class="stat-number"><?php echo $jumlahKuliner; ?></div>
                    </div>
                </a>

                <a href="kelolapost.php?type=wisata" class="stat-box">
                    <div class="icon-box">
                        <svg width="24" height="24" viewBox="0 0 24 24">
                            <path d="M14 6l-4.22 5.63 1.25 1.67L14 9.33 19 16h-8.46l-4.01-5.37L1 18h22L14 6zM5 16l1.52-2.03L8.04 16H5z"/>
                        </svg>
                    </div>
                    <div class="stat-info">
                        <div>Total Wisata</div>
                        <div class="stat-number"><?php echo $jumlahWisata; ?></div>
                    </div>
                </a>

                <a href="kelolapost.php?type=event" class="stat-box">
                    <div class="icon-box">
                        <svg width="24" height="24" viewBox="0 0 24 24">
                            <path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10zM9 14H7v-2h2v2zm4 0h-2v-2h2v2zm4 0h-2v-2h2v2zm-8 4H7v-2h2v2zm4 0h-2v-2h2v2zm4 0h-2v-2h2v2z"/>
                        </svg>
                    </div>
                    <div class="stat-info">
                        <div>Total Event</div>
                        <div class="stat-number"><?php echo $jumlahEvent; ?></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</body>
</html>
