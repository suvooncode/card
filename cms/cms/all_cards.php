<?php 
	include("init.php");

	$findcards = find("all","card_details","*","where 1 order by card_id desc",array());
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="Generator" content="EditPlus®">
		<meta name="Author" content="">
		<meta name="Keywords" content="">
		<meta name="Description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>All Cards</title>
		<!-- Font Css -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
		<!-- Css Link -->
		<link href="assets/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/swiper.css">
		<link href="assets/css/main.css" rel="stylesheet">
		<link href="assets/css/media-queries.css" rel="stylesheet">
		<!-- Js Link -->
		<script src="assets/js/jquery-3.4.1.min.js"></script>
	</head>
	<body class="home">
		<!-- Header area -->
		<header class="header-area">
			<div class="container">
				<div class="row">
					<div class="col-6">
						<div class="logo-area">
							<a href="index"><img src="assets/images/logo 1.png" border="0" alt="">Card</a>
						</div>
					</div>
					<div class="col-6">
						<div class="login-button text-right">
							<a href="logout">Hi <?=$_SESSION["name"]?> Logout !</a>
						</div>
					</div>
				</div>
			</div>
		</header>
		<!-- End::Header area -->
		<main>
		<section class="cards-area">
			<div class="card-filter-area">
				<ul>
					<li class="active"><a href="">View All Cards</a></li>
					<?php if(isset($_SESSION["user_id"])){ ?>
					<li><a href="my_cards">My Cards</a></li>
					<?php } ?>
				</ul>
			</div>
			<div class="cards-area-wrapper">
				<div class="row">
					<?php 
						foreach($findcards as $key=>$val)
						{ 
							$ismine = "no";
							$user_id = $_SESSION["user_id"];
							$card_id = $val["card_id"];
							$findmine = find("all","user_card_details","*","where card_id='$card_id' and user_id='$user_id'",array());

							if($findmine) { $ismine="yes"; } 
						?>
							<div class="col-lg-4">
								<div class="each-card <?=($ismine=='yes')? 'active' : '' ?>" id="<?=$val["card_id"]?>_card" onclick="collectNow(<?=$val['card_id']?>)">
									<img src="admin/cards/<?=$val["image"]?>" border="0" alt="" class="w-100">
									<div class="card-content">Collect Now</div>
								</div>
							</div>
						<?php }?>
					
					<!-- <div class="col-lg-4">
						<div class="each-card active">
							<img src="assets/images/425134051 2.png" border="0" alt="" class="w-100">
							<div class="card-content">Collect Now</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="each-card">
							<img src="assets/images/425134051 2.png" border="0" alt="" class="w-100">
							<div class="card-content">Collect Now</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="each-card">
							<img src="assets/images/425134051 2.png" border="0" alt="" class="w-100">
							<div class="card-content">Collect Now</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="each-card">
							<img src="assets/images/425134051 2.png" border="0" alt="" class="w-100">
							<div class="card-content">Collect Now</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="each-card">
							<img src="assets/images/425134051 2.png" border="0" alt="" class="w-100">
							<div class="card-content">Collect Now</div>
						</div>
					</div> -->
					<div class="col-lg-12 text-center mt-5 loadmore-button">
						<a href="" href="">Load More</a>
					</div>
				</div>
			</div>
		</section>
		
		</main>
		<!-- Modal -->
		<div class="modal fade common-modal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-close-icon" class="close" data-dismiss="modal" aria-label="Close"><img src="assets/images/Untitled design (65) 1.png" width="19" height="20" border="0" alt=""></div>
					<div class="modal-content-wrapper">
						<form>
							<div class="form-group row">
								<label for="staticEmail" class="col-sm-3 col-form-label">Login</label>
								<div class="col-sm-9">
									<input type="text" readonly class="form-control-plaintext">
								</div>
							</div>
							<div class="form-group row">
								<label for="inputPassword" class="col-sm-3 col-form-label">Password</label>
								<div class="col-sm-9">
									<input type="password" class="form-control" id="inputPassword">
								</div>
							</div>
							<div class="form-group row mb-0">
								<div class="col-sm-12 text-right submit-button">
									<button>Submit</button>
								</div>
							</div>
						</form>
					</div>
					<div class="register-feild text-center mt-2">
						<a href="" data-toggle="modal" data-target="#exampleModalCenter2">Click Here To Register</a>
					</div> 
				</div>
			</div>
		</div>
		<!-- End::Footer area -->
		<!-- All js links -->
		<script src="assets/js/swiper.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/custom.js"></script>
 		<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script>
			function collectNow(card_id)
			{
				<?php if(isset($_SESSION["user_id"])){ ?>
				$("#"+card_id+"_card").addClass("active");
				$.ajax({
					url:"ajax/collectcard.php",
					method:"POST",
					data:{card_id:card_id}
				}).done(function(response){
					swal("card collected","your card collected successfully","success");
				});
				<?php } else {
					?>
					swal("Login Failed","Your are not logged in","warning");
					<?php
				} ?>
			}
		</script>
	</body>
</html>