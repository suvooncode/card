<?php 
    include("../init.php");

    $table = "user_card_details as ucd inner join card_details as cd on ucd.card_id=cd.card_id inner join users as u on ucd.user_id=u.user_id";
    $findusers = find("all",$table,"*","where 1",array());
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>CARD</title>
    <!-- Favicon icon -->
    <?php include("csslink.php"); ?>
</head>
<body>
   <?php include("preloader.php") ?>

    <div id="main-wrapper">
        <?php include("navbar.php"); ?>
        <?php //include("chatbox.php"); ?>		
        <?php include("header.php"); ?>
        <?php include("sidebar.php"); ?>
        <!-----maincontent start----->
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
                <div class="row mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Users Card Collection</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="table display min-w850">
                                    <thead>
                                        <tr>
                                            <th>SR No.</th>
                                            <th>Card Name</th>
                                            <th>Card</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Collected On</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $i=0; foreach($findusers as $k=>$v) { $i++; 
                                            $collected_on = date("d-M-Y",strtotime($v["collected_on"]));
                                        ?>
                                        <tr>
                                            <td><?=$i?></td>
                                            <td><?=$v["card_name"]?></td>
                                            <td><a href="cards/<?=$v["image"]?>" target="_blank"> <img src="cards/<?=$v["image"]?>" height="100px" width="50px"></a></td>
                                            <td><?=$v["name"]?></td>
                                            <td><?=$v["email"]?></td>
                                            <td><?=$collected_on?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-------main content end----->
        <?php include("footer.php"); ?>
    </div>
    <?php include("jslink.php"); ?>
	<?php include("indexjs.php") ?>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
		$(function(){
			<?php if($savecontent) { ?>
				swal("Card Added","Process content added successfully","success");
			<?php } ?>
		});
	</script>
</body>
</html>