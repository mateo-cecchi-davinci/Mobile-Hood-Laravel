<?php

namespace App\Services;

use App\Exceptions\MercadoPagoException;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;

class MercadoPagoService
{

    public function __construct()
    {
        MercadoPagoConfig::setAccessToken(config('mercadopago.access_token'));
    }

    public function createPreference($data)
    {
        $client = new PreferenceClient();

        $items = array_map(function ($productData) {
            return [
                "id" => $productData['product']['id'],
                "title" => $productData['product']['model'],
                "quantity" => (int)$productData['quantity'],
                "unit_price" => $productData['product']['price'],
            ];
        }, $data['product_data']);

        try {
            $preference = $client->create([
                "external_reference" => uniqid(),
                "items" => $items,
                "back_urls" => [
                    "success" => "http://127.0.0.1:8000",
                    "failure" => "https://www.failure.com",
                    "pending" => "https://www.pending.com"
                ],
                "payer" => [
                    "name" => $data['user']->email,
                ],
                "metadata" => [
                    "business" => $data['business'],
                ],
                "auto_return" => "approved",
                "notification_url" => "https://8433-186-138-51-114.ngrok-free.app/mp_payment_notification",
            ]);
        } catch (MPApiException $MPApiException) {
            throw new MercadoPagoException($MPApiException->getMessage(), $MPApiException->getStatusCode());
        }

        return $preference;
    }
}
