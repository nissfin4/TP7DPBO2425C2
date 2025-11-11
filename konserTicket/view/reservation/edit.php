<?php
// Ambil semua data kategori tiket (untuk isi dropdown)
$list = $ticket->getAll();

// Ambil data reservasi berdasarkan ID yang dikirim lewat URL (?id=)
$data = $reservation->find($_GET["id"]);

if ($_POST) { // Jika form disubmit (ada data POST)
    // Update data reservasi berdasarkan input pengguna
    $reservation->update(
        $_GET["id"],                 // ID reservasi yang diupdate
        $_POST["ticket"],            // ID kategori tiket baru
        $_POST["customer"],          // Nama pelanggan baru
        $_POST["qty"]                // Jumlah tiket baru
    );

    // Setelah berhasil update, kembali ke halaman daftar reservasi
    header("Location: index.php?page=reservation&action=list");
}
?>

<div class="card">
<h3>Edit Reservation</h3>

<!-- Form untuk mengedit data reservasi -->
<form method="POST">
    <label>Ticket</label>
    <!-- Dropdown berisi daftar tiket yang tersedia -->
    <select name="ticket">
        <?php foreach ($list as $row): ?> <!-- Loop semua tiket -->
        <option value="<?= $row['id_ticket_category'] ?>" 
            <?= $row['id_ticket_category'] == $data['id_ticket_category'] ? 'selected' : '' ?>> <!-- Pilih otomatis tiket yang sesuai -->
            <?= $row['concert_name'] ?> - <?= $row['category_name'] ?> <!-- Nama konser dan kategori tiket -->
        </option>
        <?php endforeach ?> <!-- Akhir loop -->
    </select>

    <label>Customer Name</label>
    <!-- Input nama pelanggan (diisi otomatis dari data lama) -->
    <input type="text" name="customer" value="<?= htmlspecialchars($data['customer_name']) ?>" required>

    <label>Quantity</label>
    <!-- Input jumlah tiket (diisi otomatis dari data lama) -->
    <input type="number" name="qty" value="<?= $data['qty'] ?>" required>

    <button class="btn btn-warning">Update</button> <!-- Tombol untuk update data -->
</form>
</div>
