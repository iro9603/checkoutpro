<?php
// SDK de Mercado Pago
require '.\vendor\autoload.php';
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