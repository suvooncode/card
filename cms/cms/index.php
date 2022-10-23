<?php 
 	include("init.php");

	$response= "";
    $response_status = "none";

	if(isset($_POST["login"]))
	{
		$email = $_POST["email"];
		$password= $_POST["password"];
		$response= "This credential is not found";
		$response_status = "error";

		$find= find("all","users","*"," where email='$email' and password='$password'",array());

		if($find)
		{
			$finduser=  find("first","users","*"," where email='$email' and password='$password' and confirm_password='$password'",array());

			if($finduser["is_admin"]=="Y")
			{
				$_SESSION["type"]= "admin";
				redirectfn("admin/index.php");
			}
			else {
				$_SESSION["type"]= "user";
				redirectfn("all_cards");
			}
			$_SESSION["user_id"]=$finduser["user_id"];
			$_SESSION["email"]=$finduser["email"];
			$_SESSION["name"]= $finduser["name"];

			$response= "Login Successfull";
			$response_status = "success";
			
		}
		else
		{
			$response= " This credential is not found";
			$response_status = "error";
		}
	}

	

	if(isset($_POST["save"]))
	{
		$name= $_POST["name"];
		$email= $_POST["email"];
		$password= $_POST["password"];
		$conf_password= $_POST["conf_password"];

		$fields = "name,email,password,confirm_password";
		$values = ":name,:email,:password,:confirm_password";
		$exe = array(
			":name"=>$name,
			":email"=>$email,
			":password"=>$password,
			":confirm_password"=>$conf_password
		);

		$save_user = save("users",$fields,$values,$exe);
	}

	$findmain = find("first","main_content","*","where 1 order by main_content_id desc",array());
	$findrecent = find("first","recent_cards","*","where 1 order by recent_content_id desc",array());
	$findprocess = find("first","process","*","where 1 order by process_content_id desc",array());
	$findinfo = find("first","information","*","where 1 order by info_content_id desc",array());
	$findcollection = find("first","collection","*","where 1 order by collection_content_id desc",array());

	$findrecentcards = find("all","card_details","*","where 1 order by card_id desc limit 3",array());
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
	<title>AdamJoshi</title>
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
						<a href=""><img src="assets/images/logo 1.png" border="0" alt="">Card</a>
					</div>
				</div>
				<div class="col-6">
					<div class="login-button text-right">
						<?php if(isset($_SESSION["name"])){
							?>
							<a href="logout">Hi <?=$_SESSION["name"]?> Logout !</a>
							<?php
						}else{
							?>
						<a href="" href="" data-toggle="modal" data-target="#exampleModalCenter">Login</a>
							<?php
						}
						?>
						
						
					</div>
				</div>
			</div>
		</div>
	</header>
	<!-- End::Header area -->
	<main>
		<section class="banner-area common-background-style" style="background-image:url(assets/images/Banner.jpg)">
			<div class="container">
				<div class="banner-content">
					<div class="banner-content-wrapper">
						<h2><em>Adamjoshi</em></h2>
						<h1>Collect & <span class="">Manage</span> <br> Your Cards</h1>
						<p>Find Your Perfect Card & Collect Now</p>
						<?php if(isset($_SESSION["name"])){
							?>
							<a href="">Hi <?=$_SESSION["name"]?></a>
							<?php
						}else{
							?>
						<a href="" href="" data-toggle="modal" data-target="#exampleModalCenter">Login</a>
							<?php
						}
						?>
						
					</div>
				</div>
			</div>
		</section>
		<section class="about-area">
			<div class="container text-center">
				<h2>Adam <span>Joshi</span></h2>
				<!-- <p>Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a
					typeface without relying on meaningful content. </p> -->
					<p><?=$findmain["content"]?></p>
					
			</div>
		</section>
		<section class="recent-cards-area common-background-style"
			style="background-image:url('assets/images/just_gamer_bg 1.png')">
			<div class="container">
				<div class="row">
					<div class="col-lg-9">
						<div class="recent-cards-text">
							<h2>Recent Cards</h2>
							<!-- <p>Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a
								document or a typeface without relying on meaningful content. </p> -->
							<p><?=$findrecent["content"]?></p>	

							<div class="login-button ">
								<a href="all_cards">All Cards</a>
							</div>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="card-slider">
							<div class="swiper-container">
								<div class="swiper-wrapper">
									<?php foreach($findrecentcards as $key=>$val) { ?>
									<div class="swiper-slide">
										<div class="card-image text-center">
											<img src="admin/cards/<?=$val["image"]?>" border="0" height="293px" width="195px" alt="" class="mw-100">
										</div>
									</div>
									<?php } ?>
									<!-- <div class="swiper-slide">
										<div class="card-image text-center">
											<img src="assets/images/42513405 2.png" border="0" alt="" class="mw-100">
										</div>
									</div> -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="services-area">
			<div class="container">
				<div class="row">
					<div class="col-lg-4">
						<div class="each-services">
							<h4>Information</h4>
							<!-- <p>Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a
								document or a typeface without relying on meaningful content. </p> -->
							<p><?=$findinfo["content"]?></p>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="each-services">
							<h4>Process</h4>
							<!-- <p>Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a
								document or a typeface without relying on meaningful content. </p> -->
							<p><?=$findprocess["content"]?></p>		
						</div>
					</div>
					<div class="col-lg-4">
						<div class="each-services">
							<h4>Collection</h4>
							<!-- <p>Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a
								document or a typeface without relying on meaningful content. </p> -->
							<p><?=$findcollection["content"]?></p>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="newsletter-area">
			<div class="container">
				<div class="newsletter-wrapper d-flex align-items-center justify-content-center ml-auto mr-auto">
					<div class="newsletter-heading">
						<h3>Our Newsletter</h3>
					</div>
					<div class="news-letter-form">
						<form class="d-flex align-items-center">
							<input type="text" />
							<button>Subscribe</button>
						</form>
					</div>
				</div>
			</div>
		</section>
	</main>
	<!-- Footer area -->
	<footer class="footer-area common-background-style" style="background-image:url('assets/images/s_footer_bg 1.png')">
		<div class="container">
			<div class="row">
				<div class="col-lg-3">
					<div class="logo-area">
						<a href=""><img src="assets/images/logo 1.png" border="0" alt="">Card</a>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="footer-middle-content text-center">
						<p>Lorem ipsum is a placeholder text commonly used to demonstrate the Lorem ipsum is a
							placeholder text commonly used </p>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="footer-social text-lg-right">
						<h5>Follow Us</h5>
						<ul>
							<li><a href=""><img src="assets/images/fb.png" width="33" height="33" border="0" alt=""></a>
							</li>
							<li><a href=""><img src="assets/images/instra.png" width="33" height="33" border="0"
										alt=""></a></li>
							<li><a href=""><img src="assets/images/twiter.png" width="33" height="32" border="0"
										alt=""></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- Modal -->
	<div class="modal fade common-modal login-modal" id="exampleModalCenter" tabindex="-1" role="dialog"
		aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-close-icon" class="close" data-dismiss="modal" aria-label="Close"><img
						src="assets/images/Untitled design (65) 1.png" width="19" height="20" border="0" alt=""></div>
				<div class="modal-content-wrapper">
					<strong style="color:green;"><?=$response?></strong>
					<form action="" method="POST">
						<div class="form-group row">
							<label for="staticEmail" class="col-sm-3 col-form-label">Login</label>
							<div class="col-sm-9">
								<input type="email" name="email" class="form-control-plaintext">
							</div>
						</div>
						<div class="form-group row">
							<label for="inputPassword" class="col-sm-3 col-form-label">Password</label>
							<div class="col-sm-9">
								<input type="password" name="password" class="form-control" id="inputPassword">
							</div>
						</div>
						<div class="form-group row mb-0">
							<div class="col-sm-12 text-right submit-button">
								<button type="submit" name="login">Login</button>
							</div>
						</div>
					</form>
				</div>
				<div class="register-feild text-center mt-2">
					<a href="" data-toggle="modal" data-target="#exampleModalCenter2">Click Here To Register</a>
					<br>
					<a href="" data-toggle="modal" data-target="#exampleModalCenter3" onclick='login_modal_hide()'>Forgot Password?</a>
					
				</div>

			</div>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade common-modal" id="exampleModalCenter2" tabindex="-1" role="dialog"
		aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-close-icon" class="close" data-dismiss="modal" aria-label="Close"><img
						src="assets/images/Untitled design (65) 1.png" width="19" height="20" border="0" alt=""></div>
				<div class="modal-content-wrapper">
					<form action="" method="POST">
						<div class="form-group row">
							<label for="staticEmail" class="col-sm-3 col-form-label">Name</label>
							<div class="col-sm-9">
								<input type="text" name="name" class="form-control-plaintext" id="staticEmail">
							</div>
						</div>
						<div class="form-group row">
							<label for="staticEmail" class="col-sm-3 col-form-label">Email</label>
							<div class="col-sm-9">
								<input type="email" name="email" class="form-control-plaintext" id="staticEmail">
							</div>
						</div>
						<div class="form-group row">
							<label for="inputPassword" class="col-sm-3 col-form-label">Password</label>
							<div class="col-sm-9">
								<input type="password" name="password" id="pass" class="form-control">
							</div>
						</div>
						<div class="form-group row">
							<label for="inputPassword" class="col-sm-3 col-form-label">Confirm <br> Password</label>
							<div class="col-sm-9">
								<input type="password" name="conf_password" onkeyup="checkpass(this.value)" id="conf_pass" class="form-control">
								<br>
								<span id="response"></span>
							</div>
						</div>
						<div class="form-group row mb-0">
							<div class="col-sm-12 text-right submit-button">
								<button type="submit" name="save">Submit</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade common-modal" id="exampleModalCenter3" tabindex="-1" role="dialog"
		aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-close-icon" class="close" data-dismiss="modal" aria-label="Close"><img
						src="assets/images/Untitled design (65) 1.png" width="19" height="20" border="0" alt=""></div>
				<div class="modal-content-wrapper">
					<strong style="color:green;"><?=$response?></strong>
					<form action="" method="POST">
						<div class="form-group row">
							<label for="staticEmail" class="col-sm-3 col-form-label">Email</label>
							<div class="col-sm-9">
								<input type="email" id='forgot_email' name="email" class="form-control-plaintext">
							</div>
						</div>
						
						<div class="form-group row mb-0">
							<div class="col-sm-12 text-right submit-button">
								<button type="button" id='change_password' name="change_password" >Change Password</button>
							</div>
						</div>
					</form>
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

	<style>
		.form-control-plaintext
		{
			color:white;
		}
	</style>
	<script>
		$(function(){
			<?php if($save_user) { ?>
				swal("User Registered","user registered successfully","success");
			<?php } ?>

			$('#change_password').click(function(){
				
				var forgot_email = $('#forgot_email').val();

				$.ajax({
					url:"ajax/forgot_password.php",
					method:"POST",
					data:{forgot_email:forgot_email}
				}).done(function(response){
					
					$('#exampleModalCenter3').modal('hide');
					swal("","Password updated successfully. Kindly check your mail","success");
				});
			})
		});

		function checkpass(conf_pass)
		{
			var pass = $("#pass").val();
			if(pass==conf_pass)
			{
				$("#response").html("<p style='color:green'>Password Matched 👍</p>");
			}
			else
			{
				$("#response").html("<p style='color:red'>Password is not matching !</p>");
			}
		}

		function login_modal_hide()
		{
			$('.login-modal').modal('hide');
		}

		

	</script>
	
</body>

</html>