<?php

namespace AzizRamdanLab\JadwalShalat\Test;

use AzizRamdanLab\JadwalShalat\JadwalShalat;
use PHPUnit\Framework\TestCase;

class JadwalShalatTest extends TestCase
{
    public function testGetProvinsi()
    {
        $provinsi = (new JadwalShalat)->getProvinsi();

        $this->assertIsArray($provinsi);
        $this->assertNotEmpty($provinsi);
        $this->assertArrayHasKey('value', $provinsi[0]);
        $this->assertArrayHasKey('text', $provinsi[0]);
    }

    public function testGetKabupatenKota()
    {
        $jadwalShalat = new JadwalShalat;
        $provinsi = $jadwalShalat->getProvinsi();
        $kabkot = $jadwalShalat->getKabupatenKota($provinsi[0]['value']);

        $this->assertIsArray($kabkot);
        $this->assertNotEmpty($kabkot);
        $this->assertTrue(count($kabkot) > 2);
        $this->assertArrayHasKey('value', $kabkot[0]);
        $this->assertArrayHasKey('text', $kabkot[0]);
    }

    public function testGetKabupatenKotaWithWrongProvinsi()
    {
        $kabkot = (new JadwalShalat)->getKabupatenKota('foo');

        $this->assertIsArray($kabkot);
        $this->assertNotEmpty($kabkot);
        $this->assertTrue(count($kabkot) == 2); // default akan mengambil DKI Jakarta
        $this->assertArrayHasKey('value', $kabkot[0]);
        $this->assertArrayHasKey('text', $kabkot[0]);
    }

    public function testGetJadwalShalat()
    {
        $jadwalShalat = new JadwalShalat;
        $provinsi = $jadwalShalat->getProvinsi();
        $kabkot = $jadwalShalat->getKabupatenKota($provinsi[0]['value']);
        $jadwal = $jadwalShalat->getJadwalShalat($provinsi[0]['value'], $kabkot[0]['value'], 1, 2022);

        $this->assertIsArray($jadwal);
        $this->assertNotEmpty($jadwal);
        $this->assertEquals(1, $jadwal['status']);
        $this->assertIsArray($jadwal['data']);
        $this->assertNotEmpty($jadwal['data']);
    }

    public function testGetJadwalShalatWithWrongProvinsiKabkot()
    {
        $jadwal = (new JadwalShalat)->getJadwalShalat('foo', 'bar', 1, 2022);

        $this->assertIsArray($jadwal);
        $this->assertNotEmpty($jadwal);
        $this->assertEquals(0, $jadwal['status']);
        $this->assertIsArray($jadwal['data']);
        $this->assertEmpty($jadwal['data']);
    }
}
