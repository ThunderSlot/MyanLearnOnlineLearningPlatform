<?php
function AddProduct($CourseID)
{
	include('config.php');

	// echo "<script>window.alert('".$CourseID."')</script>";

	$query = "SELECT * FROM course WHERE course_id='$CourseID'";
	$result = mysqli_query($conn, $query);
	$count = mysqli_num_rows($result);
	$rows = mysqli_fetch_array($result);

	if ($count < 1) {
		echo "<p>No Product Found.</p>";
		echo "<script>window.alert('No Product Found!')</script>";
		echo "<script>window.location='courseviewdetail.php?CourseID=" . $CourseID . "'</script>";
		exit();
	}



	if (isset($_SESSION['Shopping_Cart_Functions'])) {

		$index = IndexOf($CourseID);

		if ($index == -1) {
			// Condi 2
			$count = count($_SESSION['Shopping_Cart_Functions']);

			$_SESSION['Shopping_Cart_Functions'][$count]['CourseID'] = $CourseID;

			$_SESSION['Shopping_Cart_Functions'][$count]['CourseTitle'] = $rows['course_title'];
			$_SESSION['Shopping_Cart_Functions'][$count]['CoursePrice'] = $rows['course_price'];
			$_SESSION['Shopping_Cart_Functions'][$count]['PreviewImage'] = $rows['preview_image'];
			$_SESSION['Shopping_Cart_Functions'][$count]['CourseCategory'] = $rows['course_category'];
			$_SESSION['Shopping_Cart_Functions'][$count]['InstructorID'] = $rows['instructor_id'];
		} else //Add more product numbers into already added prroducts OR Product is currently in the cart
		{
			// Condi 3


		}
	} else {
		// Condi 1

		$_SESSION['Shopping_Cart_Functions'] = array();

		$_SESSION['Shopping_Cart_Functions'][0]['CourseID'] = $CourseID;


		$_SESSION['Shopping_Cart_Functions'][0]['CourseTitle'] = $rows['course_title'];
		$_SESSION['Shopping_Cart_Functions'][0]['CoursePrice'] = $rows['course_price'];
		$_SESSION['Shopping_Cart_Functions'][0]['PreviewImage'] = $rows['preview_image'];
		$_SESSION['Shopping_Cart_Functions'][0]['CourseCategory'] = $rows['course_category'];
		$_SESSION['Shopping_Cart_Functions'][0]['InstructorID'] = $rows['instructor_id'];
	}

	echo "<script>window.location='ShoppingCart.php'</script>";
}



function IndexOf($CourseID)
{
	if (!isset($_SESSION['Shopping_Cart_Functions'])) {
		return -1;
	}

	$count = count($_SESSION['Shopping_Cart_Functions']);

	if ($count < 1) {
		return -1;
	}

	for ($i = 0; $i < $count; $i++) {
		if ($CourseID == $_SESSION['Shopping_Cart_Functions'][$i]['CourseID']) {
			return $i;
		}
	}
	return -1;
}

function ClearAll()
{
	unset($_SESSION['Shopping_Cart_Functions']);
	echo "<script>window.location='ShoppingCart.php'</script>";
}
function ClearAllSession()
{
	unset($_SESSION['Shopping_Cart_Functions']);
}

function RemoveProduct($CourseID)
{

	$index = IndexOf($CourseID);

	unset($_SESSION['Shopping_Cart_Functions'][$index]);
	$_SESSION['Shopping_Cart_Functions'] = array_values($_SESSION['Shopping_Cart_Functions']);
	echo "<script>window.location='ShoppingCart.php'</script>";
}

function CalculateTotalAmount()
{
	$TotalAmount = 0;

	$count = count($_SESSION['Shopping_Cart_Functions']);

	for ($i = 0; $i < $count; $i++) {
		$CoursePrice = $_SESSION['Shopping_Cart_Functions'][$i]['CoursePrice'];
		if ($CoursePrice !== 'Free') {
			$CoursePriceSimple = str_replace('$', '', $CoursePrice);
			$CoursePriceInt = intval(str_replace('.', '', $CoursePriceSimple));
			$CoursePriceFloat = $CoursePriceInt / 100;

			$TotalAmount += $CoursePriceFloat;
		}
	}

	return $TotalAmount;
}

function CalculateDiscountPrice()
{
	$DiscountPriceTotal = 0;

	$count = count($_SESSION['Shopping_Cart_Functions']);

	for ($i = 0; $i < $count; $i++) {
		$DiscountPrice = $_SESSION['Shopping_Cart_Functions'][$i]['DiscountPrice'];


		$DiscountPriceTotal += $DiscountPrice;
	}

	return $DiscountPriceTotal;
}

define('STRIPE_API_KEY', 'sk_test_51Mt1XjJ0ayPYJ2ci4AADxSZGhlkfGhSVy9sUfagtufKb4trZJWRwHZ3gkV01jnGjFRj78ozBp3XexASKH87WUXbc00HYGUs3Cq');
define('STRIPE_PUBLISHABLE_KEY', 'pk_test_51Mt1XjJ0ayPYJ2cii7PQp24kVcVZOtCU4stV6stOI8b1c0LTcPeM67nV2mVxj94BlVMrImG7olDf3ZSilrS106Em00hVlRiZmP');
define('STRIPE_SUCCESS_URL', 'http://localhost/Online%20Learning%20Platform/successPayment.php'); //Payment success URL 
define('STRIPE_CANCEL_URL', 'http://localhost/Online%20Learning%20Platform/checkout.php'); //Payment cancel URL 