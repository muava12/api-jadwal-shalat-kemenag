<?php

namespace AzizRamdanLab\JadwalShalat\Test;

use GuzzleHttp\Cookie\CookieJar;
use PHPUnit\Framework\TestCase;

class HelperTest extends TestCase
{
    public function testGetCookies()
    {
        $cookies = getCookies();

        $this->assertSame(CookieJar::class, get_class($cookies));
    }
}
