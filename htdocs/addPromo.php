<?php session_start(); ?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset-utf-8" />
	<title>Fidelity</title>
	<link href="css/fileuploader.css" rel="stylesheet" type="text/css">	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
</head>
<body>

	<script type="text/javascript">
        function submitform()
        {
            var file = $('.qq-upload-file').html();
        	$('#logo').val(file);
          	document.forms["promo-form"].submit();
        }
    </script>

	<p>&nbsp;</p>
	<div id="content" style="width:30%; margin:10px">
		<h2>Add your Promo</h2>

		<?php
		include 'lib/dbConn.php';
		include 'lib/strUtils.php';

		if(isset($_POST['addPromo']) )
		{
			//Realy nasty, each field has to be validated
			$id_category = stripslashes( $_REQUEST['id_category'] );
			$name = stripslashes( $_REQUEST['name'] );
			$logo_img = stripslashes( $_REQUEST['logo'] );
			$address = stripslashes( $_REQUEST['address'] );
			$discount = stripslashes( $_REQUEST['discount'] );
			$distanceKm = 0;//stripslashes( $_REQUEST['distanceKm'] );
			$shortDesc = stripslashes( $_REQUEST['shortDesc'] );
			$longDesc = stripslashes( $_REQUEST['longDesc'] );
			$from = stripslashes( $_REQUEST['from'] );	
			$to =	stripslashes( $_REQUEST['to'] );		
			
			$insert = "INSERT INTO promotion(id_brand, id_category, name,logo_img,address,discount,distanceKm,shortDesc,longDesc,dateFrom,dateTo)
			VALUES(".$_SESSION["valid_id"].",".$id_category.",'".$name."','".$logo_img."','".$address."','".$discount."'
			,".$distanceKm.",'".$shortDesc."','".$longDesc."','".$from."','".$to."')";
			
			mysql_query($insert);
			?>
			<script type="text/javascript"> top.location.href='promotion.php'</script>
			<?	
		}
		?>

		<form role="form" id="promo-form" name="promo-form" action="addPromo.php" method="post">
			<div class="form-group">
  			
  			<label for="name">Name</label>
    		<input name="name" id="name" type="text" class="form-control" placeholder="Name">

			<p>
				<div id="logo_image"></div>
				<ul id="separate-list"></ul>
				<input type="hidden" name="logo" id="logo" value="" />
			</p>

  			<label for="address">Address</label>
    		<input name="address" id="address" type="text" class="form-control" placeholder="Address">

  			<label for="discount">Discount</label>
    		<input name="discount" id="discount" type="text" class="form-control" placeholder="Discount">

			<!--label for="distanceKm">Distance</label>
    		<input name="distanceKm" id="distanceKm" type="text" class="form-control" placeholder="Distance Km"-->
			
			<label for="sel1">Category:</label>
			<select class="form-control" id="id_category" name="id_category">
			<?php
				$sql = "SELECT id, name FROM category ORDER BY name asc";
				$query =  mysql_query ($sql);
				while ( $resultado = mysql_fetch_array($query)){
					echo "<option value='".$resultado['id']."'> ". $resultado['name']."</option>";
			}
			?>
			</select>

			<label for="shortDesc">Short Description</label>
    		<input name="shortDesc" id="shortDesc" type="text" class="form-control" placeholder="Short Desc.">

			<label for="longDesc">Long Description</label>
    		<textarea class="form-control" rows="3" name="longDesc" id="longDesc"></textarea>

			<label for="from">Date from</label>
    		<input name="from" id="from" type="date" class="form-control" placeholder="Date from">

			<label for="to">Date to</label>
    		<input name="to" id="to" type="date" class="form-control" placeholder="Date to">
			
			<br/>
			<input type="hidden" id="addPromo" name="addPromo" value="Add Promo" />
			<a href="javascript: submitform()" class="btn btn-info btn-sm">Add Promo</a>
			
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
