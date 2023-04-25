<?php
// Include configuration file  
include('config.php');
include('header.php');
include_once('shoppingCartFunction.php');

// Include the Stripe PHP library 
require_once 'stripe-php/init.php';

$count = count($_SESSION['Shopping_Cart_Functions']);
$LoopTime = $count;

if($count<1)
{
    echo "<script>window.location.href = 'home.php';</script>";
}

// Set API key 
$stripe = new \Stripe\StripeClient(STRIPE_API_KEY);

$payment_id = $statusMsg = '';
$status = 'error';

// Check whether stripe checkout session is not empty 
if (!empty($_GET['session_id'])) {
    $session_id = $_GET['session_id'];




    // Fetch the Checkout Session to display the JSON result on the success page 
    try {
        $checkout_session = $stripe->checkout->sessions->retrieve($session_id);
    } catch (Exception $e) {
        $api_error = $e->getMessage();
    }

    if (empty($api_error) && $checkout_session) {
        // Get customer details 
        $customer_details = $checkout_session->customer_details;

        // Retrieve the details of a PaymentIntent 
        try {
            $paymentIntent = $stripe->paymentIntents->retrieve($checkout_session->payment_intent);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            $api_error = $e->getMessage();
        }

        if (empty($api_error) && $paymentIntent) {
            // Check whether the payment was successful 
            if (!empty($paymentIntent) && $paymentIntent->status == 'succeeded') {
                // Transaction details  
                $transactionID = $paymentIntent->id;
                $paidAmount = $paymentIntent->amount;
                $GrandTotal = ($paidAmount / 100);
                $paidCurrency = $paymentIntent->currency;
                $payment_status = $paymentIntent->status;


                // Customer info 
                $customer_name = $customer_email = '';
                if (!empty($customer_details)) {
                    $CardHolderName = !empty($customer_details->name) ? $customer_details->name : '';
                    $customer_email = !empty($customer_details->email) ? $customer_details->email : '';
                }



                $today_day = date('d');
                $today_month = date('M');
                $today_year = date('Y');
                $time = time();

                $UserUniqueID = $_SESSION['unique_id'];


                $PaymentType = 'CreditCard';

                $TotalAmount = CalculateTotalAmount();
                $VAT = CalculateTotalAmount() * 0.05;
                $purchase_unique_id = $transactionID . date('Y-m-d H:i:s') . $UserUniqueID;

                $Insert1 = "INSERT INTO purchase
				(purchase_unique_id, unique_id, user_id, total_amount, VAT, grand_total, payment_type, status, card_holder_name, customer_email,card_transaction_no, purchase_day, purchase_month, purchase_year )
			  VALUES 
			  ('$purchase_unique_id', '$UserUniqueID', '$UserID', '$TotalAmount', '$VAT', '$GrandTotal', '$PaymentType', '$payment_status', '$CardHolderName', '$customer_email', '$transactionID', '$today_day', '$today_month', '$today_year')
			";

                $result1 = mysqli_query($conn, $Insert1);


                $count = count($_SESSION['Shopping_Cart_Functions']);
                $LoopTime = $count;
                // echo "<script>window.alert('".$count."')</script>";

                for ($i = 0; $i < $LoopTime; $i++) {
                    $CourseID = $_SESSION['Shopping_Cart_Functions'][$i]['CourseID'];
                    $CoursePrice = $_SESSION['Shopping_Cart_Functions'][$i]['CoursePrice'];
                    $InstructorID = $_SESSION['Shopping_Cart_Functions'][$i]['InstructorID'];


                    $Insert2 = "INSERT INTO purchasedetail (purchase_unique_id, course_id, course_price, purchase_day, purchase_month, purchase_year, user_unique_id, instructor_unique_id) 
				  VALUES
				  ('$purchase_unique_id', '$CourseID', '$CoursePrice', '$today_day', '$today_month', '$today_year', '$UserUniqueID', '$InstructorID' )
				  ";
                    $result2 = mysqli_query($conn, $Insert2);

                    if ($CoursePrice !== 'Free') {
                        $price_without_dollar_sign = str_replace("$", "", $CoursePrice);
                        $CoursePriceInt = intval($price_without_dollar_sign);

                        $selectProfileNetworth = "Select * from instructors where unique_id = '$InstructorID'";
                        $runSelectProfileNetworth = mysqli_query($conn, $selectProfileNetworth);
                        $InstructorResult = mysqli_fetch_array($runSelectProfileNetworth);

                        $currentProfileNetworth = $InstructorResult['profile_networth'];
                        $addedProfileNetworth = $currentProfileNetworth + $CoursePriceInt;

                        $addedProfileNetworth = "UPDATE instructors
                                                SET profile_networth = '$addedProfileNetworth'
                                                WHERE unique_id = '$InstructorID';";
                        $result3 = mysqli_query($conn, $addedProfileNetworth);
                    }
                }

                $payment_id = $purchase_unique_id;

                $status = 'success';
                $statusMsg = 'Your Payment has been Successful!';
            } else {
                $statusMsg = "Transaction has been failed!";
            }
        } else {
            $statusMsg = "Unable to fetch the transaction details! $api_error";
        }
    } else {
        $statusMsg = "Invalid Transaction! $api_error";
    }
} else {
    $statusMsg = "Invalid Request!";
}
?>

<?php if (!empty($payment_id)) { ?>

    <!-- CSS
     ============================================ -->
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/vendor/icomoon.css">
    <link rel="stylesheet" href="assets/css/vendor/remixicon.css">
    <link rel="stylesheet" href="assets/css/vendor/lightbox.min.css">
    <link rel="stylesheet" href="assets/css/vendor/jqueru-ui-min.css">

    <!-- Site Stylesheet -->
    <link rel="stylesheet" href="assets/css/app.css">


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 bg-light p-4">
                <h3 class="<?php echo $status; ?>" style="color: var(--light-gradient); margin-bottom: 20px;"><?php echo $statusMsg; ?></h3>
                <h4>Payment Information</h4>
                <p><b>Reference Number:</b> <?php echo $payment_id; ?></p>
                <p><b>Transaction ID:</b> <?php echo $transactionID; ?></p>
                <p><b>Paid Amount:</b> <?php echo $paidAmount . ' ' ?><b><?php echo strtoupper($paidCurrency); ?></b></p>
                <p><b>Payment Status:</b> <?php echo $payment_status; ?></p>
                <hr>
                <h4>Customer Information</h4>
                <p><b>Card Holder Name:</b> <?php echo $CardHolderName; ?></p>
                <p><b>Customer Email:</b> <?php echo $customer_email; ?></p>
                <hr>
                <h4>Detail Information</h4>


                <?php
                $count = count($_SESSION['Shopping_Cart_Functions']);
                for ($i = 0; $i < $count; $i++) {
                    $CoursePrice = $_SESSION['Shopping_Cart_Functions'][$i]['CoursePrice'];
                    $CourseTitle = $_SESSION['Shopping_Cart_Functions'][$i]['CourseTitle'];

                ?>
                    <p><b>Course Name:</b> <?php echo $CourseTitle; ?></p>
                    <p><b>Price:</b> <?php echo $CoursePrice; ?></p>

                <?php
                }
                ?>
                <hr>

                <a href="home.php" class="edu-btn btn-medium checkout-btn">Continue Buying <i class="icon-4"></i></i></a>


            </div>
        </div>
    </div>


<?php } else { ?>
    <p class="error"><?php echo $statusMsg; ?></p>
<?php } ?>

<?php
ClearAllSession();
include('footer.php');

?>