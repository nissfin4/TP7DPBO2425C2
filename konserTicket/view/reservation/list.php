<?php
// Ambil semua data reservasi dari database
$data = $reservation->getAll();

// Jika parameter 'del' ada di URL (artinya user klik tombol Delete)
if (isset($_GET["del"])) {
    // Hapus data reservasi berdasarkan id_reservation
    $reservation->delete($_GET["del"]);

    // Setelah delete, reload halaman list agar data terbaru tampil
    header("Location: index.php?page=reservation&action=list");
}
?>

<div class="action-buttons">
    <!-- Tombol untuk menuju halaman tambah reservasi -->
    <a href="?page=reservation&action=add" class="btn btn-success">+ Add Reservation</a>
</div>

<!-- Tabel untuk menampilkan seluruh data reservasi -->
<table>
<thead>
    <tr>
        <th>Customer</th>   <!-- Nama pelanggan -->
        <th>Concert</th>    <!-- Nama konser -->
        <th>Category</th>   <!-- Kategori tiket -->
        <th>Qty</th>        <!-- Jumlah tiket -->
        <th>Action</th>     <!-- Tombol aksi (edit/delete) -->
    </tr>
</thead>
<tbody>
<?php foreach ($data as $row): ?> <!-- Loop setiap data reservasi -->
<tr>
    <td><?= $row['customer_name'] ?></td>   <!-- Tampilkan nama pelanggan -->
    <td><?= $row['concert_name'] ?></td>    <!-- Tampilkan nama konser -->
    <td><?= $row['category_name'] ?></td>   <!-- Tampilkan kategori tiket -->
    <td><?= $row['qty'] ?></td>             <!-- Tampilkan jumlah tiket -->

    <td class="table-actions">
        <!-- Tombol Edit: buka halaman edit berdasarkan id reservasi -->
        <a href="?page=reservation&action=edit&id=<?= $row['id_reservation'] ?>" class="btn btn-warning">Edit</a>

        <!-- Tombol Delete: hapus data berdasarkan id reservasi -->
        <a href="?page=reservation&del=<?= $row['id_reservation'] ?>" class="btn btn-danger">Delete</a>
    </td>
</tr>
<?php endforeach ?> <!-- Akhir loop -->
</tbody>
</table>
