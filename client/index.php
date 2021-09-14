<?php

header ("Access-Control-Allow-Origin: *");
header ("Access-Control-Expose-Headers: Content-Length, X-JSON");
header ("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
header ("Access-Control-Allow-Headers: *");
$path=$_SERVER["https://finanzas-aantik.azurewebsites.net/process_payment/process_payment.php"];
switch($path){
        case '':
        case '/':
            require __DIR__ . '/../../client/index.html';
            break;

        case 'https://finanzas-aantik.azurewebsites.net/process_payment/process_payment.php':
                // SDK de Mercado Pago
            require __DIR__.'/vendor/autoload.php';
            // Agrega credenciales
            MercadoPago\SDK::setAccessToken('TEST-111982131632702-091404-62e51f2adb7306be04a212c0faf5fef7-812478843');
            $payment = new MercadoPago\Payment();
            $payment->transaction_amount = (float)$_POST['transactionAmount'];
            $payment->token = $_POST['token'];
            $payment->description = $_POST['description'];
            $payment->installments = (int)$_POST['installments'];
            $payment->payment_method_id = $_POST['paymentMethodId'];
            $payment->issuer_id = (int)$_POST['issuer'];
            
            $payer = new MercadoPago\Payer();
            $payer->email = $_POST['email'];
            $payer->identification = array(
                "number" => $_POST['docNumber']
            );
            $payment->payer = $payer;
            
            $payment->save();
            
            $response = array(
                'status' => $payment->status,
                'status_detail' => $payment->status_detail,
                'id' => $payment->id
            );
            echo json_encode($response);
            break;
            
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    // SDK MercadoPago.js V2
<script src="https://sdk.mercadopago.com/js/v2"></script>
<div class="cho-container">

</div>
<script>
    // Agrega credenciales de SDK
      const mp = new MercadoPago('TEST-54364220-5cfd-459a-8038-55a683ecbcaa', {
            locale: 'es-AR'
      });
    
      // Inicializa el checkout
      mp.checkout({
          preference: {
              id: '{{$preference->id}}'
          },
          render: {
                container: '.cho-container', // Indica el nombre de la clase donde se mostrará el botón de pago
                label: 'Pagar', // Cambia el texto del botón de pago (opcional)
          }
    });
    </script>
</body>
</html>