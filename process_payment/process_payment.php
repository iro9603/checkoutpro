
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
            MercadoPago\SDK::setAccessToken('TEST-8901633554153246-091404-3076fccec30c2a1db9e6e04c23dd416c-812487226');
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
