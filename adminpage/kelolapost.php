<?php
require "../koneksi.php";
require "adminonly.php";

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$type = isset($_GET['type']) ? $_GET['type'] : '';
if ($type == 'kuliner') {
    $title = "Kelola Kuliner";
    // Query buat tempat kuliner
    $query = "SELECT id_kuliner AS id, nama_kuliner AS nama, tgl AS tanggal FROM tempat_kuliner";
} elseif ($type == 'wisata') {
    $title = "Kelola Wisata";
    // Query buat tempat wisata
    $query = "SELECT id_wisata AS id, nama_wisata AS nama, tgl AS tanggal FROM tempat_wisata";
} elseif ($type == 'event') {
    $title = "Kelola Event";
    // Query buat event
    $query = "SELECT id_event AS id, nama_event AS nama, tgl AS tanggal FROM event";
} else {
    echo "Jenis postingan tidak valid.";
    exit();
}

    $queryAdmin = "SELECT nama_lengkap AS nama, foto FROM akun WHERE id_akun = " . $_SESSION["id_akun"];
    $informasiAdmin = mysqli_query($conn, $queryAdmin);
    $dataAdmin = mysqli_fetch_assoc($informasiAdmin);

// Proses hapus kalo ada permintaan
if (isset($_POST['delete'])) {
    $post_id = intval($_POST['post_id']);
    
    // Query buat menghapus postingan
    if ($type == 'kuliner') {
        $delete_query = "DELETE FROM tempat_kuliner WHERE id_kuliner = $post_id";
    } elseif ($type == 'wisata') {
        $delete_query = "DELETE FROM tempat_wisata WHERE id_wisata = $post_id";
    } elseif ($type == 'event') {
        $delete_query = "DELETE FROM event WHERE id_event = $post_id";
    }

    if (mysqli_query($conn, $delete_query)) {
        echo "<p>Postingan berhasil dihapus.</p>";
        ?>
        <meta http-equiv="refresh" content="2; url=kelolapost.php?type=<?php echo$type; ?>"/>
        <?php
    } else {
        echo "<p>Error: " . mysqli_error($conn) . "</p>";
    }
}

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
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

        .sidebar a {
            text-decoration: none;
        }

        .admin-text::before {
            content: '';
            display: inline-block;
            width: 24px;
            height: 24px;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
        }

        .container {
            display: flex;
            gap: 30px;
        }
        
        .sidebar {
            width: 250px;
        }
        
        .menu-item.active {
            background-color: #D7EAE4;
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
        }

        .menu-item:nth-child(2) {
            background-color: #D7EAE4;
        }
        
        .add-button {
            background-color: #D7EAE4;
            border: 2px solid #96B6AB;
            color: #96B6AB;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            float: right; /* Align ke kanan */
        }

        .content {
            flex: 1;
            background-color: #D7EAE4;
            border-radius: 20px;
            padding: 30px;
        }

        .content h2 {
            margin-top: 0;
            font-size: 24px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between; /* Membuat judul dan tombol berada di baris yang sama */
            align-items: center; /* Vertikal align */
        }

        .content a{
            text-decoration: none;
        }
        
        .content-table {
            width: 100%;
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }

        .content-table thead {
            background-color: #96B6AB;
            color: white;
        }

        .content-table th, .content-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .action-buttons button {
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px;
        }

        .action-buttons svg {
            fill: #96B6AB;
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
                        <path d="M14 6l-4.22 5.63 1.25 1.67L14 9.33 19 16h-8.46l-4.01-5.37L1  18h22L14 6zM5 16l1.52-2.03L8.04 16H5z"/>
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
            <h2><?php echo $title; ?>
                <a href="tambahpost.php?type=<?php echo $type; ?>" class="add-button">+ Tambah Konten</a>
            </h2>

            <table class="content-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Judul Postingan</th>
                        <th>Tanggal</th>
                        <th>Komentar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['nama']; ?></td>
                            <td><?php echo date('d-m-Y', strtotime($row['tanggal'])); ?></td>
                            <td><?php echo isset($row['komentar']) ? $row['komentar'] : ''; ?></td>
                            <td class="action-buttons">
                                <a href="editpost.php?type=<?php echo $type; ?>&id=<?php echo $row['id']; ?>">
                                    <button class="edit-btn">
                                        <svg width="20" height="20" viewBox="0 0 24 24">
                                            <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                                        </svg>
                                    </button>
                                </a>
                                <form action="" method="POST" style="display:inline;">
                                    <input type="hidden" name="post_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" name="delete" class="delete-btn" onclick="return confirm('Apakah Anda yakin ingin menghapus postingan ini?');">
                                        <svg width="20" height="20" viewBox="0 0 24 24">
                                            <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                                        </svg>
                                    </button>
                                </form>
                                <a href="viewpost.php?type=<?php echo $type; ?>&id=<?php echo $row['id']; ?>">
                                    <button class="view-btn">
                                        <svg width="20" height="20" viewBox="0 0 24 24">
                                            <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                                        </svg>
                                    </button>
                                </a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='5'>Tidak ada data buat jenis postingan ini.</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>