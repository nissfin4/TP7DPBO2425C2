<?php
// Panggil class yang dibutuhkan
require_once 'class/Concert.php';
require_once 'class/TicketCategory.php';
require_once 'class/Reservation.php';

// Buat objek dari masing-masing class
$concert = new Concert();
$ticket = new TicketCategory();
$reservation = new Reservation();


// Tambah reservasi baru
if (isset($_POST['reserve'])) {
    $reservation->addReservation(
        $_POST['concert_id'],
        $_POST['ticket_category_id'],
        $_POST['customer_name'],
        $_POST['quantity']
    );
}

// Hapus reservasi
if (isset($_GET['cancel'])) {
    $reservation->deleteReservation($_GET['cancel']);
}

// Hapus konser
if (isset($_GET['delete_concert'])) {
    $concert->deleteConcert($_GET['delete_concert']);
}

// Hapus kategori tiket
if (isset($_GET['delete_ticket'])) {
    $ticket->deleteTicketCategory($_GET['delete_ticket']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Concert Ticket Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">

        <!-- Header -->
        <header>
            <h1>Concert Ticket Management</h1>
            <p>Manage concerts, ticket categories, and reservations easily</p>
        </header>

        <!-- Navigasi -->
        <nav>
            <ul>
                <li><a href="?page=concerts">Concerts</a></li>
                <li><a href="?page=tickets">Ticket Categories</a></li>
                <li><a href="?page=reservations">Reservations</a></li>
            </ul>
        </nav>

        <!-- Konten utama -->
        <main>
            <?php
            // Cek halaman yang dipilih
            if (isset($_GET['page'])) {
                $page = $_GET['page'];

                if ($page === 'concerts') {
                    include 'view/concerts.php';
                } elseif ($page === 'tickets') {
                    include 'view/ticket_categories.php';
                } elseif ($page === 'reservations') {
                    include 'view/reservations.php';
                } else {
                    echo "<p>Page not found.</p>";
                }
            } else {
                // Halaman default
                echo "<h2>Welcome to Concert Ticket Management</h2>";
                echo "<p>Select a menu above to manage concerts, tickets, or reservations.</p>";
            }
            ?>
        </main>

        <!-- Footer -->
        <footer>
            <p>&copy; 2025 Concert Ticket</p>
        </footer>

    </div>
</body>
</html>
