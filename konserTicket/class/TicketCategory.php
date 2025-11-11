<?php
require_once 'config/db.php'; // Import file koneksi database

class TicketCategory {
    private $db; // Properti untuk menyimpan koneksi database

    public function __construct() {
        $this->db = (new Database())->conn; // Membuat koneksi baru saat class dipanggil
    }

    public function getAll() {
        $sql = "SELECT t.*, c.concert_name 
                FROM ticket_category t 
                JOIN concert c ON t.id_concert = c.id_concert"; // Query join ticket & concert
        $stmt = $this->db->prepare($sql); // Siapkan query
        $stmt->execute(); // Jalankan query
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Ambil semua hasil dalam array asosiatif
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM ticket_category WHERE id_ticket_category = ?"); // Query berdasarkan ID
        $stmt->execute([$id]); // Eksekusi dengan parameter ID
        return $stmt->fetch(PDO::FETCH_ASSOC); // Ambil satu data hasil
    }

    public function store($concert, $category, $price, $quota) {
        $stmt = $this->db->prepare(
            "INSERT INTO ticket_category (id_concert, category_name, price, quota) VALUES (?, ?, ?, ?)"
        ); // Query tambah data baru
        return $stmt->execute([$concert, $category, $price, $quota]); // Jalankan query dengan data input
    }

    public function update($id, $concert, $category, $price, $quota) {
        $stmt = $this->db->prepare(
            "UPDATE ticket_category SET id_concert = ?, category_name = ?, price = ?, quota = ? WHERE id_ticket_category = ?"
        ); // Query update data
        return $stmt->execute([$concert, $category, $price, $quota, $id]); // Jalankan query update
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM ticket_category WHERE id_ticket_category = ?"); // Query hapus data
        return $stmt->execute([$id]); // Eksekusi hapus berdasarkan ID
    }
}
?>
