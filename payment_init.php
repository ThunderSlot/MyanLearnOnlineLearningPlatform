<?php 
 
// Include the configuration file 
session_start();

include('shoppingCartFunction.php');
 
// Include the Stripe PHP library 
require_once 'stripe-php/init.php'; 
 
// Set API key 
$stripe = new \Stripe\StripeClient(STRIPE_API_KEY); 
 
$response = array( 
    'status' => 0, 
    'error' => array( 
        'message' => 'Invalid Request!'    
    ) 
); 
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $input = file_get_contents('php://input'); 
    $request = json_decode($input);     
} 
 
if (json_last_error() !== JSON_ERROR_NONE) { 
    http_response_code(400); 
    echo json_encode($response); 
    exit; 
} 
 
if(!empty($request->createCheckoutSession)){ 
    // Convert product price to cent 
    $stripeAmount = round( ceil(CalculateTotalAmount() + (round(CalculateTotalAmount() * 0.05, 2)))  *100, 2);    
    $currency = 'usd';

    $count=count($_SESSION['Shopping_Cart_Functions']);


 
    // Create new Checkout Session for the order 
    try { 
        $checkout_session = $stripe->checkout->sessions->create([ 
            'line_items' => [[ 
                'price_data' => [ 
                    'product_data' => [ 
                        'name' => 'Pay Shopping Cart Courses', 
                        // 'images' => ['https://d1wqzb5bdbcre6.cloudfront.net/e2d4f85ec2aaac5a54c7462b1512f843a74a5d4a1c503aaf3eaf09ecba3db8c4/68747470733a2f2f696d616765732e67656e6572617465642e70686f746f732f3442694a70684c50646b6c5f2d72654674366b4d63505a526e6261347037394d36744646397479325a48342f72733a6669743a3531323a3531322f637a4d364c79397059323975637a67752f5a33426f6233527663793177636d396b2f4c6e426f62335276637939324d6c38772f4d4467784e546b324c6d70775a772e6a7067'],
                        'metadata' => [
                            'size' => 'medium',
                        ]
                    ], 
                    'unit_amount' => $stripeAmount, 
                    'currency' => $currency, 
                ], 
                'quantity' => 1
            ]], 
            'mode' => 'payment', 
            'success_url' => STRIPE_SUCCESS_URL.'?session_id={CHECKOUT_SESSION_ID}', 
            'cancel_url' => STRIPE_CANCEL_URL, 
        ]); 
    } catch(Exception $e) {  
        $api_error = $e->getMessage();  
    }
    
    
     
    if(empty($api_error) && $checkout_session){ 
        $response = array( 
            'status' => 1, 
            'message' => 'Checkout Session created successfully!', 
            'sessionId' => $checkout_session->id 
        ); 
    }else{ 
        $response = array( 
            'status' => 0, 
            'error' => array( 
                'message' => 'Checkout Session creation failed! '.$api_error    
            ) 
        ); 
    } 
} 
 
// Return response 
echo json_encode($response);
