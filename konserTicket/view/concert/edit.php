<?php
// Ambil data konser berdasarkan ID dari URL (untuk ditampilkan di form)
$data = $concert->find($_GET["id"]);

if ($_POST) { // Cek apakah form dikirim
    // Update data konser berdasarkan ID yang dikirim
    $concert->update($_GET["id"], $_POST["name"], $_POST["date"], $_POST["venue"]);

    // Setelah berhasil update, arahkan ke halaman daftar concert
    header("Location: index.php?page=concert&action=list");
}
?>

<div class="card"> <!-- Container card untuk tampilan edit -->
<h3>Edit Concert</h3>

<form method="POST"> <!-- Form untuk mengedit data konser -->
    <label>Concert Name</label>
    <input type="text" name="name" value="<?= $data['concert_name'] ?>"> <!-- Nama konser saat ini -->

    <label>Date</label>
    <input type="date" name="date" value="<?= $data['date'] ?>"> <!-- Tanggal konser saat ini -->

    <label>Venue</label>
    <input type="text" name="venue" value="<?= $data['venue'] ?>"> <!-- Lokasi konser saat ini -->

    <button class="btn btn-warning">Update</button> <!-- Tombol simpan perubahan -->
</form>
</div>
