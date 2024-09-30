<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use GuzzleHttp\Client;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ProcessPayment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $payload;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (isset($this->payload['data']['id'])) {
            $paymentId = $this->payload['data']['id'];

            // Set up the HTTP client
            $client = new Client();

            // Define the API endpoint
            $url = "https://api.mercadopago.com/v1/payments/{$paymentId}";

            try {
                // Send the GET request to the MercadoPago API
                $response = $client->request('GET', $url, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . config('mercadopago.access_token'),
                    ],
                ]);

                $body = $response->getBody()->getContents();

                $data = json_decode($body, true);

                $email = $data['additional_info']['payer']['first_name'];
                $payment = $data['transaction_amount'];
                // $street_name = $data['additional_info']['payer']['address']['street_name'];
                // $street_number = $data['additional_info']['payer']['address']['street_number'];
                // $zip_code = $data['additional_info']['payer']['address']['zip_code'];
                // $city = $data['metadata']['city'];
                // $details = $data['metadata']['details'];

                $user = User::select('id')
                    ->where('is_active', true)
                    ->where('email', $email)
                    ->first();

                $order = new Order();

                $order->state = 'Pendiente';
                $order->fk_orders_users = $user['id'];
                $order->payment = $payment;
                $current_date_time = Carbon::now()->toDateTimeString();
                $order->created_at = $current_date_time;

                $order->save();

                $items = $data['additional_info']['items'];

                foreach ($items as $item) {
                    $product = Product::where(['id' => $item['id'], 'is_active' => true])
                        ->where('stock', '>', 0)
                        ->first();

                    if ($product) {
                        // Attach the product to the order with the amount
                        $order->products()->attach($product->id, ['amount' => $item['quantity']]);

                        // Update the product stock
                        //$product->decrement('stock', $item['quantity']);
                        $product->save();
                    }
                }
            } catch (RequestException $e) {
                Log::error('MercadoPago API request failed:', [
                    'message' => $e->getMessage(),
                    'request' => $e->getRequest(),
                    'response' => $e->hasResponse() ? $e->getResponse()->getBody()->getContents() : null,
                ]);
            }
        }
    }
}
