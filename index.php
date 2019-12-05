<?php include "../inc/dbinfo.inc"; ?>
<html>
<head>
<title>Youngchan's Blog</title>
<style>

hr {
	width : 60%;
	color : blue;
}

table {
	text-align : center;
	font-weight : bold;
}
span { 
	margin-top : 10%;
	font : italic bolder 100px consolas, sans-serif;
}
a {
 	text-decoration:none;
	color:#000000
}

form {
	margin: 0 auto; width:900px; 
}

div { text-align : center; }

html,body,{
        margin: 0;
        padding: 0;
	text-align : center;
}

header{
		padding-top : 7%;
                border: 0px solid #000000;
               	-moz-box-sizing: border-box; /* Firefox  */
                -webkit-box-sizing: border-box; /* Safari */
                box-sizing: border-box; /* CSS3 Standard */
	        text-align : center;
		background-size : 100% 600px;
              	height : 50%;
		background-image : url(https://cdn.pixabay.com/photo/2013/02/21/19/10/sea-84629_1280.jpg);
} 
</style>
</head>
<body>
    <header>
        <div >
              <span>Youngchan's Blog</span
	      <h1>Cloud Computing 적용사례(Option 5)</h1>           
        </div>
    </header>
<?php
  /* Connect to MySQL and select the database. */
  $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

  if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

  $database = mysqli_select_db($connection, DB_DATABASE);

  /* Ensure that the Employees table exists. */
  //VerifyEmployeesTable($connection, DB_DATABASE);

  /* If input fields are populated, add a row to the Employees table. */
  $employee_name = htmlentities($_POST['Name']);
  $employee_address = htmlentities($_POST['Address']);

  if (strlen($employee_name) || strlen($employee_address)) {
    AddEmployee($connection, $employee_name, $employee_address);
  }
?>

<div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">


<!-- Input form -->
<form action="<?PHP echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">
  <table border="0">
    <tr>
      <td>제목</td>
      <td>URL</td>
    </tr>
    <tr>
      <td>
        <input type="text" name="Name" maxlength="45" size="60" />
      </td>
      <td>
        <input type="text" name="Address" maxlength="90" size="60" />
      </td>
      <td>
        <input type="submit" value="추가" />
      </td>
    </tr>
  </table>
</form>

<?php

$result = mysqli_query($connection, "SELECT * FROM news");

while($query_data = mysqli_fetch_row($result)) {
	echo "<div class=post-preview><a href=", $query_data[2], "><h2 class=post-title>", 
        $query_data[0], ". ", $query_data[1],
       "</h2><h3 class=post-subtitle>",$query_data[2], "</h3></a></div><hr>";

}
?>
</div>
</div>
</div>



<!-- Clean up. -->
<?php

  mysqli_free_result($result);
  mysqli_close($connection);

?>

<script src="/webjars/jquery/2.1.3/dist/jquery.min.js"></script>
	<script src="/webjars/bootstrap/3.3.4/dist/js/bootstrap.min.js"></script>
	<script src="/webjars/origoni-startbootstrap-clean-blog/1.0.3/js/clean-blog.min.js"></script>

</body>
</html>


<?php

/* Add an employee to the table. */

function AddEmployee($connection, $name, $address) {
   $n = mysqli_real_escape_string($connection, $name);
   $a = mysqli_real_escape_string($connection, $address);

   $query = "INSERT INTO `news` (`title`, `url`) VALUES ('$n', '$a');";

   if(!mysqli_query($connection, $query)) echo("<p>Error adding employee data.</p>");
}

?>

