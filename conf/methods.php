<?php
//http://stackoverflow.com/questions/19902952/currency-converter-api
function convertCurrency($amount, $from, $to){
    if ($from === $to) {
        return ceil($amount);
    }
    $url  = "https://www.google.com/finance/converter?a=$amount&from=$from&to=$to";
    $data = file_get_contents($url);
    preg_match("/<span class=bld>(.*)<\/span>/",$data, $converted);
    $converted = preg_replace("/[^0-9.]/", "", $converted[1]);
    return ceil(round($converted, 3));
}

?>
