<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <meta charset="utf-8">
  
<style>
table, td {
border: 1px solid black;
}
    .m-r-1em{ margin-right:1em; }
    .m-b-1em{ margin-bottom:1em; }
    .m-l-1em{ margin-left:1em; }
    .mt0{ margin-top:0; }
	.nav-tabs{
 		background-color:DodgerBlue;
		text-color:white;
 	}
	.jumbotron{
 		background-color:DodgerBlue;
 	}
	.jumbotron h1{
		color: white;
	}

	.jumbotron p{
		color: white;
	}
	
	.tab-pane fade{
		text-color: black;
	}
	.nav nav-tabs{
		text-color: black;
	}
	.tab{
		text-color: black
	}
	
	.nav-tabs > li.active > a {
		text-color: black;
		font-size: 20px;
	}
		
	.nav-tabs > li > a {
		text-color: black
	}
	.h3 {
		text-color: white
	}
	 .p {
		text-color: white
	}
	
	.border-class
	{
		border:thin black solid;
		margin:20px;
		padding:20px;
	}
	.btn-xl {
    padding: 20px 20px;
    font-size: 20px;
    border-radius: 20px;
    
}

</style>
</head>
<body>
	<div class="jumbotron">
		<h3>View Attendance Roster</h3>
	</div>
<br>

<?php
require 'YourDBconnection.php';
$conn    = Connect();
$sql = "SELECT * FROM events ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row to table
  echo sql_to_html_table( $result, $delim="\n" ,$conn) ; //main function to write to html
    
} else {
    echo "0 results";
}

$conn->close();

//main function to write to html
function sql_to_html_table($sqlresult, $delim="\n",$conn) {
  // starting table
	
	$htmltable =  "<table class='table table-hover table-responsive table-bordered'>" . $delim ;   
	$counter   = 0 ;
		
		
    $sql1	=	"Select * from dates ";
	$result1 = $conn->query($sql1);
	$value1 = $result1->fetch_assoc();
	$ActualDate = $value1['ACTUALDATE'];
	
  // putting in lines
  while( $row = $sqlresult->fetch_assoc()  ){
    if ( $counter===0 ) {
      // table header
      $htmltable .=   "<tr>"  . $delim;
      foreach ($row as $key => $value ) {
          $htmltable .=   "<th bgcolor='DodgerBlue';>" . $key . "</th>"  . $delim ;
      }
	  $htmltable .=   "<th bgcolor='DodgerBlue'>" . 'Action' . "</th>"  . $delim ;
      $htmltable .=   "</tr>"  . $delim ; 
      
    } 
	$tempId=$row["ID"];
      
	  // table body
      $htmltable .=   "<tr>"  . $delim ;
      foreach ($row as $key => $value ) {
          $htmltable .=   "<td>" . $value . "</td>"  . $delim ;
      }
	    
		
		$htmltable .='<td><a class="btn btn-info m-r-1em" href="ReadGradeEv.php?id='.$row['ID'].'">View according to grade</a> ';
		$htmltable .='<a class="btn btn-primary m-r-1em" href="DownLoadEvent.php?id='.$row['ID'].'">DownLoad All in one Roster</a> ';
		$htmltable .='<a class="btn btn-primary m-r-1em" href="DLGradeEvent.php?id='.$row['ID'].'">DownLoad According to grade</a> ';
		
		
	
      
		$htmltable .=   "</tr>"   . $delim ;
	  
  }
  // closing table
  $htmltable .=   "</table>"   . $delim ; 
  // return
  return( $htmltable ) ; 
}




?> 

</body>
</html>