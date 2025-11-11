<?php
// Panggil file class yang dibutuhkan
require_once 'class/TicketCategory.php';
require_once 'class/Concert.php';

// Buat objek dari class
$ticket = new TicketCategory();
$concert = new Concert();

// Ambil data awal untuk dropdown dan tabel
$concerts = $concert->getAllConcerts();
$tickets = $ticket->getAllTicketCategories();

// Tambah kategori tiket baru
if (isset($_POST['add'])) {
    $ticket->addTicketCategory(
        $_POST['id_concert'], 
        $_POST['category_name'], 
        $_POST['price'], 
        $_POST['quota']
    );
    header("Location: ?page=tickets");
    exit;
}

// Update kategori tiket
if (isset($_POST['update'])) {
    $ticket->updateTicketCategory(
        $_POST['id_ticket_category'], 
        $_POST['id_concert'], 
        $_POST['category_name'], 
        $_POST['price'], 
        $_POST['quota']
    );
    header("Location: ?page=tickets");
    exit;
}

// Hapus kategori tiket
if (isset($_GET['delete'])) {
    $ticket->deleteTicketCategory($_GET['delete']);
    header("Location: ?page=tickets");
    exit;
}

// Ambil data kategori tiket untuk form edit
$editData = null;
if (isset($_GET['edit'])) {
    $editData = $ticket->getTicketCategoryById($_GET['edit']);
}
?>

<h3>Ticket Category List</h3>

<!-- Form tambah atau edit kategori tiket -->
<form method="POST">
    <h3><?= $editData ? "Edit Ticket Category" : "Add Ticket Category" ?></h3>

    <input type="hidden" name="id_ticket_category" value="<?= $editData['id_ticket_category'] ?? '' ?>">

    <label>Concert:</label>
    <select name="id_concert" required>
        <option value="">-- Select Concert --</option>
        <?php foreach ($concerts as $c): ?>
            <option value="<?= $c['id_concert'] ?>" <?= isset($editData['id_concert']) && $editData['id_concert'] == $c['id_concert'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($c['concert_name']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Category Name:</label>
    <input type="text" name="category_name" value="<?= htmlspecialchars($editData['category_name'] ?? '') ?>" required>

    <label>Price:</label>
    <input type="number" name="price" min="0" step="0.01" value="<?= htmlspecialchars($editData['price'] ?? '') ?>" required>

    <label>Quota:</label>
    <input type="number" name="quota" min="1" value="<?= htmlspecialchars($editData['quota'] ?? '') ?>" required>

    <!-- Tombol aksi sesuai mode -->
    <?php if ($editData): ?>
        <button type="submit" name="update">Update Category</button>
        <a href="?page=tickets" class="btn btn-danger">Cancel</a>
    <?php else: ?>
        <button type="submit" name="add">Add Category</button>
    <?php endif; ?>
</form>

<!-- Tabel daftar kategori tiket -->
<table border="1">
    <tr>
        <th>ID</th>
        <th>Concert</th>
        <th>Category</th>
        <th>Price</th>
        <th>Quota</th>
        <th>Action</th>
    </tr>

    <?php foreach ($tickets as $t): ?>
    <tr>
        <td><?= $t['id_ticket_category'] ?></td>
        <td><?= htmlspecialchars($t['concert_name']) ?></td>
        <td><?= htmlspecialchars($t['category_name']) ?></td>
        <td>Rp <?= number_format($t['price'], 0, ',', '.') ?></td>
        <td><?= $t['quota'] ?></td>
        <td class="table-actions">
            <a href="?page=tickets&edit=<?= $t['id_ticket_category'] ?>" class="btn btn-warning">Edit</a>
            <a href="?page=tickets&delete=<?= $t['id_ticket_category'] ?>" class="btn btn-danger" onclick="return confirm('Delete this category?')">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
