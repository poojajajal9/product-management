<p>
    <strong>Name: </strong>&nbsp;
    <span>{{ !empty($user_response) && !empty($user_response['name']) ? $user_response['name'] : '-' }}</span>
</p>

<p>
    <strong>Email: </strong>&nbsp;
    <span>{{ !empty($user_response) && !empty($user_response['email']) ? $user_response['email'] : '-' }}</span>
</p>

<p>
    <strong>Shipping Address: </strong>&nbsp;
    <span>
        {{ isset($order_data)
                ? $order_data['unit_number'] . ' ' . $order_data['buzzer_number'] . ' ' . $order_data['address'] . ' ' . $order_data['city'] . ' ' . $order_data['zip_code']  . ' ' . $order_data['country']
                : '-' }}
    </span>
</p>

<p>
    <strong>Product Name: </strong>&nbsp;
    <span>
        {{ !empty($product_response) && !empty($product_response['name']) ? $product_response['name'] : '-' }}
    </span>
</p>
