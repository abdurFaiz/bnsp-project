
1. **Clone Repository**

    ```bash
    git clone https://github.com/abdurFaiz/bnsp-project.git
    cd invest-system
    ```

2. **Install Dependency**

    ```bash
    composer install
    npm install
    ```

3. **Copy File Environment**

    ```bash
    cp .env.example .env
    ```

4. **Generate Key**

    ```bash
    php artisan key:generate
    ```

5. **Atur Konfigurasi Database**  
   Edit file `.env` dan sesuaikan bagian berikut:

    ```
    DB_DATABASE=nama_database
    DB_USERNAME=username_db
    DB_PASSWORD=password_db
    ```

6. **Migrasi Database**

    ```bash
    php artisan migrate
    ```

7. **Jalankan Server**
    ```bash
    php artisan serve
    npm run dev
    ```
    Akses aplikasi di [http://localhost:8000](http://localhost:8000)

8. Folder Docs berisi = Activity Diagram
---

# Panduan Pengguna - Aplikasi Manajemen Produk

Panduan ini akan membantu Anda memahami cara menggunakan berbagai fitur yang tersedia di dalam aplikasi.

## Daftar Isi
- [Melihat Daftar Produk](#melihat-daftar-produk)
- [Mencari Produk](#mencari-produk)
- [Menambah Produk Baru](#menambah-produk-baru)
- [Mengubah Data Produk](#mengubah-data-produk)
- [Menghapus Produk](#menghapus-produk)
- [Mengekspor Data ke PDF](#mengekspor-data-ke-pdf)
- [Mengekspor Data ke EXCEL(gekspor-data-ke-EXCEL)]
  - [Mengekspor Semua Produk](#mengekspor-semua-produk)
  - [Mengekspor Produk Tertentu](#mengekspor-produk-tertentu)

---

## Melihat Daftar Produk
Saat pertama kali membuka aplikasi, Anda akan melihat halaman utama yang menampilkan semua produk dalam bentuk tabel. Jika jumlah produk melebihi 10, akan muncul navigasi halaman di bagian bawah tabel untuk melihat produk lainnya.

## Mencari Produk
Untuk menemukan produk secara cepat, gunakan fitur pencarian yang terletak di atas tabel.
1. Ketikkan nama produk yang ingin Anda cari di kolom pencarian.
2. Klik tombol **Search**.
3. Tabel akan secara otomatis menampilkan produk yang sesuai dengan pencarian Anda.

## Menambah Produk Baru
1. Klik tombol **Create Product** yang berada di bagian atas halaman.
2. Anda akan diarahkan ke halaman form untuk menambah produk.
3. Isi informasi produk yang diperlukan:
    - **Name**: Nama produk
    - **Price**: Harga produk
    - **Description**: Deskripsi singkat mengenai produk
    - **Stock**: Jumlah stok produk yang tersedia
4. Klik tombol **Save** untuk menyimpan produk baru. Produk tersebut akan langsung muncul di tabel daftar produk.

## Mengubah Data Produk
1. Pada tabel daftar produk, cari produk yang ingin Anda ubah.
2. Klik tombol **Edit** pada baris produk tersebut.
3. Sebuah form akan muncul dengan data produk yang sudah terisi.
4. Ubah data sesuai kebutuhan, lalu klik tombol **Update** untuk menyimpan perubahan.

## Menghapus Produk
1. Pada tabel daftar produk, cari produk yang ingin Anda hapus.
2. Klik tombol **Delete** pada baris produk tersebut.
3. Akan muncul konfirmasi untuk memastikan Anda benar-benar ingin menghapus produk.
4. Setelah dikonfirmasi, produk akan dihapus dari daftar. (Catatan: Produk tidak dihapus permanen dan masih bisa dikembalikan oleh administrator).

## Mengekspor Data ke PDF
Aplikasi ini memungkinkan Anda untuk mengunduh data produk dalam format PDF.

## Mengekspor Data ke PDF
Aplikasi ini memungkinkan Anda untuk mengunduh data produk dalam format excel

### Mengekspor Semua Produk
- Klik tombol **Export PDF** yang terletak di samping tombol **Create Product**.
- Sebuah file PDF yang berisi daftar semua produk akan otomatis terunduh.

### Mengekspor Semua Produk
- Klik tombol **Export excelng terletak di samping tombol **Create Product**.
- Sebuah file PDF yang berisi daftar semua produk akan otomatis terunduh.

### Mengekspor Produk Tertentu
- Pada setiap baris produk di tabel, terdapat tombol **Export PDF**.
- Klik tombol tersebut untuk mengunduh detail dari produk yang bersangkutan dalam format PDF.

---

**Catatan:**
-   Semua fitur utama dapat diakses dari halaman utama aplikasi.
-   Fitur hapus menggunakan *soft delete*, yang berarti data tidak langsung hilang permanen.