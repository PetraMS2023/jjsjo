<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;

class CurrencyController extends Controller {
  public function showCurrencies() {
    $client = new Client();
    $response = $client->request('GET', 'http://3.72.223.178:2406/api/Currencies/GetCur');
    $body = $response->getBody();
    $data = json_decode($body, true); // Decoding JSON to associative array

    // Assuming the 'content' key contains the currencies data
    $currencies = $data['content'] ?? []; // Safety check if 'content' doesn't exist

    return view('currencies', compact('currencies'));
  }
}
