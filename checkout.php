<?php
include('header.php');
include('shoppingCartFunction.php');


if (isset($_POST['BankCheckoutBtn'])) {
    // echo "<script>window.alert('fds');</script>";

    $SenderBankAccount = $_POST['SenderBankAccount'];
    $SenderName = $_POST['SenderName'];
    $SenderEmail = $_POST['SenderEmail'];
    $transferBankName = $_POST['transferBankName'];

    $bankTransferReceipt_name = $_FILES['bankTransferReceipt']['name'];
    $bankTransferReceipt_temp = $_FILES['bankTransferReceipt']['tmp_name'];
    $bankTransferReceipt_size = $_FILES['bankTransferReceipt']['size'];


    $today_day = date('d');
    $today_month = date('M');
    $today_year = date('Y');

    $UserUniqueID = $_SESSION['unique_id'];


    $PaymentType = 'BankTransfer';


    if ($bankTransferReceipt_name == null || $bankTransferReceipt_name == '') {
        echo "<script>window.alert('Please Upload Recepipt Files Again.');</script>";
        echo "<script>window.location('checkout.php');</script>";
    } else {

        if ($bankTransferReceipt_size > 500000000) {

            echo "<script>window.alert('Image size is heavy. Please reduce the size.')</script>";
        } else if (strlen($SenderBankAccount) < 20) {
            echo "<script>window.alert('Invalid Bank Account.')</script>";
        } else {

            $imageFile = explode('.', $bankTransferReceipt_name);
            $imageFileEnd = end($imageFile);

            $allowed_ext_img = array('jpg', 'jpeg', 'gif', 'png');

            $uniqueImgReceipt = date("Ymd") . time();
            $locationImgReceipt = 'assets/files/' . $uniqueImgReceipt . "." . $imageFileEnd;

            $TotalAmount = CalculateTotalAmount();
            $VAT = CalculateTotalAmount() * 0.05;
            $GrandTotal = ceil(CalculateTotalAmount() + (round(CalculateTotalAmount() * 0.05, 2)));
            $purchase_unique_id = uniqid('Purchase') . date('Y-m-d H:i:s') . $UserUniqueID;
            $payment_status = 'succeeded';

            if (in_array($imageFileEnd, $allowed_ext_img)) {

                if (move_uploaded_file($bankTransferReceipt_temp, $locationImgReceipt)) {

                    $Insert1 = "INSERT INTO purchase
                    (purchase_unique_id, unique_id, user_id, total_amount, VAT, grand_total, payment_type, status, bank_transfer_name, customer_email, bank_transaction_no, transfer_bank, purchase_day, purchase_month, purchase_year)
                    VALUES 
                    ('$purchase_unique_id', '$UserUniqueID', '$UserID', '$TotalAmount', '$VAT', '$GrandTotal', '$PaymentType', '$payment_status', '$SenderName', '$SenderEmail', '$SenderBankAccount', '$transferBankName', '$today_day', '$today_month', '$today_year')
                     ";

                    $result1 = mysqli_query($conn, $Insert1);

                    $count = count($_SESSION['Shopping_Cart_Functions']);
                    $LoopTime = $count;
                    // echo "<script>window.alert('".$count."')</script>";

                    for ($i = 0; $i < $LoopTime; $i++) {

                        $CourseID = $_SESSION['Shopping_Cart_Functions'][$i]['CourseID'];
                        $CoursePrice = $_SESSION['Shopping_Cart_Functions'][$i]['CoursePrice'];
                        $InstructorID = $_SESSION['Shopping_Cart_Functions'][$i]['InstructorID'];

                        echo "<script>alert(" . $CoursePrice . ")</script>";



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

                    if ($result2) {
                        echo "<script>alert('Purchase Courses success')</script>";
                        ClearAllSession();
                        echo "<script>window.location = 'home.php'</script>";
                    } else {
                        echo mysqli_error($conn);
                        echo "<p>Something went wrong in " . mysqli_error($conn) . "</p>";
                    }
                } else {
                    echo "<script>alert('Something went wrong in processing')</script>";
                    echo "<script>window.location = 'checkout.php'</script>";
                }
            } else {
                echo "<script>alert('Wrong Image Format')</script>";
                echo "<script>window.location = 'checkout.php'</script>";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html>


<head>
    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MyanLearn | Checkout Page</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png">
    <!-- CSS
   ============================================ -->
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/vendor/icomoon.css">
    <link rel="stylesheet" href="assets/css/vendor/remixicon.css">
    <link rel="stylesheet" href="assets/css/vendor/lightbox.min.css">
    <link rel="stylesheet" href="assets/css/vendor/jqueru-ui-min.css">
    <link rel="stylesheet" href="assets/css/checkout.css">

    <!-- Site Stylesheet -->
    <link rel="stylesheet" href="assets/css/app.css">

    <link rel="stylesheet" href="assets/css/niceCountryInputs.css">
    <link rel="stylesheet" href="assets/css/dd.css?v=4.0">
    <!-- <link rel="stylesheet" href="assets/css/createNewCourse.css"> -->


    <style>
        .ml-10px {
            margin-left: 10px;
        }

        .badge_num {
            background: var(--primary-color);
            font-weight: 500;
            font-family: 'Roboto', sans-serif;
            position: absolute;
            left: 30%;
            border-radius: 3px;
            height: 35px;
            top: 58%;
            width: 35px;
            font-size: 12px;
            padding: 9px 11px;
            margin: 36px 5px 0px 0px;
            display: flex;
            justify-content: center;
        }

        .ms-value-input {
            display: none;
        }

        .ms-dd .ms-dd-option-image,
        .ms-dd .ms-dd-selected-img {
            max-width: 40px;
        }

        .container-box {
            border: 2px solid blue;
            padding: 20px;
            margin-top: 20px;
        }

        .centered-line {
            line-height: 0.1em;
            margin: 10px 0 20px;
        }

        .centered-line span {
            background-color: white;
            padding: 0 10px;
        }
    </style>

</head>

<body class="sticky-header ">


    <div id="main-wrapper" class="main-wrapper">


        <!--=====================================-->
        <!--=       Checkout Area Start         =-->
        <!--=====================================-->
        <section class="checkout-page-area section-gap-equal">
            <div class="container">

                <!-- Display errors returned by checkout session -->
                <div id="paymentResponse" class="hidden"></div>

                <div class="row row--15">
                    <div class="col-lg-8">
                        <div class="checkout-billing">
                            <h3 class="title">Payment Details</h3>

                            <div class="checkout-tabs">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a id="CreditCartTrigger" class="nav-link active" style="cursor: pointer;">

                                            <i class="fa-regular fa-credit-card" style="color: orange; font-size: 15px;"></i>
                                            <span>Credit Card</span>

                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a id="BankTrigger" class="nav-link" style="cursor: pointer;">

                                            <i class='bx bxs-bank bx-md' style="color: gray; font-size: 15px;"></i>
                                            <span>Bank Transfer</span>

                                        </a>
                                    </li>

                                </ul>
                            </div>

                            <div class="tab-content" id="myTabContent">
                                <div class="active" id="credit_method_tab" role="tabpanel" style="display:block;">


                                    <p>After Purchase, you can start learning of your courses material.</p>

                                    <div class="row">
                                        <div class="col-sm-5">
                                            <span><b>MyanLearn</b> accepts card payment for </span>

                                        </div>
                                        <div class="col-sm-6">
                                            <i class="fa-brands fa-cc-visa ml-10px fa-2xl" style="color: #0149c6;"></i>
                                            <i class="fa-brands fa-cc-mastercard ml-10px fa-2xl" style="color: #fea62a;"></i>
                                            <i class="fa-brands fa-cc-amex ml-10px fa-2xl" style="color: #2e74ff;"></i>
                                            <img src="assets/images/pyicon-5.svg" class="ml-10px" style="width: 33px; height: 29px;" alt="unionpay">
                                            <i class="fa-brands fa-cc-discover ml-10px fa-xl"></i>
                                        </div>
                                    </div>



                                    <button class="edu-btn" type="button" style="margin-top: 20px;" name="CardCheckoutBtn" id="CardCheckoutBtn">Confirm Checkout</button>

                                </div>



                                <div id="bank_method_tab" role="tabpanel" style="display:none;">
                                    <h5 class="row" style="margin-left: auto; margin-right: auto; margin-bottom: 20px; align-items: center; justify-content: center; opacity: 0.8;">
                                        Purchasae Courses with Banking Transfer
                                    </h5>
                                    <form action="checkout.php" method="post" enctype="multipart/form-data">


                                        <div class="row g-lg-12">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Sender Bank Account<span class="primaryColor">*</span></label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" maxlength="30" class="form-control" name="SenderBankAccount" data-word-count="30;SenderBankAccount" placeholder="Sender Account 20 to 30 Number" onkeyup="count_down(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                                                        <span class="input-group-text" id="SenderBankAccount" style="height: 45px;">30</span>
                                                    </div>


                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Sender Name<span class="primaryColor">*</span></label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" maxlength="20" minlength="3" class="form-control" name="SenderName" data-word-count="20;SenderName" placeholder="Sender Name" onkeyup="count_down(this)" required>
                                                        <span class="input-group-text" id="SenderName" style="height: 45px;">20</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row g-lg-12">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Sender Email<span class="primaryColor">*</span></label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" maxlength="30" class="form-control" name="SenderEmail" data-word-count="30;SenderEmail" placeholder="Sender Email" onkeyup="count_down(this)" required>
                                                        <span class="input-group-text" id="SenderEmail" style="height: 45px;">30</span>
                                                    </div>


                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Bank Transfer Receipt<span class="primaryColor">*</span></label>
                                                    <input type="file" name="bankTransferReceipt" required>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="row g-lg-12">

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Transfer Bank Name<span class="primaryColor">*</span></label>
                                                    <select style="width: 100%;" is="ms-dropdown" style="font-size: var(--font-size-b1);" name="transferBankName" required>
                                                        <option value="" selected>Select Bank Name</option>
                                                        <option data-image="assets\images\kpay.jpg" value="KBZ Bank">KBZ Bank</option>
                                                        <option data-image="assets\images\ayapay.jpg" value="AYA Bank">AYA Bank</option>
                                                        <option data-image="assets\images\yoma.png" value="Yoma Bank">Yoma Bank</option>
                                                        <option data-image="assets\images\mob.jpg" value="MOB Bank">MOB Bank</option>
                                                        <option data-image="assets\images\uab.webp" value="MOA Bank">UAB Bank</option>
                                                        <option data-image="assets\images\abank.jpg" value="A Bank">A Bank</option>
                                                        <option data-image="assets\images\cb.jpg" value="CB Bank">CB Bank</option>

                                                    </select>

                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Country<span class="primaryColor">*</span></label>

                                                    <div class="niceCountryInputSelector" style="width: 100%;" data-selectedcountry="US" data-showspecial="false" data-showflags="true" data-i18nall="All selected" data-i18nnofilter="No selection" data-i18nfilter="Filter" data-onchangecallback="onChangeCallback" />

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row g-lg-12">

                                            <div class="col-lg-6">
                                                <button class="edu-btn" type="submit" style="margin-top: 20px;" name="BankCheckoutBtn" id="BankCheckoutBtn">Confirm Checkout</button>
                                            </div>

                                        </div>



                                        <div class="container-box">
                                            <h5 class="centered-line">Bank Account Information to Transfer</h5>

                                            <p>KBZ - 74589362017345628791 (MyanLearn Online Learning Platform)</p>
                                            <p>AYA - 91276453782904276518 (MyanLearn Online Learning Platform)</p>
                                            <p>Yoma - 23098412576890345123 (MyanLearn Online Learning Platform)</p>
                                            <p>MOB - 64721908653097421935 (MyanLearn Online Learning Platform)</p>
                                            <p>UAB - 83145907263489012543 (MyanLearn Online Learning Platform)</p>
                                            <p>A Bank - 15983462739081456729 (MyanLearn Online Learning Platform)</p>
                                            <p>CB Bank - 71209834567029812456 (MyanLearn Online Learning Platform)</p>

                                        </div>


                                    </form>

                                </div>




                            </div>



                        </div>





                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="order-summery checkout-summery">
                        <div class="summery-table-wrap">
                            <h4 class="title">Price Detail</h4>
                            <table class="table summery-table">
                                <tbody>
                                    <tr>
                                        <td>Subtotal</td>
                                        <td>$ <?php echo CalculateTotalAmount(); ?> </td>
                                    </tr>
                                    <tr>
                                        <td>VAT (5%)</td>
                                        <td>$ <?php echo round(CalculateTotalAmount() * 0.05, 2); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Grand Total</td>
                                        <td>$ <?php echo ceil(CalculateTotalAmount() + (round(CalculateTotalAmount() * 0.05, 2))); ?></td>
                                    </tr>



                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="order-payment">
                        <h4 class="title">Order Detail</h4>

                        <?php
                        $count = count($_SESSION['Shopping_Cart_Functions']);
                        $LoopTime = $count;
                        // echo "<script>window.alert('".$count."')</script>";

                        for ($i = 0; $i < $LoopTime; $i++) {

                            $CoursePrice = $_SESSION['Shopping_Cart_Functions'][$i]['CoursePrice'];
                            $PreviewImage = $_SESSION['Shopping_Cart_Functions'][$i]['PreviewImage'];
                            $CourseTitle = $_SESSION['Shopping_Cart_Functions'][$i]['CourseTitle'];
                            $CourseID = $_SESSION['Shopping_Cart_Functions'][$i]['CourseID'];


                        ?>

                            <div class="row g-lg-12">
                                <div class="col-4 col-md-2 col-lg-3">
                                    <div class="thumbnail">
                                        <a href="courseviewdetail.php?CourseID=<?php echo $CourseID ?>">
                                            <img src="<?php echo $PreviewImage; ?>" alt="Course Meta" style="max-width: 100%;">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-4 col-md-6">
                                    <div class="content">
                                        <div class="course-price"><?php echo $CoursePrice; ?></div>
                                        <h6 class="title">
                                            <a href="courseviewdetail.php?CourseID=<?php echo $CourseID ?>"><?php echo $CourseTitle; ?></a>
                                        </h6>
                                    </div>
                                </div>
                            </div>

                            <hr>


                        <?php } ?>

                    </div>
                </div>
            </div>
    </div>
    </section>


    </div>

    <div class="rn-progress-parent">
        <svg class="rn-back-circle svg-inner" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>

    <!-- Footer Section -->
    <?php include_once "footer.php";  ?>

    <!-- JS
	============================================ -->
    <!-- Jquery Js -->
    <script src="assets/js/vendor/jquery.min.js"></script>
    <script src="assets/js/vendor/bootstrap.min.js"></script>
    <script src="assets/js/vendor/sal.min.js"></script>
    <script src="assets/js/vendor/backtotop.min.js"></script>
    <script src="assets/js/vendor/magnifypopup.min.js"></script>
    <script src="assets/js/vendor/imageloaded.min.js"></script>
    <script src="assets/js/vendor/lightbox.min.js"></script>
    <script src="assets/js/vendor/paralax.min.js"></script>
    <script src="assets/js/vendor/swiper-bundle.min.js"></script>
    <script src="assets/js/vendor/smooth-scroll.min.js"></script>

    <!-- Site Scripts -->
    <script src="assets/js/app.js"></script>


    <!-- Strip js library -->
    <script src="https://js.stripe.com/v3/"></script>

    <script src="assets/js/niceCountryInput.js"></script>

    <script src="assets/js/dd.min.js?ver=4.0"></script>

    <script>
        // Set Stripe publishable key to initialize Stripe.js
        const stripe = Stripe('<?php echo STRIPE_PUBLISHABLE_KEY; ?>');

        // Select payment button
        const payBtn = document.querySelector("#CardCheckoutBtn");

        // Payment request handler
        payBtn.addEventListener("click", function(evt) {
            createCheckoutSession().then(function(data) {
                if (data.sessionId) {
                    stripe.redirectToCheckout({
                        sessionId: data.sessionId,
                    }).then(handleResult);
                } else {
                    handleResult(data);
                }
            });
        });

        // Create a Checkout Session with the selected product
        const createCheckoutSession = function(stripe) {
            return fetch("payment_init.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    createCheckoutSession: 1,
                }),
            }).then(function(result) {
                return result.json();
            });
        };

        // Handle any errors returned from Checkout
        const handleResult = function(result) {
            if (result.error) {
                showMessage(result.error.message);
            }

        };



        // Display message
        function showMessage(messageText) {
            const messageContainer = document.querySelector("#paymentResponse");

            messageContainer.classList.remove("hidden");
            messageContainer.textContent = messageText;

            setTimeout(function() {
                messageContainer.classList.add("hidden");
                messageText.textContent = "";
            }, 5000);
        }
    </script>



    <script>
        // Get the modal
        var credit_method_tab = document.getElementById("credit_method_tab");
        var bank_method_tab = document.getElementById("bank_method_tab");

        // Get trigger
        var CreditCartTrigger = document.getElementById("CreditCartTrigger");
        var BankTrigger = document.getElementById("BankTrigger");



        CreditCartTrigger.onclick = function() {
            bank_method_tab.style.display = "none";
            credit_method_tab.style.display = "block";
            document.getElementById("BankTrigger").classList.remove("active");
            document.getElementById("CreditCartTrigger").classList.add("active");

        }
        BankTrigger.onclick = function() {
            bank_method_tab.style.display = "block";
            credit_method_tab.style.display = "none";
            document.getElementById("CreditCartTrigger").classList.remove("active");
            document.getElementById("BankTrigger").classList.add("active");
        }
        PaypalTrigger.onclick = function() {
            bank_method_tab.style.display = "none";
            credit_method_tab.style.display = "none";
            document.getElementById("CreditCartTrigger").classList.remove("active");
            document.getElementById("BankTrigger").classList.remove("active");
        }
    </script>

    <script>
        function onChangeCallback(ctr) {
            console.log("The country was changed: " + ctr);
            //$("#selectionSpan").text(ctr);
        }

        $(document).ready(function() {
            $(".niceCountryInputSelector").each(function(i, e) {
                new NiceCountryInput(e).init();
            });
        });
    </script>
    </div>
    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-36251023-1']);
        _gaq.push(['_setDomainName', 'jqueryscript.net']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script');
            ga.type = 'text/javascript';
            ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(ga, s);
        })();
    </script>

    <script>
        function count_down(obj) {
            const data_length = obj.getAttribute('data-word-count').split(";")[0];
            const CourseTitle = document.getElementById(obj.getAttribute('data-word-count').split(";")[1]);
            // alert(CourseTitle);


            CourseTitle.innerHTML = data_length - obj.value.length;
            // window.alert("dfad");

            if (data_length - obj.value.length < 5) {
                CourseTitle.style.color = 'red';
            } else {
                CourseTitle.style.color = 'black';
            }
        }
    </script>

    <script>
        let inputElem = document.querySelector('.niceCountryInputMenuInputHidden');
        inputElem.setAttribute('name', 'country');
    </script>


</body>

</html>