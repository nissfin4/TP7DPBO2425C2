<?php
// Ambil semua data konser untuk dropdown
$list = $concert->getAll();

// Ambil data tiket yang mau diedit berdasarkan ID dari parameter URL
$data = $ticket->find($_GET["id"]);

// Jika form disubmit (ada data POST masuk)
if ($_POST) {
    // Update data tiket dengan data baru dari form
    $ticket->update(
        $_GET["id"],                 // ID tiket yang mau diupdate
        $_POST["concert"],           // ID konser baru
        $_POST["category"],          // Nama kategori baru
        $_POST["price"],             // Harga baru
        $_POST["quota"]              // Kuota baru
    );

    // Redirect ke halaman daftar tiket setelah update berhasil
    header("Location: index.php?page=ticket&action=list");
}
?>

<div class="card">
<h3>Edit Ticket Category</h3>

<!-- Form untuk mengedit data kategori tiket -->
<form method="POST">

    <label>Concert</label>
    <select name="concert"> <!-- Dropdown pilih konser -->
        <?php foreach ($list as $row): ?> <!-- Loop semua konser -->
        <option value="<?= $row['id_concert'] ?>" 
            <?= $row['id_concert'] == $data['id_concert'] ? "selected" : "" ?>> <!-- Tandai konser yang sedang dipilih -->
            <?= $row['concert_name'] ?> <!-- Nama konser -->
        </option>
        <?php endforeach ?>
    </select>

    <label>Category</label>
    <input type="text" name="category" value="<?= $data['category_name'] ?>"> <!-- Input kategori tiket -->

    <label>Price</label>
    <input type="number" name="price" value="<?= $data['price'] ?>"> <!-- Input harga tiket -->

    <label>Quota</label>
    <input type="number" name="quota" value="<?= $data['quota'] ?>"> <!-- Input kuota tiket -->

    <button class="btn btn-warning">Update</button> <!-- Tombol update -->
</form>
</div>
