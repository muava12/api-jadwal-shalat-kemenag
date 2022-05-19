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

    public function getKabupatenKota(string $provinsiId): array
    {
        $client = new Client([
            'base_uri' => BASE_URI_KEMENAG
        ]);

        $response = $client->post('/ajax/getKabkoshalat', [
            'cookies' => getCookies(),
            'form_params' => [
                'x' => $provinsiId
            ]
        ]);

        $kabkot = [];

        (new Crawler($response->getBody()->getContents()))
            ->filter('option')
            ->each(function (Crawler $node) use (&$kabkot) {
                $kabkot[] = [
                    'value' => $node->attr('value'),
                    'text' => $node->text(),
                ];
            });

        return $kabkot;
    }

    public function getJadwalShalat(string $provinsiId, string $kabkotId, int $bulan, int $tahun): array
    {
        $client = new Client([
            'base_uri' => BASE_URI_KEMENAG
        ]);

        $response = $client->post('/ajax/getShalatbln', [
            'cookies' => getCookies(),
            'form_params' => [
                'x' => $provinsiId,
                'y' => $kabkotId,
                'bln' => $bulan,
                'thn' => $tahun,
            ]
        ]);
        
        return json_decode($response->getBody()->getContents(), true);
    }
}
