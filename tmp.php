<?php
	$mysqli = new mysqli("localhost","root","","database");
	
	if ($mysqli -> connect_errno) {
	  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
	  exit();
	}
	
	$sql = "SELECT COUNT(user_id) as total FROM posts WHERE user_id=3";
	$result = mysqli_query($mysqli,$sql);
	$row = $result->fetch_assoc();
	echo $row['total'];
?>




<!DOCTYPE html>
<html>
<head>
<link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet"
                href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                <link rel="stylesheet" href="style.css">

        <meta name="viewport" content="width=device-width, initial-scale=1">
		<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
		<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
		<meta charset=utf-8 />
		<style type="text/css">
			.pic{
		        padding-left: 10px;
		        font-family: cursive;
		        font-size: 20px;
		        font-weight: 900;
		        color: white;
		        background-color: black;
			}
			.pic:hover{
		        color: red;
			}
		</style>

</head>
<body>
	<label id="select" for="imageUpload" class="sidebar-item sidebar-button label" onclick="selected()">Select a Picture</label>
    <input type="file" id="imageUpload" accept="image/*" style="display: none" name="uploadfile" onchange="readURL(this);">
    <img id="blah" src="#" alt="" style="height: 100px;width: 100px;object-fit: contain;" />
    <label class="pic">hi</label>
</body>

<script type="text/javascript">
	     function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(150)
                        .height(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>

</html>