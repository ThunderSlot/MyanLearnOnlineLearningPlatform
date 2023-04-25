<?php
include_once "instructorheader.php";
include_once "config.php";

$sqlCourse = "SELECT * FROM course WHERE instructor_id = {$_SESSION['unique_id']}";
$queryCourse = mysqli_query($conn, $sqlCourse);
$arrCourse = mysqli_fetch_array($queryCourse);
$countCourse = mysqli_num_rows($queryCourse);

$sqlInstructor = "SELECT * FROM instructors WHERE unique_id = {$_SESSION['unique_id']}";
$queryInstructor = mysqli_query($conn, $sqlInstructor);
$arrInstructor = mysqli_fetch_array($queryInstructor);

// echo "<script>alert(".$_SESSION['unique_id'].");</script>";


if (isset($_POST['KBZWithdraw'])) {

    $withdrawAmountKBZ = $_POST['withdrawAmountKBZ'];

    if ($arrInstructor['profile_networth'] < 10) {
        echo "<script>alert('Your Balance is under 10$! Soryy, Cannot make withdraw');</script>";
    } 
    else if ($withdrawAmountKBZ < 10)
    {
        echo "<script>alert('Minimum withdrawal is $10!');</script>";
    }
    else {
        $afterWithdrawal = $arrInstructor['profile_networth'] - $withdrawAmountKBZ;

        // echo "<script>alert(" . $afterWithdrawal . ");</script>";


        $updateInstructor = "UPDATE instructors 
                            SET profile_networth = {$afterWithdrawal}
                            WHERE unique_id = {$_SESSION['unique_id']}";
        $queryUpdateInstructor = mysqli_query($conn, $updateInstructor) or die("Withdrawal failed: " . mysqli_error($conn));

        if ($queryUpdateInstructor) {
            echo "<script>window.alert('$" . $withdrawAmountKBZ . " withdrawal has been submitted. Please wait for the contact !')</script>";
            echo "<script>window.location='payout.php';</script>";
        }
    }
}

if (isset($_POST['WaveWithdraw'])) {

    $withdrawAmountWave = $_POST['withdrawAmountWave'];

    if ($arrInstructor['profile_networth'] < 10) {
        echo "<script>alert('Your Balance is under 10$! Soryy, Cannot make withdraw');</script>";
    } 
    else if ($withdrawAmountWave < 10)
    {
        echo "<script>alert('Minimum withdrawal is $10!');</script>";
    }
    else {
        $afterWithdrawal = $arrInstructor['profile_networth'] - $withdrawAmountWave;

        // echo "<script>alert(" . $afterWithdrawal . ");</script>";


        $updateInstructor = "UPDATE instructors 
                            SET profile_networth = {$afterWithdrawal}
                            WHERE unique_id = {$_SESSION['unique_id']}";
        $queryUpdateInstructor = mysqli_query($conn, $updateInstructor) or die("Withdrawal failed: " . mysqli_error($conn));

        if ($queryUpdateInstructor) {
            echo "<script>window.alert('$" . $withdrawAmountWave . " withdrawal has been submitted. Please wait for the contact !')</script>";
            echo "<script>window.location='payout.php';</script>";
        }
    }
}

if (isset($_POST['WithdrawBank'])) {

    $withdrawAmountBank = $_POST['withdrawAmountBank'];

    if ($arrInstructor['profile_networth'] < 10) {
        echo "<script>alert('Your Balance is under 10$! Soryy, Cannot make withdraw');</script>";
    } 
    else if ($withdrawAmountBank < 10)
    {
        echo "<script>alert('Minimum withdrawal is $10!');</script>";
    }
    else {
        $afterWithdrawal = $arrInstructor['profile_networth'] - $withdrawAmountBank;

        // echo "<script>alert(" . $afterWithdrawal . ");</script>";


        $updateInstructor = "UPDATE instructors 
                            SET profile_networth = {$afterWithdrawal}
                            WHERE unique_id = {$_SESSION['unique_id']}";
        $queryUpdateInstructor = mysqli_query($conn, $updateInstructor) or die("Withdrawal failed: " . mysqli_error($conn));

        if ($queryUpdateInstructor) {
            echo "<script>window.alert('$" . $withdrawAmountBank . " withdrawal has been submitted. Please wait for the contact !')</script>";
            echo "<script>window.location='payout.php';</script>";
        }
    }
}






