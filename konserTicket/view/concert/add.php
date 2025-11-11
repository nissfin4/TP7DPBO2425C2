<?php
// Mengecek apakah form dikirim (ada data POST)
if ($_POST) {
    // Memanggil fungsi store dari class Concert untuk menambah data baru
    $concert->store($_POST["name"], $_POST["date"], $_POST["venue"]);

    // Setelah berhasil disimpan, arahkan kembali ke halaman daftar concert
    header("Location: index.php?page=concert&action=list");
}
?>

<div class="card"> <!-- Tampilan form tambah data concert -->
<h3>Add Concert</h3>

<form method="POST"> <!-- Form kirim data ke halaman ini -->
    <label>Concert Name</label>
    <input type="text" name="name" required> <!-- Input nama konser -->

    <label>Date</label>
    <input type="date" name="date" required> <!-- Input tanggal konser -->

    <label>Venue</label>
    <input type="text" name="venue" required> <!-- Input lokasi konser -->

    <button class="btn btn-success">Save</button> <!-- Tombol simpan -->
</form>
</div>
