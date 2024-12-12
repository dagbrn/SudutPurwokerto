<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Sidebar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #333;
            color: white;
            position: fixed;
        }
        .sidebar h2 {
            text-align: center;
            padding: 20px 0;
        }
        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }
        .sidebar ul li {
            padding: 15px 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .sidebar ul li:hover {
            background-color: #575757;
        }
        .content {
            margin-left: 260px; /* Memberikan ruang untuk sidebar */
            padding: 20px; /* Padding untuk konten */
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>Menu</h2>
    <ul>
        <li><a href="../adminpage" style="color:white;text-decoration:none;">Dashboard</a></li>
        <li><a href="kelolapost.php?type=kuliner" style="color:white;text-decoration:none;">Kelola Kuliner</a></li>
        <li><a href="kelolapost.php?type=wisata" style="color:white;text-decoration:none;">Kelola Wisata</a></li>
        <li><a href="kelolapost.php?type=event" style="color:white;text-decoration:none;">Kelola Event</a></li>
    </ul>
</div>

</body>
</html>