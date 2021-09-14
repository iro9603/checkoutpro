<?php
// SDK de Mercado Pago
require __DIR__. '/vendor/autoload.php';
// Agrega credenciales
MercadoPago\SDK::setAccessToken('TEST-11762472748563-081923-f6c1d5d1d637d865580d438da9d492c8-448109497');
// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();

// Crea un ítem en la preferencia
$item = new MercadoPago\Item();
$item->title = 'Mi producto';
$item->quantity = 1;
$item->unit_price = 75.56;
$preference->items = array($item);
$preference->save();

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
      const mp = new MercadoPago('TEST-624513d5-0f84-4d48-9e89-6fc2479b9a84', {
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