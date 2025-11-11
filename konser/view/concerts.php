<?php
require_once 'class/Concert.php'; // Panggil file class Concert
$concert = new Concert(); // Buat objek Concert

if (isset($_POST['add'])) { // Jika tombol tambah ditekan
    $concert->createConcert($_POST['concert_name'], $_POST['date'], $_POST['venue']); // Tambah data baru
    header("Location: ?page=concerts"); // Kembali ke halaman konser
    exit;
}

if (isset($_POST['update'])) { // Jika tombol update ditekan
    $concert->updateConcert($_POST['id_concert'], $_POST['concert_name'], $_POST['date'], $_POST['venue']); // Update data konser
    header("Location: ?page=concerts"); // Refresh halaman
    exit;
}

if (isset($_GET['delete'])) { // Jika tombol hapus ditekan
    $concert->deleteConcert($_GET['delete']); // Hapus data konser
    header("Location: ?page=concerts"); // Kembali ke halaman konser
    exit;
}

$editData = null; // Inisialisasi variabel edit
if (isset($_GET['edit'])) { // Jika mode edit aktif
    $editData = $concert->getConcertById($_GET['edit']); // Ambil data konser berdasarkan ID
}

$concerts = $concert->getAllConcerts(); // Ambil semua data konser
?>

<h3>Concert List</h3>

<form method="POST">
    <h3><?= $editData ? "Edit Concert" : "Add New Concert" ?></h3> <!-- Judul form berubah sesuai mode -->

    <input type="hidden" name="id_concert" value="<?= $editData['id_concert'] ?? '' ?>"> <!-- ID tersembunyi saat edit -->

    <label>Concert Name:</label>
    <input type="text" name="concert_name" value="<?= htmlspecialchars($editData['concert_name'] ?? '') ?>" required> <!-- Input nama konser -->

    <label>Date:</label>
    <input type="date" name="date" value="<?= $editData['date'] ?? '' ?>" required> <!-- Input tanggal -->

    <label>Venue:</label>
    <input type="text" name="venue" value="<?= htmlspecialchars($editData['venue'] ?? '') ?>" required> <!-- Input tempat -->

    <?php if ($editData): ?> <!-- Jika sedang edit -->
        <button type="submit" name="update">Update Concert</button> <!-- Tombol update -->
        <a href="?page=concerts" class="btn btn-danger">Cancel</a> <!-- Tombol batal -->
    <?php else: ?> <!-- Jika mode tambah -->
        <button type="submit" name="add">Add Concert</button> <!-- Tombol tambah -->
    <?php endif; ?>
</form>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Concert Name</th>
        <th>Date</th>
        <th>Venue</th>
        <th>Action</th>
    </tr>
    <?php foreach ($concerts as $c): ?> <!-- Loop semua konser -->
    <tr>
        <td><?= $c['id_concert'] ?></td> <!-- Tampilkan ID -->
        <td><?= htmlspecialchars($c['concert_name']) ?></td> <!-- Nama konser -->
        <td><?= $c['date'] ?></td> <!-- Tanggal konser -->
        <td><?= htmlspecialchars($c['venue']) ?></td> <!-- Tempat konser -->
        <td class="table-actions">
            <a href="?page=concerts&edit=<?= $c['id_concert'] ?>" class="btn btn-warning">Edit</a> <!-- Tombol edit -->
            <a href="?page=concerts&delete=<?= $c['id_concert'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a> <!-- Tombol hapus -->
        </td>
    </tr>
    <?php endforeach; ?>
</table>
