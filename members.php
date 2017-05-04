<?php
error_reporting(1);
  session_start();
  ob_start();
  if ( $_SESSION["firstName"]==NULL || $_SESSION["lastName"]==NULL ) {
    session_destroy();
    header("url:'index.php'");
  }
  $connection = mysqli_connect('localhost','root','','experiment');
  
  if( isset($_POST['register-submit']) )
  {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "INSERT INTO `information` (`firstName`, `lastName`, `email`, `password`) VALUES ('$firstName', '$lastName', '$email', '$password')";
    $res = mysqli_query($connection,$sql);
  }

  if ( isset($_POST['changeSubmit']) ){
    $NAME = explode(" ", $_POST['changedName']);
    $firstName = $NAME[0];
    $lastName = $NAME[1];
    $email = $_POST['changedEmail'];
    $ID = $_POST['ID'];
    $sql = "UPDATE `information` SET `firstName` = '$firstName', `lastName` = '$lastName', `email` = '$email' WHERE `information`.`id` = '$ID'";
    $res = mysqli_query($connection,$sql);
  }

  $query = "SELECT id,firstName,lastName,email FROM information";
  $result = mysqli_query($connection,$query);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>TASK 2017</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/styles.css" rel="stylesheet">
	</head>
	<body style="background-color: black;">
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">TASK <strong>2017</strong></a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span><img class="navbar-image" src="icons/user.ico"></span>&nbsp<?php echo $_SESSION["firstName"]." ".$_SESSION["lastName"]; ?></a></li>
    </ul>
  </div>
</nav>

<div class="wrapper">
    <div class="box">
        <div class="row">
            <!-- sidebar -->
            <div class="column col-sm-3" id="sidebar">
                <ul class="nav">
                    <li class="active"><a><img class="person-icon" src="icons/member.png"> Members</a>
                    </li>
                </ul>
            </div>
            <!-- /sidebar -->
          
            <!-- main -->
            <div class="column col-sm-9" id="main">
                    <div id="page-content">
                      <div class="col-md-2 col-md-offset-10 padding"><button class="btn" id="btn-add-member" data-toggle="modal" data-target="#addModal">Add Member</button></div>
                      <!-- Modal -->
<div id="addModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center">Add a Member</h4>
      </div>
      <style type="text/css">
        .modal-body input[type="text || email || password"]{
          color: black;
        }

        .modal-body{
          padding-left: 15px;
    padding-right: 15px;
    padding-top: 15px;
    padding-bottom: 0px;
        }
      </style>
      <div class="modal-body">
        <form id="register-form" action="" method="post" role="form" style="display: block;">
                  <div class="form-group row col-sm-12">
                    <div class="col-sm-6" id="firstNameHolder">
                      <input type="text" name="firstName" id="username" tabindex="1" class="form-control" placeholder="First Name*" value="" required>
                    </div>
                    <div class="col-sm-6" id="lastNameHolder">
                      <input type="text" name="lastName" id="username" tabindex="1" class="form-control" placeholder="Last Name*" value="" required>
                    </div>
                  </div>
                  <div class="form-group row col-sm-12">
                    <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address*" value="" required>
                  </div>
                  <div class="form-group row col-sm-12">
                    <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Set A Password*" required>
                  </div>
                  <div class="form-group row col-lg-12">
                    <div class="row">
                      <div class="col-sm-12" id="btn-register-holder">
                        <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-block btn-register" value="ADD NOW">
                      </div>
                    </div> 
                     </form>          
      </div>
      <div class="modal-footer">
        
      </div>  
    </div>
    </div>
</div>
</div>
                      <div class="padding">
                      	<table id="myTable" class="table table-striped" >  
        					         <thead>   
        					         </thead>  
        					<tbody>  
          						<?php
          						while ( $row = mysqli_fetch_array($result) )
          						{
                      $personIcon = "<img class=\"img-circle person-icon\" src=\"icons/person.png\">";
                      $editIcon = "<button class=\"ops-btn\" onclick=\"editRow(this,".$row['id'].")\"  data-toggle=\"modal\" data-target=\"#editModal\")\"><span><img class=\"btn-icon\" src=\"icons/edit.png\"></span></button>";
                      $deleteIcon = "<button class=\"ops-btn\" onclick=\"deleteRow(".$row['id'].")\"><span><img class=\"btn-icon\" src=\"icons/delete.png\"></span></button>";
            					echo "<tr id=\"".$row['id']."\">";  
            					echo "  <td>".$personIcon."</td>";
            					echo "  <td>".$row['firstName']." ".$row['lastName']."</td>";
            					echo "  <td class=\"email\">".$row['email']."</td>";
            					echo "  <td align=\"right\">".$editIcon.$deleteIcon."</td>";    
            					echo "</tr>";
          						}
          						?> 
        					</tbody>  
      					</table>
                </div>
<div id="editModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center">Edit Record</h4>
      </div>
      <style type="text/css">
        .modal-body input[type="text || email || password"]{
          color: black;
        }

        .modal-body{
          padding-left: 15px;
    padding-right: 15px;
    padding-top: 15px;
    padding-bottom: 0px;
        }
      </style>
      <div class="modal-body">
        <form id="changeForm" action="" method="post" role="form" style="display: block;">
                  <div class="form-group row col-sm-12">
                      <input type="text" name="changedName" id="changedName" tabindex="1" class="form-control" placeholder="First Name*" value="" required>
                  </div>
                  <div class="form-group row col-sm-12">
                    <input type="email" name="changedEmail" id="changedEmail" tabindex="1" class="form-control" placeholder="Email Address*" value="" required>
                  </div>
                  <div class="form-group row col-lg-12">
                    <div class="row">
                      <div class="col-sm-12" id="btn-register-holder">
                        <input type="hidden" name="ID" id="ID" value="">
                        <input type="submit" name="changeSubmit" id="changeSubmit" tabindex="4" class="form-control btn btn-block btn-register" value="SUBMIT CHANGES">
                      </div>
                    </div> 
         </form>          
      </div>
      <div class="modal-footer">
        
      </div>  
    </div>
    </div>
</div>
</div>
              </div><!-- /col-9 -->
            </div>
            <!-- /main -->
        </div>
    </div>
</div>
	<!-- script references -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">
function deleteRow(str)
      {
          var row = document.getElementById(str);
          var x = confirm("Are you sure to delete this record?")
          if( x==true )
          {

            row.deleteCell(-1);
            row.deleteCell(-1);
            row.deleteCell(-1);
            row.deleteCell(-1);
          }
          if (str == "")
          {
            document.getElementById("actionArea").innerHTML = "";
            return;
          }
          else
          { 
            if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
            }
            else
            {
              xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function()
            {
              if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("actionArea").innerHTML = xmlhttp.responseText;
              }
            }
                xmlhttp.open("GET","deleteUser.php?q="+str,true);
                xmlhttp.send();
          }
      }

function editRow(r,str)
{
  var i = r.parentNode.parentNode.rowIndex;
  var printName = document.getElementById("myTable").rows[i].cells.item(1).innerHTML;
  var printEmail = document.getElementById("myTable").rows[i].cells.item(2).innerHTML;
  document.getElementById("changedName").value=printName;
  document.getElementById("changedEmail").value=printEmail;
  document.getElementById("ID").value=str;
}
</script>
<style type="text/css">
  #actionArea{
    visibility: hidden;
    display: none;
  }
</style>
<div id="actionArea"></div>
	</body>
</html>