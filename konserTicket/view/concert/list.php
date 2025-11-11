<?php
// Ambil semua data konser dari database
$data = $concert->getAll();

if (isset($_GET["del"])) { // Jika ada parameter "del" di URL
    // Hapus data konser berdasarkan ID yang dikirim lewat URL
    $concert->delete($_GET["del"]);

    // Setelah dihapus, reload halaman daftar concert
    header("Location: index.php?page=concert&action=list");
}
?>

<div class="action-buttons">
    <!-- Tombol untuk menuju ke halaman tambah concert -->
    <a href="?page=concert&action=add" class="btn btn-success">+ Add Concert</a>
</div>

<table>
    <thead>
        <tr>
            <th>Concert Name</th> <!-- Judul kolom nama konser -->
            <th>Date</th> <!-- Judul kolom tanggal konser -->
            <th>Venue</th> <!-- Judul kolom lokasi konser -->
            <th>Action</th> <!-- Judul kolom aksi (edit / delete) -->
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $row): ?> <!-- Looping untuk menampilkan semua data konser -->
        <tr>
            <td><?= $row['concert_name'] ?></td> <!-- Tampilkan nama konser -->
            <td><?= $row['date'] ?></td><!-- Tampilkan tanggal konser -->
            <td><?= $row['venue'] ?></td> <!-- Tampilkan lokasi konser -->
            <td class="table-actions">
                <!-- Tombol edit, kirim ID konser lewat URL -->
                <a href="?page=concert&action=edit&id=<?= $row['id_concert'] ?>" class="btn btn-warning">Edit</a>

                <!-- Tombol delete, kirim ID konser lewat parameter "del" -->
                <a href="?page=concert&del=<?= $row['id_concert'] ?>" class="btn btn-danger">Delete</a>
            </td>
        </tr>
        <?php endforeach ?> <!-- Akhir looping -->
    </tbody>
</table>
