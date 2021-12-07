<?php
include 'inc/header.php';
include 'connection.php';
Session::CheckSession();

$logMsg = Session::get('logMsg');
if (isset($logMsg)) {
  echo $logMsg;
}
$msg = Session::get('msg');
if (isset($msg)) {
  echo $msg;
}
Session::set("msg", NULL);
Session::set("logMsg", NULL);
?>
<h4 class="text-center text-muted">اضافة نوع المدرسة </h4> <a href="index.php?id=<?php  ?>" class="btn btn-primary">عودة</a>
<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6 well">
<?php
    
if(isset($_POST['save_button'])) {
	$task_id =$_POST['task_id'];
	$school_name = trim($_POST['name']);
	
	$query1 = "SELECT * FROM tbl_schools WHERE school_name = '$school_name' LIMIT 1";
	$result1 = mysqli_query($connection, $query1) or die("Query1 failed ... <br />");
	$count = mysqli_num_rows($result1);
	if($count >= 1) {
		echo '<div class="alert alert-warning" role="alert" style="margin:10px auto;text-align:center">';
		echo "<span>يجب أن يكون الإسم غير مكرر!</span>"; 
		echo '</div>';
		return;
	} 
	
	$q = "INSERT INTO tbl_schools VALUES(NULL,'$task_id','$school_name')";

	$res = mysqli_query($connection,$q);	

	if($res) {
		echo '<div class="alert alert-success" role="alert" style="margin:10px auto;text-align:center">';
		echo "<span>تم إضافة الجهة الطالبة للخدمة</span>";
		echo '</div>';

		echo '<meta http-equiv="refresh" content="1;url=schools.php" />';	
		exit();
	} else {
		echo 'Error Occurred';
	} 
}
?>
 	<form method="post">
	<div class="form-group">
    	<label>نوع المدرسة</label>
    	<input type="text" name="name" autofocus required id="name" placeholder="Name" class="form-control" />
	</div>
	
	<div class="row">
							<div class="col-md-6">
								<label>تابعة لـ</label>
								<div class="form-group">
									<select id="mobile" name="task_id" class="form-control">
										<?php 
										$query = "SELECT * FROM tbl_tasks";
										$result = mysqli_query($connection,$query);
										while($row = mysqli_fetch_array($result)) {
										?>
											<option value="<?php echo $row['task_id']; ?>">
												<?php echo $row['task_name']; ?>
											</option>
										<?php
										}
										?>
									</select>
								</div>
							</div>
							
						</div>
  
	  <div class="form-group">
      	<input type="submit" name="save_button" id="save" value="Save" class="btn pull-right btn-primary"/>
      </div>

  </form>   
	</div>
</div>
 <?php
  include 'inc/footer.php';

  ?>