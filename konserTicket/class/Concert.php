<?php
require_once 'config/db.php'; // Import file koneksi database

class Concert {
    private $db; // Properti untuk menyimpan koneksi database

    public function __construct() {
        $this->db = (new Database())->conn; // Membuat koneksi baru menggunakan class Database
    }

    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM concert"); // Query ambil semua data concert
        $stmt->execute(); // Jalankan query
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Ambil semua hasil dalam array asosiatif
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM concert WHERE id_concert = ?"); // Query ambil data berdasarkan ID
        $stmt->execute([$id]); // Eksekusi query dengan parameter ID
        return $stmt->fetch(PDO::FETCH_ASSOC); // Ambil satu hasil data
    }

    public function store($name, $date, $venue) {
        $stmt = $this->db->prepare(
            "INSERT INTO concert (concert_name, date, venue) VALUES (?, ?, ?)"
        ); // Query untuk menambah data baru concert
        return $stmt->execute([$name, $date, $venue]); // Jalankan query dengan data input
    }

    public function update($id, $name, $date, $venue) {
        $stmt = $this->db->prepare(
            "UPDATE concert SET concert_name = ?, date = ?, venue = ? WHERE id_concert = ?"
        ); // Query update data concert berdasarkan ID
        return $stmt->execute([$name, $date, $venue, $id]); // Jalankan query dengan parameter input
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM concert WHERE id_concert = ?"); // Query hapus concert berdasarkan ID
        return $stmt->execute([$id]); // Jalankan query hapus data
    }
}
?>
