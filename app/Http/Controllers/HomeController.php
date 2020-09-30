<?php

namespace App\Http\Controllers;

use App\Events\OrderPlaced;
use App\Models\Order;
use App\Models\OrderHasProduct;
use App\Models\Product;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
        return redirect('/');
    }

    public function productShow($product_id)
    {
        try {
            $geo_response = $this->checkGEO();
            $geo_response = json_decode($geo_response);
            if (!empty($geo_response) && in_array($geo_response->country_code, ['CO', 'AU'])) {
                throw new \Exception('We are not allowing your country to place an order.', 201);
            }

            $product = Product::findOrFail($product_id);
            return view('product_show', compact('product'));
        } catch (\Exception $e) {
            return redirect('/')
                ->with('notification', [
                    'type' => 'danger',
                    'message' => $e->getMessage()
                ]);
        }
    }

    public function orderPlace(Request $request)
    {
        try {
            $data      = $request->all();
            $validator = Validator::make($data, array(
                'name' => 'required',
                'email' => 'required',
                'address' => 'required'
            ));
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('notification', [
                        'type'    => 'danger',
                        'message' => implode('<br>', $validator->getMessageBag()->all())
                    ]);
            }

            // create user from the user's data
            $user_response = User::where('email', $request->get('email'))->first();

            if (!isset($user_response)) {
                $user_response = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'email_verified_at' => Carbon::now(),
                    'password' => bcrypt('123456')
                ]);
                $user_id = $user_response->id;
            } else {
                $user_id = $user_response->id;
            }

            $order_data = $request->only('unit_number', 'buzzer_number', 'address', 'city', 'zip_code', 'country');
            $order_data['user_id'] = $user_id;
            $order = Order::create($order_data);

            OrderHasProduct::create([
                'order_id' => $order->id,
                'product_id' => $request->get('product_id')
            ]);

            event(new OrderPlaced([
                'email'            => $request->get('email'),
                'product_response' => Product::where('id', $request->get('product_id'))->first(),
                'order_data'       => $order_data,
                'user_response'    => $user_response
            ]));

            event(new OrderPlaced([
                'email'            => env('ADMIN_TO_ADDRESS'),
                'product_response' => Product::where('id', $request->get('product_id'))->first(),
                'order_data'       => $order_data,
                'user_response'    => $user_response
            ]));

            return redirect('/')
                    ->with('notification', [
                        'type'    => 'success',
                        'message' => 'Order has been placed.'
                    ]);
        } catch (\Exception $e) {
            return redirect()
                ->route('product.show', [$request->get('product_id')])
                ->with('notification', [
                    'type'    => 'danger',
                    'message' => $e->getMessage()
                ]);
        }
    }

    private function checkGEO()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://freegeoip.app/json/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return false;
        } else {
            return $response;
        }
    }
}
