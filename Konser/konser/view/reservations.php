<?php
// Panggil file class yang dibutuhkan
require_once 'class/Reservation.php';
require_once 'class/TicketCategory.php';
require_once 'class/Concert.php';

// Buat objek dari masing-masing class
$reservation = new Reservation();
$ticket = new TicketCategory();
$concert = new Concert();

// Ambil data konser dan kategori tiket untuk isi dropdown
$concerts = $concert->getAllConcerts();
$tickets = $ticket->getAllTicketCategories();

// Tambah data reservasi baru
if (isset($_POST['add'])) {
    $reservation->addReservation(
        $_POST['id_concert'], 
        $_POST['id_ticket_category'], 
        $_POST['customer_name'], 
        $_POST['quantity']
    );
    header("Location: ?page=reservations");
    exit;
}

// Update data reservasi
if (isset($_POST['update'])) {
    $reservation->updateReservation(
        $_POST['id_reservation'], 
        $_POST['id_concert'], 
        $_POST['id_ticket_category'], 
        $_POST['customer_name'], 
        $_POST['quantity']
    );
    header("Location: ?page=reservations");
    exit;
}

// Hapus data reservasi
if (isset($_GET['delete'])) {
    $reservation->deleteReservation($_GET['delete']);
    header("Location: ?page=reservations");
    exit;
}

// Ambil data reservasi untuk form edit
$editData = null;
if (isset($_GET['edit'])) {
    $editData = $reservation->getReservationById($_GET['edit']);
}

// Ambil semua data reservasi untuk ditampilkan di tabel
$reservations = $reservation->getAllReservations();
?>

<h3>Reservation List</h3>

<!-- Form tambah atau edit reservasi -->
<form method="POST">
    <h3><?= $editData ? "Edit Reservation" : "Add Reservation" ?></h3>

    <!-- Hidden ID, dipakai untuk update -->
    <input type="hidden" name="id_reservation" value="<?= $editData['id_reservation'] ?? '' ?>">

    <label>Customer Name:</label>
    <input type="text" name="customer_name" value="<?= htmlspecialchars($editData['customer_name'] ?? '') ?>" required>

    <label>Concert:</label>
    <select name="id_concert" required>
        <option value="">-- Select Concert --</option>
        <?php foreach ($concerts as $c): ?>
            <option value="<?= $c['id_concert'] ?>" <?= isset($editData['id_concert']) && $editData['id_concert'] == $c['id_concert'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($c['concert_name']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Ticket Category:</label>
    <select name="id_ticket_category" required>
        <option value="">-- Select Category --</option>
        <?php foreach ($tickets as $t): ?>
            <option value="<?= $t['id_ticket_category'] ?>" <?= isset($editData['id_ticket_category']) && $editData['id_ticket_category'] == $t['id_ticket_category'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($t['category_name']) ?> (<?= htmlspecialchars($t['concert_name']) ?>)
            </option>
        <?php endforeach; ?>
    </select>

    <label>Quantity:</label>
    <input type="number" name="quantity" min="1" value="<?= $editData['quantity'] ?? '' ?>" required>

    <!-- Tombol aksi tergantung mode -->
    <?php if ($editData): ?>
        <button type="submit" name="update">Update Reservation</button>
        <a href="?page=reservations" class="btn btn-danger">Cancel</a>
    <?php else: ?>
        <button type="submit" name="add">Add Reservation</button>
    <?php endif; ?>
</form>

<!-- Tabel daftar reservasi -->
<table border="1">
    <tr>
        <th>ID</th>
        <th>Customer Name</th>
        <th>Concert</th>
        <th>Category</th>
        <th>Quantity</th>
        <th>Action</th>
    </tr>

    <!-- Loop untuk menampilkan semua data reservasi -->
    <?php foreach ($reservations as $r): ?>
    <tr>
        <td><?= $r['id_reservation'] ?></td>
        <td><?= htmlspecialchars($r['customer_name']) ?></td>
        <td><?= htmlspecialchars($r['concert_name']) ?></td>
        <td><?= htmlspecialchars($r['category_name']) ?></td>
        <td><?= $r['quantity'] ?></td>
        <td class="table-actions">
            <a href="?page=reservations&edit=<?= $r['id_reservation'] ?>" class="btn btn-warning">Edit</a>
            <a href="?page=reservations&delete=<?= $r['id_reservation'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
