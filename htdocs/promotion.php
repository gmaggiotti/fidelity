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

   <!--style>  
        a.back{
            width:256px;
            height:73px;
            position:fixed;
            bottom:15px;
            right:15px;
            background:#fff url(codrops_back.png) no-repeat top left;
            z-index:1;
            cursor:pointer;
        }
        /* Style for overlay and box */
        .overlay{
            background:transparent url(overlay.png) repeat top left;
            position:fixed;
            top:0px;
            bottom:0px;
            left:0px;
            right:0px;
            z-index:100;
        }
        .box{
            position:fixed;
            top:-200px;
            left:30%;
            right:30%;
            background-color:#fff;
            color:#7F7F7F;
            padding:20px;
            border:2px solid #ccc;
            -moz-border-radius: 20px;
            -webkit-border-radius:20px;
            -khtml-border-radius:20px;
            -moz-box-shadow: 0 1px 5px #333;
            -webkit-box-shadow: 0 1px 5px #333;
            z-index:101;
        }
        .box h1{
            border-bottom: 1px dashed #7F7F7F;
            margin:-20px -20px 0px -20px;
            padding:10px;
            background-color:#FFEFEF;
            color:#EF7777;
            -moz-border-radius:20px 20px 0px 0px;
            -webkit-border-top-left-radius: 20px;
            -webkit-border-top-right-radius: 20px;
            -khtml-border-top-left-radius: 20px;
            -khtml-border-top-right-radius: 20px;
        }
        a.boxclose{
            float:right;
            width:26px;
            height:26px;
            background:transparent url(cancel.png) repeat top left;
            margin-top:-30px;
            margin-right:-30px;
            cursor:pointer;
        }

    </style-->

</head>

<body>

<?php
include 'lib/dbConn.php';


if (!$_SESSION["valid_user"])
{
	// User not logged in, redirect to login page
	Header("Location: index.php");
}

if(isset($_GET['d_id']) )
{
	$delete = "DELETE FROM promotion WHERE id=".$_GET['d_id'];
	mysql_query($delete);
}

// Display Member information
//echo "<p>User ID: " . $_SESSION["valid_id"];
//echo "<p>Username: " . $_SESSION["valid_user"];
//echo "<p>Brand: " . $_SESSION["brand"];
//echo "<p>Logged in: " . date("m/d/Y", $_SESSION["valid_time"]);

echo "<h4>Fidelity</h4>";
echo "<span class=\"label label-success\">Hola ".strtoupper($_SESSION["valid_user"])."!</span><br><br>";
echo "<span class=\"label label-warning\">Ingresaste por ultima vez ".date("m/d/Y", $_SESSION["valid_time"])."</span><br><br>";
echo "<br>";

$result = mysql_query("SELECT * FROM promotion WHERE id_brand=" . $_SESSION["valid_id"]);


	echo "<table class='table table-striped'>";
	echo "<tr align='center'>";
	echo "<td>Promo Name</td>";
	echo "<td>Logo</td>";
	echo "<td>Address</td>";
	echo "<td>Discount</td>";
	echo "<td>Distance(Km)</td>";
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
	echo "<td><img  src=\"/imgs/". $row['logo_img'] . "\" alt=\"Londres 2012 tiro con arco\" width=114 height=41/> </td>";
	echo "<td>" . $row['address'] . "</td>";
	echo "<td>" . $row['discount'] . "</td>";
	echo "<td>" . $row['distanceKm'] . "</td>";
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
//echo "<p><a href=\"addPromo.php\">Add a promo</a></p>";
echo "<a href=\"addPromo.php\" class=\"btn btn-info btn-sm\" role=\"button\">Add Promo</a>";

// Display logout link
echo "<a href=\"logout.php\"><button type=\"button\" class=\"btn btn-link\">Click here to logout!</button></a>";
//echo "<p><a href=\"logout.php\">Click here to logout!</a></p>";
?>
	<!--a class="activator" id="activator">Add</a-->
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