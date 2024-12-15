<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
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

        .menu-item:nth-child(4) {
            background-color: #D7EAE4;
        }
        
        .content {
            flex: 1;
            background-color: #D7EAE4;
            border-radius: 20px;
            padding: 40px;
        }

        .content h2 {
            font-size: 32px;
            margin: 0 0 30px 0;
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

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .add-button {
            background-color: #D7EAE4;
            border: 2px solid #96B6AB;
            color: #96B6AB;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }

        .content-table {
            width: 100%;
            background: rgba(255, 255, 255,);
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #96B6AB;
        }

        .content-table thead {
            background-color: #96B6AB;
            color: white;
        }

        .content-table th {
            padding: 15px;
            text-align: left;
            border: 1px solid #96B6AB;
        }

        .content-table td {
            padding: 15px;
            border: 1px solid #96B6AB;
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

        .form-container {
            background: rgba(255, 255, 255, 0.6);
            border-radius: 15px;
            padding: 40px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .form-layout {
            display: flex;
            gap: 60px;
        }

        .left-section {
            width: 45%;
        }

        .right-section {
            width: 45%;
        }

        .form-group {
            margin-bottom: 35px;
        }

        .form-group label {
            display: block;
            font-weight: 500;
            margin-bottom: 12px;
            font-size: 16px;
        }

        .form-control {
            width: 100%;
            padding: 15px;
            border: 1px solid #96B6AB;
            border-radius: 12px;
            font-size: 14px;
            background-color: rgba(255, 255, 255, 0.9);
        }

        .right-section textarea.form-control {
            height: 150px;
            resize: none;
            border: 1px solid #96B6AB;
        }

        .button-group {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 30px;
        }

        .btn-cancel {
            padding: 12px 40px;
            border: 2px solid #FFD966;
            background: #fff;
            color: #FFD966;
            border-radius: 25px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
        }

        .btn-submit {
            padding: 12px 40px;
            border: none;
            background: #FFD966;
            color: black;
            border-radius: 25px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
        }

        .content h2 {
            margin-bottom: 30px;
            font-size: 28px;
        }

        .btn-cancel:hover {
            background-color: rgba(255, 217, 102, 0.1);
        }

        .btn-submit:hover {
            background-color: #ffd042;
        }

    </style>
</head>
<body>
    <div class="header">
        <h1>SudutPurwokerto</h1>
        <div class="admin-text">
            <img src="icon.png" width="24" height="24">
            Admin
        </div>
    </div>

    <div class="container">
        <div class="sidebar">
            <div class="menu-item">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M4 13h6c.55 0 1-.45 1-1V4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v8c0 .55.45 1 1 1zm0 8h6c.55 0 1-.45 1-1v-4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v4c0 .55.45 1 1 1zm10 0h6c.55 0 1-.45 1-1v-8c0-.55-.45-1-1-1h-6c-.55 0-1 .45-1 1v8c0 .55.45 1 1 1zM13 4v4c0 .55.45 1 1 1h6c.55 0 1-.45 1-1V4c0-.55-.45-1-1-1h-6c-.55 0-1 .45-1 1z" fill="currentColor"/>
                </svg>
                Dashboard
            </div>
            <div class="menu-item">
                <svg width="24" height="24" viewBox="0 0 24 24">
                    <path d="M11 9H9V2H7v7H5V2H3v7c0 2.12 1.66 3.84 3.75 3.97V22h2.5v-9.03C11.34 12.84 13 11.12 13 9V2h-2v7zm5-3v8h2.5v8H21V2c-2.76 0-5 2.24-5 4z"/>
                </svg>
                Kelola Kuliner
            </div>
            <div class="menu-item">
                <svg width="24" height="24" viewBox="0 0 24 24">
                    <path d="M14 6l-4.22 5.63 1.25 1.67L14 9.33 19 16h-8.46l-4.01-5.37L1 18h22L14 6zM5 16l1.52-2.03L8.04 16H5z"/>
                </svg>
                Kelola Wisata
            </div>
            <div class="menu-item">
                <svg width="24" height="24" viewBox="0 0 24 24">
                    <path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10zM9 14H7v-2h2v2zm4 0h-2v-2h2v2zm4 0h-2v-2h2v2zm-8 4H7v-2h2v2zm4 0h-2v-2h2v2zm4 0h-2v-2h2v2z"/>
                </svg>
                Kelola Event
            </div>
        </div>

        <div class="content">
            <h2>Edit Event</h2>
            
            <div class="form-container">
                <div class="form-layout">
                    <!-- Kolom Kiri -->
                    <div class="left-section">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" value="Umahe Inyong">
                        </div>
                        
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="text" class="form-control" value="Jalan Raya Baturraden KM 14, Purwokerto, Jawa Tengah.">
                        </div>
                        
                        <div class="form-group">
                            <label>Lokasi</label>
                            <input type="text" class="form-control" value="Rp20.000 - Rp 50.000 per orang.">
                        </div>
                        
                        <div class="form-group">
                            <label>Waktu</label>
                            <input type="text" class="form-control" value="Setiap Hari 10.00 - 22.00 WIB.">
                        </div>

                        <div class="form-group">
                            <label>Tiket Masuk</label>
                            <input type="text" class="form-control" value="Setiap Hari 10.00 - 22.00 WIB.">
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="right-section">
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea class="form-control">Umahe Inyong</textarea>
                        </div>
                        
                        <div class="form-group">
                            <label>Sosial Media</label>
                            <textarea class="form-control">• Soto Sokaraja
• Nasi Goreng Kampung
• Sate Blater
• Gecot Tahu</textarea>
                        </div>
                    </div>
                </div>

                <!-- Tombol -->
                <div class="button-group">
                    <button class="btn-cancel">Batal</button>
                    <button class="btn-submit">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- SVG Icons for action buttons -->
    <svg style="display: none;">
        <symbol id="edit-icon" viewBox="0 0 24 24">
            <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
        </symbol>
        <symbol id="delete-icon" viewBox="0 0 24 24">
            <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
        </symbol>
        <symbol id="view-icon" viewBox="0 0 24 24">
            <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
        </symbol>
    </svg>
</body>
</html>
