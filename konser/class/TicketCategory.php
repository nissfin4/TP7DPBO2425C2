<?php
require_once 'config/db.php'; 

class TicketCategory { // Class untuk mengelola kategori tiket
    private $db; 

    public function __construct() { // Konstruktor buat nyambung ke database
        $this->db = (new Database())->conn;
    }

    public function getAllTicketCategories() { // Ambil semua kategori tiket dannama konser
        $stmt = $this->db->prepare("
            SELECT t.*, c.concert_name 
            FROM ticket_categories t
            JOIN concerts c ON t.id_concert = c.id_concert
        ");
        $stmt->execute(); // Jalankan query
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Kembalikan hasil dalam array
    }

    public function getTicketCategoryById($id) { // ambil kategori tiket berdasarkan ID
        $stmt = $this->db->prepare("SELECT * FROM ticket_categories WHERE id_ticket_category = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addTicketCategory($id_concert, $category_name, $price, $quota) { //tambah kategori tiket baru
        $stmt = $this->db->prepare("
            INSERT INTO ticket_categories (id_concert, category_name, price, quota)
            VALUES (?, ?, ?, ?)
        ");
        return $stmt->execute([$id_concert, $category_name, $price, $quota]);
    }

    public function updateTicketCategory($id, $id_concert, $category_name, $price, $quota) { // Update kategori tiket
        $stmt = $this->db->prepare("
            UPDATE ticket_categories 
            SET id_concert = ?, category_name = ?, price = ?, quota = ?
            WHERE id_ticket_category = ?
        ");
        return $stmt->execute([$id_concert, $category_name, $price, $quota, $id]);
    }

    public function deleteTicketCategory($id) { // Hapus kategori tiket berdasarkan ID
        $stmt = $this->db->prepare("DELETE FROM ticket_categories WHERE id_ticket_category = ?");
        return $stmt->execute([$id]);
    }
}
?> 