?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyanLearn Instructor Payout page</title>

    <!-- Main Css File -->
    <link rel="stylesheet" href="assets/css/instructordashboard.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/variable.css">

    <!-- For icon tab -->
    <link rel="icon" href="assets/images/logomobile.png">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="assets/vendor/Fontawesome-free/css/all.min.css">

    <!-- Vendor -->
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/niceCountryInputs.css">
    <link rel="stylesheet" href="assets/css/dd.css?v=4.0">
    <style>
        body {
            overflow: auto;
        }

        input {
            height: 45px;
        }
        .ms-dd-option-image
        {
            max-width: 30px!important;
        }
    </style>


</head>

<body>



    <section class="home">

        <main id="main" class="main">

            <div class="pagetitle">
                <h1>Withdraw Page</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                        <li class="breadcrumb-item active">Payout</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->


            <div class="col-lg-12">



                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Your Wallet Balance - $<?php echo $arrInstructor['profile_networth']; ?></h5>

                        <!-- Bordered Tabs Justified -->
                        <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
                            <li class="nav-item flex-fill" role="presentation">
                                <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-home" type="button" role="tab" aria-controls="home" aria-selected="true">KBZ Pay</button>
                            </li>
                            <li class="nav-item flex-fill" role="presentation">
                                <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Wave Pay</button>
                            </li>
                            <li class="nav-item flex-fill" role="presentation">
                                <button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Bank Withdrawal</button>
                            </li>
                        </ul>


                        <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                            <div class="tab-pane fade show active" id="bordered-justified-home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="card-title"><i class="bi bi-info-circle" style="margin-right: 10px;"></i> KBZ Withdrawal</div>
                                <span class="card-title" style="font-weight: 700;">Minimum Wtihdrawal - 10$</span>
                                <p style="margin: 26px 10px 26px 15px;"> Your withdraw information together with <span style="color: green;">KBZ Pay Account Name and phone number</span>. Once you submitted the from, the company will make contact you in 3 business day to make confirm!</p>
                                <form action="payout.php" method="post" enctype="multipart/form-data">


                                    <div class="row g-lg-12">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>KBZ Account Name<span class="primaryColor">*</span></label>
                                                <div class="input-group mb-3">
                                                    <input type="text" maxlength="30" class="form-control" name="KBZName" data-word-count="30;KBZName" placeholder="Your KBZ Account Name" onkeyup="count_down(this)">
                                                    <span class="input-group-text" id="KBZName" style="height: 45px;">30</span>
                                                </div>


                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>KBZ Phone Number<span class="primaryColor">*</span></label>
                                                <div class="input-group mb-3">
                                                    <input type="text" maxlength="20" minlength="3" class="form-control" name="KBZNumber" data-word-count="20;KBZNumber" placeholder="KBZ Pay Phone Name(E.g. 95---)" onkeyup="count_down(this)" required onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                                    <span class="input-group-text" id="KBZNumber" style="height: 45px;">20</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Withdraw Amount<span class="primaryColor">*</span></label>

                                                <input type="text" maxlength="5" class="form-control" name="withdrawAmountKBZ" placeholder="E.g. 10" required onkeypress="return event.charCode >= 48 && event.charCode <= 57">

                                            </div>
                                        </div>

                                    </div>



                                    <div class="row g-lg-12">

                                        <div class="col-lg-6">
                                            <button class="btn btn-primary" type="submit" style="margin-top: 20px;" name="KBZWithdraw" id="KBZWithdraw">Make WIthdraw</button>
                                        </div>

                                    </div>





                                </form>
                            </div>

                            <div class="tab-pane fade" id="bordered-justified-profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="card-title"><i class="bi bi-info-circle" style="margin-right: 10px;"></i> Wavepay Withdrawal</div>
                                <span class="card-title" style="font-weight: 700;">Minimum Wtihdrawal - 10$</span>
                                <p style="margin: 26px 10px 26px 15px;"> Your withdraw information together with <span style="color: green;"> WavePay Account Name and phone number</span> . Once you submitted the from, the company will make contact you in 3 business day to make confirm!</p>
                                <form action="payout.php" method="post" enctype="multipart/form-data">


                                    <div class="row g-lg-12">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Wave Account Name<span class="primaryColor">*</span></label>
                                                <div class="input-group mb-3">
                                                    <input type="text" maxlength="30" class="form-control" name="WaveName" data-word-count="30;WaveName" placeholder="Your WavePay Account Name" onkeyup="count_down(this)">
                                                    <span class="input-group-text" id="WaveName" style="height: 45px;">30</span>
                                                </div>


                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Wave Phone Number<span class="primaryColor">*</span></label>
                                                <div class="input-group mb-3">
                                                    <input type="text" maxlength="20" minlength="3" class="form-control" name="WaveNumber" data-word-count="20;WaveNumber" placeholder="WavePay Phone Name(E.g. 95---)" onkeyup="count_down(this)" required onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                                    <span class="input-group-text" id="WaveNumber" style="height: 45px;">20</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Withdraw Amount<span class="primaryColor">*</span></label>

                                                <input type="text" maxlength="5" class="form-control" name="withdrawAmountWave" placeholder="E.g. 10" required onkeypress="return event.charCode >= 48 && event.charCode <= 57">

                                            </div>
                                        </div>
                                    </div>



                                    <div class="row g-lg-12">

                                        <div class="col-lg-6">
                                            <button class="btn btn-primary" type="submit" style="margin-top: 20px;" name="WaveWithdraw" id="WaveWithdraw">Make WIthdraw</button>
                                        </div>

                                    </div>





                                </form>
                            </div>

                            <div class="tab-pane fade" id="bordered-justified-contact" role="tabpanel" aria-labelledby="contact-tab">

                                <div class="card-title"><i class="bi bi-info-circle" style="margin-right: 10px;"></i>Bank Withdrawal</div>
                                <span class="card-title" style="font-weight: 700;">Minimum Wtihdrawal - 10$</span>
                                <p style="margin: 26px 10px 26px 15px;"> Your withdraw information together with <span style="color: green;"> email and phone number </span>. Once you submitted the from, the company will make contact you in 3 business day to make confirm!</p>
                                <form action="payout.php" method="post" enctype="multipart/form-data">


                                    <div class="row g-lg-12">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Receiver Bank Account<span class="primaryColor">*</span></label>
                                                <div class="input-group mb-3">
                                                    <input type="text" maxlength="30" class="form-control" name="SenderBankAccount" data-word-count="30;SenderBankAccount" placeholder="Receiver Account 20 to 30 Number" onkeyup="count_down(this)" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                                    <span class="input-group-text" id="SenderBankAccount" style="height: 45px;">30</span>
                                                </div>


                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Receiver Name<span class="primaryColor">*</span></label>
                                                <div class="input-group mb-3">
                                                    <input type="text" maxlength="20" minlength="3" class="form-control" name="ReceiverName" data-word-count="20;ReceiverName" placeholder="Receiver Name" onkeyup="count_down(this)" required>
                                                    <span class="input-group-text" id="ReceiverName" style="height: 45px;">20</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row g-lg-12">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Receiver Email<span class="primaryColor">*</span></label>
                                                <div class="input-group mb-3">
                                                    <input type="text" maxlength="30" class="form-control" name="ReceiverEmail" data-word-count="30;ReceiverEmail" placeholder="Receiver Email" onkeyup="count_down(this)" required>
                                                    <span class="input-group-text" id="ReceiverEmail" style="height: 45px;">30</span>
                                                </div>


                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Phone Number<span class="primaryColor">*</span></label>
                                                <div class="input-group mb-3">
                                                    <input type="text" maxlength="15" class="form-control" name="SenderEmail" data-word-count="30;ReceiverPhone" placeholder="Receiver Phone (95---)" onkeyup="count_down(this)" required onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                                    <span class="input-group-text" id="ReceiverPhone" style="height: 45px;">15</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="row g-lg-12">

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Receive Bank Name<span class="primaryColor">*</span></label>
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
                                                <label>Withdraw Amount<span class="primaryColor">*</span></label>

                                                <input type="text" maxlength="5" class="form-control" name="withdrawAmountBank" placeholder="E.g. 10" required onkeypress="return event.charCode >= 48 && event.charCode <= 57">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row g-lg-12">

                                        <div class="col-lg-6">
                                            <button class="btn btn-primary" type="submit" style="margin-top: 20px;" name="WithdrawBank" id="WithdrawBank">Make WIthdraw</button>
                                        </div>

                                    </div>





                                </form>
                            </div>
                        </div><!-- End Bordered Tabs Justified -->

                    </div>
                </div>



            </div>



        </main><!-- End #main -->



    </section>

    <script src="assets/js/instructordashboard.js"></script>
    <script src="assets/js/vendor/jquery.min.js"></script>


    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>

    <script src="assets/js/niceCountryInput.js"></script>

    <script src="assets/js/dd.min.js?ver=4.0"></script>

    <script>
        let inputElem = document.querySelector('.niceCountryInputMenuInputHidden');
        inputElem.setAttribute('name', 'country');
    </script>

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






</body>

</html>