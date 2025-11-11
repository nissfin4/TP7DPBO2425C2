<?php
// Ambil semua data konser untuk ditampilkan di dropdown
$list = $concert->getAll();

// Jika form disubmit (ada data POST masuk)
if ($_POST) {
    // Simpan data tiket baru ke database menggunakan method store()
    $ticket->store($_POST["concert"], $_POST["category"], $_POST["price"], $_POST["quota"]);

    // Setelah berhasil, arahkan kembali ke halaman daftar tiket
    header("Location: index.php?page=ticket&action=list");
}
?>

<div class="card">
<h3>Add Ticket Category</h3>

<!-- Form untuk menambahkan kategori tiket baru -->
<form method="POST">

    <label>Concert</label>
    <select name="concert"> <!-- Dropdown pilih konser -->
        <?php foreach ($list as $row): ?> <!-- Loop data konser -->
        <option value="<?= $row['id_concert'] ?>"> <!-- ID konser -->
            <?= $row['concert_name'] ?> <!-- Nama konser -->
        </option>
        <?php endforeach ?>
    </select>

    <label>Category</label>
    <input type="text" name="category" required> <!-- Input kategori tiket -->

    <label>Price</label>
    <input type="number" name="price" required> <!-- Input harga tiket -->

    <label>Quota</label>
    <input type="number" name="quota" required> <!-- Input kuota tiket -->

    <button class="btn btn-success">Save</button> <!-- Tombol simpan -->
</form>
</div>
