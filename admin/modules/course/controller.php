<?php 
require_once ("../../../includes/initialize.php");
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
	case 'add' :
	doInsert();
	break;
	
	case 'edit' :
	doEdit();
	break;
	
	case 'delete' :
	doDelete();
	break;

case 'import' :
		doimport();
	break;

	}

	function doimport(){
		if(isset($_POST["Import"])){
		//require_once("includes/initialize.php");

		echo $filename=$_FILES["file"]["tmp_name"];
		//echo $ext=substr($filename,strrpos($filename,"."),(strlen($filename)-strrpos($filename,".")));


		 if($_FILES["file"]["size"] > 0)
		 {

		  	$file = fopen($filename, "r");
	         while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {
	            //print_r($emapData);
	            global $mydb;
	            $mydb->setQuery("INSERT into course values('$emapData[0]','$emapData[1]','$emapData[2]','$emapData[3]','$emapData[4]','$emapData[5]')");
	          	$mydb->executeQuery();
	           	
	         }
	         fclose($file);
	         message("CSV File has been successfully Imported","info");
			 redirect('index.php?view=import');
		         
		 }
		 else
		 	message("Invalid File:Please Upload CSV File","error");
			redirect('index.php?view=import');
		 }
	}
function doInsert(){
		
	if (isset($_POST['savecourse'])){

	if ($_POST['coursename'] == "" OR $_POST['coursedesc'] == "") {
		message("All field is required!","error");
		check_message();
	}else{
		

		$course = new Course();
		$coursename   	= $_POST['coursename'];
		$courselevel   	= $_POST['level'];
		$coursemajor   	= $_POST['major'];
		$coursedesc 	= $_POST['coursedesc'];
		$coursedept		= $_POST['dept'];
		$res = $course->find_all_course($coursename, $courselevel, $coursemajor);
				
		if ($res >=1) {
			message("Course name already exist!","error");
			check_message();
		}else{
			$course->COURSE_NAME = $coursename;
			$course->COURSE_LEVEL = $courselevel;
			$course->COURSE_MAJOR = $coursemajor;
			$course->COURSE_DESC = $coursedesc;
			$course->DEPT_ID = $coursedept;	
			 $istrue = $course->create(); 
			 if ($istrue == 1){
			 	
			 	message("New [". $coursename ."] course created successfully!","success");
			 	redirect('index.php');
			 }
		}	 

		
	}
}
}
function doEdit(){
	$courseid = $_GET['id'];
	$singledept = new Course();
	$object = $singledept->single_course($courseid);


	if (isset($_POST['savecourse'])){

		if ($_POST['coursename'] == "" OR $_POST['coursedesc'] == "") {
			
			message("All field is required!", "error");

		}else{
			$course = new Course();
			$courseid		= $_GET['id'];
			$coursename   	= $_POST['coursename'];
			$courselevel   	= $_POST['level'];
			$coursemajor   	= $_POST['major'];
			$coursedesc 	= $_POST['coursedesc'];
			$coursedept		= $_POST['dept'];
					
			$course->COURSE_NAME = $coursename;
			$course->COURSE_LEVEL = $courselevel;
			$course->COURSE_MAJOR = $coursemajor;
			$course->COURSE_DESC = $coursedesc;
			$course->DEPT_ID 	 = $coursedept;	
			$course->update($courseid);
			

			message($coursename. " has updated successfully!", "info");
			redirect('index.php');

		}
	}
		
}

function doDelete(){
	  @$id=$_POST['selector'];
	  $key = count($id);
	//multi delete using checkbox as a selector
	
	for($i=0;$i<$key;$i++){
 
		$Course = new Course();
		$Course->delete($id[$i]);
	}
	message("Course(s) already Deleted!","info");
	redirect('index.php');
}
?>