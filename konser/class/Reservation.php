<?php
require_once 'config/db.php'; // Import koneksi database

class Reservation { // Class untuk mengelola data reservasi
    private $db; 

    public function __construct() { // Konstruktor buat nyambung ke database
        $this->db = (new Database())->conn;
    }

    public function getAllReservations() { // Ambil semua data reservasi,relasi konser dan tiket
        $stmt = $this->db->prepare("
            SELECT r.*, t.category_name, c.concert_name
            FROM reservations r
            JOIN ticket_categories t ON r.id_ticket_category = t.id_ticket_category
            JOIN concerts c ON r.id_concert = c.id_concert
            ORDER BY r.id_reservation DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addReservation($id_concert, $id_ticket_category, $customer_name, $quantity) { // Tambah reservasi baru
        $stmt = $this->db->prepare("
            INSERT INTO reservations (id_concert, id_ticket_category, customer_name, quantity)
            VALUES (?, ?, ?, ?)
        ");
        return $stmt->execute([$id_concert, $id_ticket_category, $customer_name, $quantity]);
    }

    public function getReservationById($id) { // Ambil data reservasi berdasarkan ID
        $stmt = $this->db->prepare("SELECT * FROM reservations WHERE id_reservation = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateReservation($id, $id_concert, $id_ticket_category, $customer_name, $quantity) { // Update data reservasi
        $stmt = $this->db->prepare("
            UPDATE reservations
            SET id_concert = ?, id_ticket_category = ?, customer_name = ?, quantity = ?
            WHERE id_reservation = ?
        ");
        return $stmt->execute([$id_concert, $id_ticket_category, $customer_name, $quantity, $id]);
    }

    public function deleteReservation($id) { // Hapus data reservasi
        $stmt = $this->db->prepare("DELETE FROM reservations WHERE id_reservation = ?");
        return $stmt->execute([$id]);
    }
}
?> 
