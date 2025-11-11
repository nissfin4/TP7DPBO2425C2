# TP7DPBO2425C2
Tugas Praktikum 7
Janji: Saya Nisrina Safinatunnajah dengan NIM 2410093 mengerjakan Tugas Praktikum 7 dalam mata kuliah DPBO untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

Website ini merupakan aplikasi manajemen tiket konser. Tujuan dari website ini adalah untuk membantu admin dalam mengelola data konser, kategori tiket, serta reservasi pelanggan.

Pada halaman Ticket Categories, admin dapat menambahkan kategori tiket untuk setiap konser yang tersedia. Setiap kategori tiket memiliki atribut seperti nama kategori, harga tiket, dan jumlah kuota tiket. selain itu bisa melakukan pembaruan data kategori atau menghapusnya jika diperlukan. Setiap kategori tiket terhubung dengan tabel konser melalui kolom id_concert.

Bagian terakhir adalah halaman Reservations, yang digunakan untuk mencatat pemesanan tiket oleh pelanggan. Admin dapat memilih konser dan kategori tiket yang diinginkan pelanggan, lalu memasukkan nama pelanggan dan jumlah tiket yang dipesan. Semua data reservasi ditampilkan dalam bentuk tabel yang memuat informasi nama pelanggan, konser, kategori tiket, dan jumlah tiket yang dipesan.

ini menggunakan tiga tabel utama:
1. concerts untuk menyimpan data konser (id_concert, concert_name, date, venue).
2. ticket_categories untuk menyimpan kategori tiket untuk setiap konser (id_ticket_category, id_concert, category_name, price, quota).
3. reservations untuk menyimpan data pemesanan (id_reservation, id_concert, id_ticket_category, customer_name, quantity).

Setiap tabel memiliki relasi yang saling terhubung: tabel ticket_categories berelasi dengan concerts melalui id_concert, sedangkan tabel reservations berelasi dengan keduanya (id_concert dan id_ticket_category). Semua entitas memiliki operasi CRUD.

Flow code ini dimulai dari file utama index.php yang berfungsi sebagai pusat navigasi dan pengatur alur halaman. Saat admin membuka website, file ini membaca parameter untuk menentukan halaman mana yang akan dimuat, seperti halaman konser, kategori tiket, atau reservasi. Berdasarkan parameter tersebut, file tampilan yang sesuai dari folder view akan dipanggil. Di setiap halaman, terdapat form untuk menambah atau mengedit data serta tabel yang menampilkan seluruh data dari database. Ketika admin mengirim data melalui form, sistem akan memproses input tersebut menggunakan metode POST atau GET dan kemudian memanggil fungsi yang sesuai dari class OOP yang ada di folder class. Class Concert.php mengatur logika untuk data konser, TicketCategory.php untuk kategori tiket, dan Reservation.php untuk data pemesanan.


dokumentasi video:
[![dokumentasi](https://img.youtube.com/vi/xUdXornjBsw/0.jpg)](https://youtu.be/xUdXornjBsw)
ERD:
![ERD](dokumentasi/dokumentasiFoto.jpg)
