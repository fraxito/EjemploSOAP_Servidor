<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $cliente = new SoapClient(null, array(
        'location'=>'http://127.0.0.1/EjemploSOAP_Servidor/servicioConsulta.php',
        'uri'=>'urn:webservices',
        'trace'=>1
    ));

    echo $cliente -> login(79029722, 1234) . '<br>';
    echo $cliente -> login(87297527, 1234) . '<br>';
    echo $cliente -> login(57912380, 1234) . '<br>';
    ?>
</body>
</html>