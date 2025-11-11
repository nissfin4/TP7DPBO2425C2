<?php
// Ambil semua data kategori tiket (join dengan data konser)
$data = $ticket->getAll();

// Jika ada parameter "del" di URL, artinya user ingin menghapus data
if (isset($_GET["del"])) {
    $ticket->delete($_GET["del"]); // Hapus tiket berdasarkan ID
    header("Location: index.php?page=ticket&action=list"); // Refresh halaman setelah hapus
}
?>

<!-- Tombol untuk menuju halaman tambah kategori tiket -->
<div class="action-buttons">
    <a href="?page=ticket&action=add" class="btn btn-success">+ Add Ticket Category</a>
</div>

<!-- Tabel daftar kategori tiket -->
<table>
<thead>
    <tr>
        <th>Concert</th>   <!-- Nama konser -->
        <th>Category</th>  <!-- Nama kategori tiket -->
        <th>Price</th>     <!-- Harga tiket -->
        <th>Quota</th>     <!-- Kuota tiket -->
        <th>Action</th>    <!-- Tombol aksi edit & delete -->
    </tr>
</thead>

<tbody>
<?php foreach ($data as $row): ?> <!-- Loop setiap data tiket -->
<tr>
    <td><?= $row['concert_name'] ?></td>  <!-- Tampilkan nama konser -->
    <td><?= $row['category_name'] ?></td> <!-- Tampilkan kategori -->
    <td><?= $row['price'] ?></td>         <!-- Tampilkan harga -->
    <td><?= $row['quota'] ?></td>         <!-- Tampilkan kuota -->

    <!-- Tombol aksi edit dan delete -->
    <td class="table-actions">
        <a href="?page=ticket&action=edit&id=<?= $row['id_ticket_category'] ?>" 
           class="btn btn-warning">Edit</a> <!-- Arahkan ke halaman edit -->

        <a href="?page=ticket&del=<?= $row['id_ticket_category'] ?>" 
           class="btn btn-danger">Delete</a> <!-- Hapus data tiket -->
    </td>
</tr>
<?php endforeach ?>
</tbody>
</table>
