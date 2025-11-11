<?php
// Ambil semua data kategori tiket dari database (digunakan untuk isi dropdown)
$list = $ticket->getAll();

if ($_POST) { // Jika form dikirim (ada data POST)
    // Simpan data reservasi baru ke database
    $reservation->store($_POST["ticket"], $_POST["customer"], $_POST["qty"]);

    // Setelah berhasil disimpan, arahkan ke halaman daftar reservasi
    header("Location: index.php?page=reservation&action=list");
}
?>

<div class="card">
<h3>Add Reservation</h3>

<!-- Form untuk menambah data reservasi -->
<form method="POST">
    <label>Ticket</label>
    <!-- Dropdown untuk memilih kategori tiket -->
    <select name="ticket">
        <?php foreach ($list as $row): ?> <!-- Loop semua tiket yang tersedia -->
        <option value="<?= $row['id_ticket_category'] ?>">
            <?= $row['concert_name'] ?> - <?= $row['category_name'] ?> <!-- Tampilkan nama konser dan kategori -->
        </option>
        <?php endforeach ?> <!-- Akhir loop -->
    </select>

    <label>Customer Name</label>
    <input type="text" name="customer" required> <!-- Input nama pelanggan -->

    <label>Quantity</label>
    <input type="number" name="qty" required> <!-- Input jumlah tiket -->

    <button class="btn btn-success">Save</button> <!-- Tombol untuk menyimpan data -->
</form>
</div>
