<?php


require __DIR__.'/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

if(!isset($_ENV['DEFAULT_REDIRECT'])) {
    exit('Required DEFAULT_REDIRECT not set in .env');
}

if(isset($_SERVER['HTTP_HOST'])) {
    $host = str_replace(['-', '/'], '_', strtoupper($_SERVER['HTTP_HOST']));
    $uri = str_replace(['-', '/'], '_', strtoupper(strtok($_SERVER["REQUEST_URI"], '?')));

    $redirect = $_ENV['DEFAULT_REDIRECT'].$_SERVER["REQUEST_URI"];
    if($uri === '_') {
        if(isset($_ENV[$host])) {
            $redirect = $_ENV[$host];
        }
    } else {
        if(isset($_ENV[$host.$uri])) {
            $redirect = $_ENV[$host.$uri];
        }
    }

    preg_match_all('/{(.*)}/m', $redirect, $redirectParts, PREG_SET_ORDER, 0);

    $redirectType = 302;
    if(isset($redirectParts[0], $redirectParts[0][1])) {
        $redirectUrl = str_replace($redirectParts[0][0], '', $redirect);
        $redirectType = (int)$redirectParts[0][1];
    } else {
        $redirectUrl = $redirect;
    }

    redirect($redirectUrl, $redirectType);
}


function redirect(string $url, int $type) : void
{
    if(isset($_GET['redirector_debug'])) {
        exit('Redirect '.$type.' to: '. $url);
    }
    header("Location: ".$url, true, $type);
    die();
}
