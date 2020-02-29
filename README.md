# DumbWays Bootcamp Technical Test
Repo ini merupakan penyelesaian dari soal technical test Batch 15 Kloter 2 pada tanggal 29/02/2020.

## Tech Stacks
- PHP
- MySQL

## Cara Menjalankan Aplikasi
Untuk soal 1-3, aplikasi dapat dieksekusi dengan command:
```
php -f <namafile.php>
php -f 1.php
php -f 2.php
php -f 3.php
```
atau dengan menggunakan [online compiler](https://www.jdoodle.com/php-online-editor/).

---

Untuk soal nomor 4, sql queries dapat dilihat pada file [4.md](4.md), dan CRUD app terdapat pada file [4.php](4.php).

Diperlukan web server dengan php & mysql server untuk menjalankan aplikasi. Database dan tabel serta isinya dapat diimport dari file [4.sql](4.sql).

Setelah database diimport, selanjutnya perlu dilakukan konfigurasi database pada file [4.php](4.php). Isikan `hostname`, `username`, `password`, dan `nama database` yang tepat pada variabel `$config`.

```php
$config = [
  'host' => 'localhost',
  'user' => 'root',
  'pass' => '',
  'db' => 'dw_test'
];
```

Yap selesai, aplikasi sudah bisa dijalankan di browser lokal dengan mengakses uri `/4.php`.

---
Khairul Hidayat
