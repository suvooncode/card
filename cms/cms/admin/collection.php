<?php 
    include("../init.php");

     $table = "collection";
    if(isset($_POST["save"]))
    {
       
        $content = $_POST["content"];

        $f="content";
        $v=":content";
        $exe= array(":content"=>$content);
        $savecontent = save($table,$f,$v,$exe);
    }

    $findcontent = find("all",$table,"*","where 1 order by collection_content_id desc",array());
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
                            <form action="" method="POST">

                                <label for="">Add Collection Content</label>
                                <br>
                                <textarea name="content" col="10" row="7" class="form-control" id=""></textarea>
                                <br>
                                <button type="submit" class="btn btn-primary" name="save">Add Collection Content</button>

                            </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Collection</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="table display min-w850">
                                    <thead>
                                        <tr>
                                            <th>SR No.</th>
                                            <th>Content</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=0; foreach($findcontent as $k=>$v) { $i++; ?>
                                        <tr>
                                            <td><?=$i?></td>
                                            <td><?=$v["content"]?></td>
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
				swal("Content Added","Collection content added successfully","success");
			<?php } ?>
		});
	</script>
</body>
</html>