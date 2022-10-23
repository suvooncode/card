<?php 
    include("../init.php");

    $table = "users";

    if(isset($_POST['update']))
    {
        //print_r($_POST);exit;
        $userid = $_POST['userid'];
        $name = $_POST['name'];
        $email = $_POST['email'];

        $update = update('users','name=:name,email=:email','where user_id="'.$userid.'" ',array(':name'=>$name,':email'=>$email));
        
    }


    $findusers = find("all",$table,"*","where 1 order by user_id desc",array());
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
                            <h4 class="card-title">Users</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="table display min-w850">
                                    <thead>
                                        <tr>
                                            <th>SR No.</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Created On</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $i=0; foreach($findusers as $k=>$v) { $i++; 
                                            $created_date = date("d-M-Y",strtotime($v["created_on"]));
                                        ?>
                                        <tr>
                                            <td><?=$i?></td>
                                            <td><?=$v["name"]?></td>
                                            <td><?=$v["email"]?></td>
                                            <td><?=$created_date?></td>
                                            <td><button class='btn btn-primary' onclick="edit_user(<?=$v['user_id']?>)">Edit</button> </td>
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

        <!--------Modal------->
        <div class="modal fade common-modal" id="exampleModalCenter" tabindex="-1" role="dialog"
		aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
            <div class="modal-header" style="border:none">
                <!-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
				<div class="modal-content-wrapper">
					<strong style="color:green;"><?=$response?></strong>
					<form action="" method="POST" style="width:95%;margin-left:5%">
                        <div class="form-group ">
                            <input type="hidden" id='userid' name="userid" >
							<label for="staticEmail" >Name</label>
							
								<input type="text" id='name' name="name" class="form-control-plaintext">
							
						</div>
						<div class="form-group ">
							<label for="staticEmail" >Email</label>
							
								<input type="email" id='email' name="email" class="form-control-plaintext">
							
						</div>
						
						<div class="form-group  mb-3">
							<div class="col-sm-12 text-right submit-button">
								<button class='btn btn-primary' type="submit" id='update' name="update" >Update</button>
							</div>
						</div>
					</form>
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

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>

    <style>
        .form-control-plaintext
        {
            border: 1px solid gray;
            width: 95%;
        }
    </style>
    <script>
		$(function(){
			<?php if($savecontent) { ?>
				swal("Content Added","Process content added successfully","success");
			<?php } ?>

            <?php if($update) { ?>
				swal("User updated","User updated successfully","success");
			<?php } ?>

            $('#example3').DataTable();
		});

        function edit_user(userid)
        {
            $('#userid').val(userid);

            $.ajax({
                url:"ajax/get_user.php",
                method:"POST",
                data:{userid:userid}
            }).done(function(response){
                var data = JSON.parse(response);
                console.log(data['name']);
                $('#name').val(data['name']); $('#email').val(data['email']);
                $('#exampleModalCenter').modal('show');
                
            });
        }
	</script>
</body>
</html>