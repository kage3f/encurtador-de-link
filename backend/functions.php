<?php
function generateRandomKey($length = 6) {
    return substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, $length);
}

function saveUrlMapping($key, $url) {
    $data = json_decode(file_get_contents('url-mappings.json'), true) ?? [];
    $data[$key] = $url;
    file_put_contents('url-mappings.json', json_encode($data));
}
?>
