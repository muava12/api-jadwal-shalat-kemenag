<?php

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;

const BASE_URI_KEMENAG = 'https://bimasislam.kemenag.go.id/';

if (! function_exists('getCookies')) {
    function getCookies(): CookieJar
    {
        $cookieJar = new CookieJar();

        $client = new Client([
            'base_uri' => BASE_URI_KEMENAG,
            'cookies' => $cookieJar
        ]);

        $client->get('jadwalshalat');

        return $cookieJar;
    }
}