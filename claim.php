<?php
error_reporting(0);
define("API", "https://api.dw1.website");

function call($data, $endpoint) {
    $context = stream_context_create(array(
        "http" => array(
            "method" => "POST",
            "header" => implode("\r\n", array(
                "User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10; rv:33.0) Gecko/20100101 Firefox/33.0",
                "Content-Type: application/x-www-form-urlencoded; charset=UTF-8",
                "Origin: " . API,

            )),
            "content" => $data,
        ),
    ));

    $response = file_get_contents(API . $endpoint, false, $context);

    if (strpos($http_response_header[0], "200") == true) {
        return $response;
    } else {
        exit("Something wrong, but Idk why.\n");
    }
}

$CY="\e[36m"; $GR="\e[2;32m"; $OG="\e[92m"; $WH="\e[37m"; $RD="\e[31m"; $YL="\e[33m"; $BF="\e[34m"; $DF="\e[39m"; $OR="\e[33m"; $PP="\e[35m"; $B="\e[1m"; $CC="\e[0m";
echo "Input cookies file (ex; ck.txt): ";
$ckfile = trim(fgets(STDIN));
$cookies = @file_get_contents($ckfile);
if ($cookies == false) exit($time . "No such file!");
while (true) {
    echo "[" . date("H:i:s") . "] Claiming...\n";
    $claim = call("cookies=" . urlencode(base64_encode($cookies)), "/thebestbitcoinfaucet/claim");
    $response = @json_decode($claim, 1);
    if (isset($response['info'])) {
        echo "[" . date("H:i:s") . "] Responses:\n";
        echo $PP . $response['info'] . $CC . "\n";
        if ($response['status'] == 1) {
            echo $GR . "[" . date("H:i:s") . "] Success! " . $response['message'] . $CC . "\n";
        } elseif ($response['status'] == 0) {
            echo $RD . "[" . date("H:i:s") . "] Failed! " . $response['message'] . $CC . "\n";
        }
    } else {
        exit("[" . date("H:i:s") . "] " . $RD . "Invalid cookies!" . $CC);
    }
    echo "[" . date("H:i:s") . "] Sleep for 60sec...\n";
    sleep(60);
}