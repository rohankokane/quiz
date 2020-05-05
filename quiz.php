<?php
   session_start();
   
   if(!isset($_SESSION['username'])){
   	header('location:index.php');
   }
   
   
   $con = mysqli_connect('localhost','root');
  
      mysqli_select_db($con,'quizdb');
      //$_SESSION['username']='sak';
   if (mysqli_connect_errno()){
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }
   
   ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Hello, world!</title>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css?family=Montserrat|Open+Sans" rel="stylesheet">
      <style type="text/css">
      .card{
			box-shadow:#4e0000 1px 1px 5px;
         padding: 10px;
         margin: 2px;
                  
		}
		.btn{
			/* padding: 15px; */
			background-color: #9F1C33;
			color: rgb(240, 218, 218);
			padding: 16px 40px;
			border: none;
			cursor:pointer;
			margin-bottom: 10px;
			}
         .site-header{
			background-color:#f5f5f5; 
			/* height: 15vh; */
			padding: 10px;
			display: flex;
			flex-direction:row ; /*mobile friendly images size changes creating a flexbox*/
			justify-content: space-evenly;
			/* align-items: center; */
			}
		.container{
			display:flex;
         flex-direction:column;
			background-image: url(http://www.dypatil.edu/mumbai/rait/wp-content/themes/stack-theme/images/logo_bg.jpg);
			background-repeat: no-repeat;
			/* background-position: 50px; */
			background-size:contain;	
		}
      </style>
   </head>
   <body>
      <header class="site-header">
         <img src="http://www.dypatil.edu/mumbai/rait/wp-content/uploads/2020/04/logo-1-1-1.png" width="240vh">
         <!-- <div class="text-center"><h1>NSS-RAIT</h1></div> -->
         <img src="http://localhost/quiz/images/sow.png" width="90vh" style="margin-left:25px">
         <div></div>
         <img src="http://localhost/quiz/images/nss_logo.png" width="90vh">
      </header>
   <div class="container">
         
            <!-- <h1 class="text-center text-success text-uppercase animateuse" >  ThapaTechnical  Webdeveloper Quiz </h1>
            <br> -->
            <div class="text-center">
               <h3> <a href="#" class="text-uppercase text-warning"> <?php echo $_SESSION['username']; ?>,</a> Welcome to the Quiz! </h3>
            </div>
            <br>
            <!-- <div class="col-lg-8 d-block m-auto bg-light quizsetting "> -->
                  <p class="text-center" > <?php echo $_SESSION['username']; ?>, you have to select only one out of 4. Best of Luck </p>
               <br>
               <form action="checked.php" method="post">
                  <?php
                     for($i=1;$i<6;$i++){
                        $l = 1;
                        $ansid = $i;

                        $sql1 = "SELECT * FROM `questions` WHERE `qid` = $i ";
                     	$result1 = mysqli_query($con, $sql1);
                     	if (mysqli_num_rows($result1) > 0) {
                     		$row1 = mysqli_fetch_assoc($result1)
                     	   ?>				
                           <br>
                           <!-- card Start -->
                           <div class="card">
                              <br>
                              <!-- question print -->
                              <p><?php echo $i ." . ". $row1['question']; ?> </p>
                              <?php
                              $sql = "SELECT * FROM `answers` WHERE `q_ans` = $i";
                              $result = mysqli_query($con, $sql);
                                 if (mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)) {
                                    ?>	
                                       <div class="card-options" style="background-color:rgba(255, 244, 228, 0.801)"><label>
                                          <input type="radio" name="quizcheck[<?php echo $ansid; ?>]" id="<?php echo $ansid; ?>" value="<?php echo $row['aid']; ?>" > <?php echo $row['answer']; ?> 
                                       </label>
                                          <br>
                                       </div>
                                    <!-- card-options end -->
                              <?php 
                                    } //while loop end
                                 }  //inner if end 
                                 $ansid = $ansid + $l; //ansid increment
                        ?> </div><?php
                        } //outer if end
                              
                     } //for loop end
                                                   
                     ?>
                  

                  <br>
                  <input type="submit" name="submit" Value="Submit" class="btn btn-success m-auto d-block" /> <br>
               </form>
               <p id="letc"></p>
            </div>
            <br>
         </div>
         <br>
         <footer>
            <h5 class="text-center"> &copy2018 NSS RAIT </h5> 
         </footer>
      </div>


   </body>
</html>



