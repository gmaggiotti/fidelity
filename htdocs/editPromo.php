<?php session_start(); ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset-utf-8" />
<title>Fidelity</title>
<!--script type="text/javascript" src="js/jquery-1.7.2.min.js"></script-->
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<link href="css/fileuploader.css" rel="stylesheet" type="text/css">	
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>

<body>

	<script type="text/javascript">
        function submitform()
        {
            var file = $('.qq-upload-file').html();
            if(file !=null)
        		$('#logo').val(file);
          	document.forms["promo-form"].submit();
        }
    </script>

	<p>&nbsp;</p>
	<div id="content" style="width:30%; margin:10px">
		<h2>Edit your Promo</h2>

		<?php
		include 'lib/dbConn.php';
		include 'lib/strUtils.php';
		
		if(isset($_POST['editPromo']) )
		{
			//Realy nasty, each field has to be validated

			$id = stripslashes( $_REQUEST['editPromo'] );
			$name = stripslashes( $_REQUEST['name'] );
			$logo_img = stripslashes( $_REQUEST['logo'] );
			$address = stripslashes( $_REQUEST['address'] );
			$discount = stripslashes( $_REQUEST['discount'] );
			$distanceKm = stripslashes( $_REQUEST['distanceKm'] );
			$shortDesc = stripslashes( $_REQUEST['shortDesc'] );
			$longDesc = stripslashes( $_REQUEST['longDesc'] );
			$from = stripslashes( $_REQUEST['from'] );
			$to =	stripslashes( $_REQUEST['to'] );

			$update = "UPDATE  promotion SET name='".$name."',logo_img='".$logo_img."',address='".$address."',discount='".$discount."',distanceKm='".$distanceKm."',shortDesc='".$shortDesc."',longDesc='".$longDesc."',dateFrom='".$from."',dateTo='".$to."'
			 WHERE id=$id";
			echo $update;
 			mysql_query($update);

 			?>
			<script type="text/javascript"> top.location.href='promotion.php'</script>
			<?			
 	
		}

		if(isset($_GET['e_id']) )
		{
			$sql = "SELECT * FROM promotion WHERE id=".$_GET['e_id'];
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);
		}
		?>
		
		<form role="form" id="promo-form" name="promo-form" action="editPromo.php" method="post">
			<div class="form-group">
  			
  			<label for="name">Name</label>
    		<input name="name" id="name" type="text" class="form-control" placeholder="Name" value="<? echo $row['name']?>" />
			<p>
				<div id="logo_image"></div>
				<ul id="separate-list"><?echo $row['logo_img']?></ul>
				<input type="hidden" name="logo" id="logo" value="<? echo $row['logo_img']?>" />
			</p>

  			<label for="address">Address</label>
    		<input name="address" id="address" type="text" class="form-control" placeholder="Address" value="<? echo $row['address']?>" />

  			<label for="discount">Discount</label>
    		<input name="discount" id="discount" type="text" class="form-control" placeholder="Discount" value="<? echo $row['discount']?>" />

			<label for="distanceKm">Distance</label>
    		<input name="distanceKm" id="distanceKm" type="text" class="form-control" placeholder="Distance Km" value="<? echo $row['distanceKm']?>" />

			<label for="shortDesc">Short Description</label>
    		<input name="shortDesc" id="shortDesc" type="text" class="form-control" placeholder="Short Desc." value="<? echo $row['shortDesc']?>" />

			<label for="longDesc">Long Description</label>
    		<textarea class="form-control" rows="3" name="longDesc" id="longDesc"><?php echo $row['longDesc']?></textarea>

			<label for="from">Date from</label>
    		<input name="from" id="from" type="date" class="form-control" placeholder="Date from" value="<? echo $row['dateFrom']?>" />

			<label for="to">Date to</label>
    		<input name="to" id="to" type="date" class="form-control" placeholder="Date to" value="<? echo $row['dateTo']?>" />
			
			<br/>
			
			<input type="hidden" id="editPromo" name="editPromo" value="<? echo $row['id']?>" />
			<a href="javascript: submitform()" class="btn btn-info btn-sm">Edit Promo</a>
			
			</div>
		</form>
	</div>
	
	   <script src="js/fileuploader.js" type="text/javascript"></script>
    <script>        
        function createUploader(){            
            var uploader = new qq.FileUploader({
                element: document.getElementById('logo_image'),
                listElement: document.getElementById('separate-list'),
                action: 'php.php'
            });           
        }     
        window.onload = createUploader; 
        
    </script> 
</body>
</html>
