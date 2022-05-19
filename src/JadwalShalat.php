<?php

namespace AzizRamdanLab\JadwalShalat;

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class JadwalShalat
{
    public function getProvinsi(): array
    {
        $client = new Client([
            'base_uri' => BASE_URI_KEMENAG
        ]);

        $response = $client->get('/jadwalshalat', [
            'cookies' => getCookies()
        ]);

        $provinsi = [];

        (new Crawler($response->getBody()->getContents()))
            ->filter('#search_prov option')
            ->each(function (Crawler $node) use (&$provinsi) {
                if ($node->text() != 'PUSAT') {
                    $provinsi[] = [
                        'value' => $node->attr('value'),
                        'text' => $node->text(),
                    ];
                }
            });

        return $provinsi;
    }
}
