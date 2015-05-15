<?php
session_start();

if (!$_SESSION["valid_user"])
{
    // User not logged in, redirect to login page
    Header("Location: index.php");
}
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset-utf-8" />
    <title>Fidelity</title>
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link href="css/fileuploader.css" rel="stylesheet" type="text/css">	
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
</head>

<body>

<?php
include 'lib/dbConn.php';

if(isset($_GET['d_id']) )
{
	$delete = "DELETE FROM promotion WHERE id=".$_GET['d_id'];
	mysql_query($delete);
}

echo "<h4>Fidelity</h4>";
echo "<span class=\"label label-success\">Hola ".strtoupper($_SESSION["valid_user"])."!</span><br><br>";
echo "<span class=\"label label-warning\">Ingresaste por ultima vez ".date("d/m/Y", $_SESSION["valid_time"])."</span><br><br>";
echo "<br>";

$sql = "SELECT p.*, c.name as category_name FROM promotion p LEFT JOIN category c ON p.id_category=c.id WHERE p.id_brand=" . $_SESSION["valid_id"];
$result = mysql_query($sql);

	echo "<table class='table table-striped'>";
	echo "<tr align='center'>";
	echo "<td>Promo Name</td>";
	echo "<td>Category</td>";
    echo "<td>Logo</td>";
	echo "<td>Address</td>";
	echo "<td>Discount</td>";
	//echo "<td>Distance(Km)</td>";
	echo "<td>Short Desc</td>";
	echo "<td>Long Desc</td>";
	echo "<td>Date from</td>";
	echo "<td>Date to</td>";
	echo "<td>Edit</td>";
	echo "<td>Delete</td>";
	echo "</tr>";	
 

while($row = mysql_fetch_array($result))
{
	echo "<tr>";
	echo "<td>" . $row['name'] . "</td>";
	echo "<td>" . $row['category_name'] . "</td>";
    echo "<td><img  src=\"/imgs/". $row['logo_img'] . "\" alt=\"Londres 2012 tiro con arco\" width=114 height=41/> </td>";
	echo "<td>" . $row['address'] . "</td>";
	echo "<td>" . $row['discount'] . "</td>";
	//echo "<td>" . $row['distanceKm'] . "</td>";
	echo "<td>" . $row['shortDesc'] . "</td>";
	echo "<td>" . $row['longDesc'] . "</td>";
	echo "<td>" . $row['dateFrom'] . "</td>";
	echo "<td>" . $row['dateTo'] . "</td>";
	echo "<td><a href=\"editPromo.php?e_id=".$row['id']."\">Edit</a></td>";
	echo "<td><a href=\"promotion.php?d_id=".$row['id']."\">Delete</a></td>";
	echo "</tr>";	
}
?>
</table>
<? 

// Add a promo
echo "<a href=\"addPromo.php\" class=\"btn btn-info btn-sm\" role=\"button\">Add Promo</a>";

// Display logout link
echo "<a href=\"logout.php\"><button type=\"button\" class=\"btn btn-link\">Click here to logout!</button></a>";
?>
	<div
		class="overlay" id="overlay" style="display: none;"></div>
	<div class="box" id="box">
		<a class="boxclose" id="boxclose"></a>
		<div id="box-text"></div>
	</div>

	<script type="text/javascript">
            $(function() {
                $('#activator').click(function(){
                	$.get("addPromo.php", function(data){
                		$('#box-text').html(data);
                		createUploader; 
                		});
                	
                   	 $('#overlay').fadeIn('fast',function(){
                   	 $('#box').animate({'top':'100px'},500);
                  });
                });
                $('#boxclose').click(function(){
                    $('#box').animate({'top':'-1000px'},500,function(){
                        $('#overlay').fadeOut('fast');
                    });
                });
            });
    </script>
        
    <script src="js/fileuploader.js" type="text/javascript"></script>
    <script>        
        function createUploader(){            
            var uploader = new qq.FileUploader({
                element: document.getElementById('logo_image'),
                listElement: document.getElementById('separate-list'),
                action: 'php.php'
            });           
        }      
    </script> 
</body>
</html>