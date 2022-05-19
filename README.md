# API Jadwal Shalat Kemenag
Data jadwal shalat diambil dari situs kemenag https://bimasislam.kemenag.go.id/jadwalshalat

# Instalasi
```bash
composer require azizramdan-lab/jadwal-shalat
```

# Penggunaan
```php
<?php
// Autoload
require_once 'vendor/autoload.php';

// Import class JadwalShalat
use AzizRamdanLab\JadwalShalat\JadwalShalat;

// Instansiasi class JadwalShalat
$jadwalShalat = new JadwalShalat;

// Untuk mendapatkan daftar provinsi, gunakan method getProvinsi()
$provinsi = $jadwalShalat->getProvinsi();

// Untuk mendapatkan daftar kabupaten/kota, gunakan method getKabupatenKota()
// dengan parameter id provinsi
$kabkot = $jadwalShalat->getKabupatenKota('EO6iWQIGAJz%2BdTdDISh9DroWDN7aEy8IzRCRwmDEgmpP5vfnNUaOA5gvNi9opOIf7fvCxJEOuYPoZb4LDFb%2FfA%3D%3D');

// Catatan:
// id provinsi dan id kabupaten/kota akan selalu berubah dan expired,

// Untuk mendapatkan data jadwal shalat dalam 1 bulan, gunakan method getJadwalShalat()
// dengan parameter id provinsi, id kabupaten/kota, bulan, dan tahun
$jadwal = $jadwalShalat->getJadwalShalat('EO6iWQIGAJz%2BdTdDISh9DroWDN7aEy8IzRCRwmDEgmpP5vfnNUaOA5gvNi9opOIf7fvCxJEOuYPoZb4LDFb%2FfA%3D%3D', 'hiXdUObhOxCwZltIzJP%2Fok10gA%2FWv6AyHyjV4Kv9fUFQHj8l%2Bfg6l0VlkC%2FB6%2BvlSSJ3Qbq0sC%2FE4YC8RMerGQ%3D%3D', 1, 2022);

```
