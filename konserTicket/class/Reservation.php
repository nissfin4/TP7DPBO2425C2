<?php
require_once 'config/db.php'; // Import file koneksi database

class Reservation {
    private $db; // Properti untuk koneksi database

    public function __construct() {
        $this->db = (new Database())->conn; // Membuat koneksi baru saat class dipanggil
    }

    public function getAll() {
        $sql = "SELECT r.*, t.category_name, c.concert_name
                FROM reservation r
                JOIN ticket_category t ON r.id_ticket_category = t.id_ticket_category
                JOIN concert c ON t.id_concert = c.id_concert"; // Query join 3 tabel
        $stmt = $this->db->prepare($sql); // Siapkan query (prepared statement)
        $stmt->execute(); // Jalankan query
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Ambil semua hasil dalam bentuk array asosiatif
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM reservation WHERE id_reservation = ?"); // Query ambil berdasarkan ID
        $stmt->execute([$id]); // Eksekusi dengan parameter ID
        return $stmt->fetch(PDO::FETCH_ASSOC); // Ambil satu data hasil
    }

    public function store($ticket, $customer, $qty) {
        $stmt = $this->db->prepare(
            "INSERT INTO reservation (id_ticket_category, customer_name, qty) VALUES (?, ?, ?)"
        ); // Query tambah data baru
        return $stmt->execute([$ticket, $customer, $qty]); // Jalankan query dengan data input user
    }

    public function update($id, $ticket, $customer, $qty) {
        $stmt = $this->db->prepare(
            "UPDATE reservation SET id_ticket_category = ?, customer_name = ?, qty = ? WHERE id_reservation = ?"
        ); // Query update data
        return $stmt->execute([$ticket, $customer, $qty, $id]); // Jalankan query update
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM reservation WHERE id_reservation = ?"); // Query hapus data berdasarkan ID
        return $stmt->execute([$id]); // Eksekusi hapus data
    }
}
?>
