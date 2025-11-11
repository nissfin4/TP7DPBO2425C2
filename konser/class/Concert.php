<?php
require_once 'config/db.php'; 

class Concert { // Membuat class bernama Concert
    private $db; //untuk menyimpan koneksi database

    public function __construct() {
        $this->db = (new Database())->conn; 
    }

    // Fungsi untuk mengambil semua data konser dari tabel concerts
    public function getAllConcerts() {
        $stmt = $this->db->prepare("SELECT * FROM concerts"); // Siapkan query ambil semua data konser
        $stmt->execute(); // Jalankan query
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    // Fungsi untuk menambahkan data konser baru ke database
    public function createConcert($concert_name, $date, $venue) {
        $stmt = $this->db->prepare(" 
            INSERT INTO concerts (concert_name, date, venue)
            VALUES (?, ?, ?)
        ");
        return $stmt->execute([$concert_name, $date, $venue]); // Jalankan query dengan data yang dikirim
    }

    // Fungsi untuk mengambil satu data konser berdasarkan ID konser
    public function getConcertById($id) {
        $stmt = $this->db->prepare("SELECT * FROM concerts WHERE id_concert = ?"); // Query ambil data by ID
        $stmt->execute([$id]); // Jalankan query
        return $stmt->fetch(PDO::FETCH_ASSOC); // Kembalikan satu baris data konser
    }

    // Fungsi untuk memperbarui data konser berdasarkan ID
    public function updateConcert($id, $concert_name, $date, $venue) {
        $stmt = $this->db->prepare(" 
            UPDATE concerts
            SET concert_name = ?, date = ?, venue = ?
            WHERE id_concert = ?
        ");
        return $stmt->execute([$concert_name, $date, $venue, $id]); // Jalankan query update
    }

    // Fungsi untuk menghapus konser berdasarkan ID konser
    public function deleteConcert($id) {
        $stmt = $this->db->prepare("DELETE FROM concerts WHERE id_concert = ?"); // Siapkan query delete
        return $stmt->execute([$id]); // Jalankan query hapus
    }
}
?>
