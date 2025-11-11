<?php
// ====== Import class utama ======
require_once "class/Concert.php";       // Class untuk data konser
require_once "class/TicketCategory.php"; // Class untuk data kategori tiket
require_once "class/Reservation.php";    // Class untuk data reservasi

// ====== Inisialisasi objek ======
$concert     = new Concert();      // Objek konser
$ticket      = new TicketCategory(); // Objek kategori tiket
$reservation = new Reservation();  // Objek reservasi

// ====== Routing halaman ======
$page   = $_GET["page"]   ?? "concert"; // Default: halaman konser
$action = $_GET["action"] ?? "list";    // Default: tampilkan daftar
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Concert Ticket Management</title> <!-- Judul tab browser -->
    <link rel="stylesheet" href="style.css">  <!-- Panggil file CSS utama -->
</head>

<body>
<div class="container"> <!-- Bungkus utama seluruh layout -->

    <!-- ====== Header ====== -->
    <header>
        <h1>Concert Ticket Management</h1>
        <p>Manage concerts, ticket categories, and reservations easily</p>
    </header>

    <!-- ====== Navigasi utama ====== -->
    <nav>
        <ul>
            <li><a href="?page=concert&action=list">Concerts</a></li>         <!-- Ke halaman konser -->
            <li><a href="?page=ticket&action=list">Ticket Categories</a></li> <!-- Ke halaman kategori tiket -->
            <li><a href="?page=reservation&action=list">Reservations</a></li> <!-- Ke halaman reservasi -->
        </ul>
    </nav>

    <!-- ====== Konten utama dinamis ====== -->
    <main class="page-wrapper">
        <?php
        // Cek apakah folder dan file view yang diminta tersedia
        if (is_dir("view/$page") && file_exists("view/$page/$action.php")) {
            include "view/$page/$action.php"; // Tampilkan halaman sesuai request
        } else {
            echo "<h3>Page Not Found</h3>";   // Jika file tidak ditemukan
        }
        ?>
    </main>

    <!-- ====== Footer ====== -->
    <footer>
        <p>© 2025 Concert Ticket System</p> <!-- Teks hak cipta -->
    </footer>

</div> <!-- Tutup container utama -->
</body>
</html>
