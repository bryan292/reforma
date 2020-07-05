<?php
//The url you wish to send the POST request to
$url = 'https://www.soportecrfd.com/wp-admin/admin-ajax.php';
$banc = 1;




while (true) {
    $pass = bin2hex(openssl_random_pseudo_bytes(10));
    $user = bin2hex(openssl_random_pseudo_bytes(10));

    //The data you want to send via POST
    $fields = [
        'action'      => 'ajax_busqueda',
        'usuario'       => $user,
        'clave'         => $pass,
        'banco'         => $banc,
        'id'             => '0',
        'guardar_usuario' => 1
    ];

    //url-ify the data for the POST
    $fields_string = http_build_query($fields);

    //open connection
    $ch = curl_init();


    //set the url, number of POST vars, POST data
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);

    //So that curl_exec returns the contents of the cURL; rather than echoing it
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //execute post
    $result = curl_exec($ch);
    echo $result;

    var_dump($fields);
    $banc += 1;

    if ($banc > 15) {
        $banc = 1;
    }
}
