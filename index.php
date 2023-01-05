<?php
use GuzzleHttp\Client;

require_once __DIR__ . '/vendor/autoload.php';

$file = __DIR__ . '/mem.csv';

$uri = 'https://api.sms.net.bd/sendsms';
$apiKey = 'hTm861NpTeL6ucAWJ0iRuEXYu7X96t65mUCf8j7L';
$template = 'জামেআ হাকীমুল উম্মত ঢাকা হতে। প্রিয় সদস্য, আপনার সদস্য নং %s.
আপনার উপস্থিতি একান্তভাবে কাম্য।';

$client = new Client();

$handle = fopen($file, "r");

if ($handle !== false) {
    while (($data = fgetcsv($handle, 6000, ',')) !== false) {
        $client->get($uri, [
            'query' => [
                'api_key' => $apiKey,
                'msg' => sprintf($template, $data[0]),
                'to' => $data[1],
            ],
        ]);
    }
}
