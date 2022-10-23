<?php 
    include("../init.php");

     $table = "card_details";
    if(isset($_POST["save"]))
    {
        $card_name = $_POST["card_name"];
        $filename = $_FILES["file"]["name"];
        $filetempname = $_FILES['file']['tmp_name'];

        $f="card_name,image";
        $v=":card_name,:image";
        $exe= array(":card_name"=>$card_name,":image"=>$filename);
        $savecontent = save($table,$f,$v,$exe);

         if($savecontent)
        {
            move_uploaded_file($filetempname, "cards/" . $filename);
        } 
    }

    $findcontent = find("all",$table,"*","where 1 order by card_id desc",array());
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
				<div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                            <form action="" method="POST" enctype="multipart/form-data">

                                <label for="">Card Name :</label>
                                <br>
                                <input type="text" name="card_name" class="form-control" id="">
                                <br>
                                <img id="imgPreview" src="#" alt="preview" height="500px" width="300px"/>
                                <input type="file" accept="image/png,image/jpeg" name="file" class="form-control" id="photo">
                                <br>
                                <button type="submit" class="btn btn-primary" name="save">Add card</button>

                            </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Cards</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="table display min-w850">
                                    <thead>
                                        <tr>
                                            <th>SR No.</th>
                                            <th>Card name</th>
                                            <th>Card</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=0; foreach($findcontent as $k=>$v) { $i++; ?>
                                        <tr>
                                            <td><?=$i?></td>
                                            <td><?=$v["card_name"]?></td>
                                            <td><a href="cards/<?=$v["image"]?>" target="_blank"> <img src="cards/<?=$v["image"]?>" height="100px" width="50px"></a></td>
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
				swal("Card Added","Recent content added successfully","success");
			<?php } ?>

            $('#photo').change(function(){
                const file = this.files[0];
                console.log(file);
                if (file){
                let reader = new FileReader();
                reader.onload = function(event){
                    console.log(event.target.result);
                    $('#imgPreview').attr('src', event.target.result);
                }
                reader.readAsDataURL(file);
                }
            });

		});


        
	</script>
</body>
</html>