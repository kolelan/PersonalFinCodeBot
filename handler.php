<?php

use App\FinCodeHandler;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Configuration;

require 'vendor/autoload.php';

set_time_limit(0);

$config = new Configuration(
    clientTimeout: 5,
//    botName: 'PersonalFinCodeBot'
);
$bot = new Nutgram('ENTER_THE_TOKEN_CODE_HERE',$config);

$bot->onText('/code {date}', function(Nutgram $bot, string $date) {
    $code = FinCodeHandler::getPersonalCode($date);
    $antiCode = FinCodeHandler::getAntiCode($code);
    $message = "Для дня: {$date}\n";
    $message .= "Персональный код: {$code}\n";
    $message .= "Антикод: {$antiCode}";
    $bot->sendMessage($message);
});
//
$bot->run();