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
	            $mydb->setQuery("INSERT into subject (`SUBJ_CODE`, `SUBJ_DESCRIPTION`, `UNIT`, `PRE_REQUISITE`,COURSE_ID, `AY`, `SEMESTER`) 
	            	values('$emapData[1]','$emapData[2]','$emapData[3]','$emapData[4]','$emapData[5]','$emapData[6]','$emapData[7]')");
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

	if ($_POST['subjcode'] == "" OR $_POST['subjdesc'] == "" OR $_POST['unit'] == "") {
		message("All field is required!","error");
		check_message();
	}else{
		

		$subj = new Subject();
		$subjcode   	= $_POST['subjcode'];
		$subjdesc	 	= $_POST['subjdesc'];
		$unit 			= $_POST['unit'];
		$pre 			= $_POST['pre'];
		$course 		= $_POST['course'];
		$ay 			= $_POST['ay'];
		$Semester 		= $_POST['Semester'];
	
			$subj->SUBJ_CODE		 = $subjcode;
			$subj->SUBJ_DESCRIPTION  = $subjdesc;
			$subj->UNIT 			 = $unit;
			$subj->PRE_REQUISITE 	 = $pre;
			$subj->COURSE_ID 		 = $course;
			$subj->AY 				 = $ay;
			$subj->SEMESTER 		 = $Semester;


			 $istrue = $subj->create(); 
			 if ($istrue == 1){
			 	
			 	message("New Course created successfully!","success");
			 	redirect('index.php');
			 }
	}
	}
	elseif (isset($_POST['saveandnewcourse'])) {
	if ($_POST['subjcode'] == "" OR $_POST['subjdesc'] == "" OR $_POST['unit'] == "") {
		message("All field is required!","error");
		check_message();
	}else{
		

		$subj = new Subject();
		$subjcode   	= $_POST['subjcode'];
		$subjdesc	 	= $_POST['subjdesc'];
		$unit 			= $_POST['unit'];
		$pre 			= $_POST['pre'];
		$course 		= $_POST['course'];
		$ay 			= $_POST['ay'];
		$Semester 		= $_POST['Semester'];
	
			$subj->SUBJ_CODE		 = $subjcode;
			$subj->SUBJ_DESCRIPTION  = $subjdesc;
			$subj->UNIT 			 = $unit;
			$subj->PRE_REQUISITE 	 = $pre;
			$subj->COURSE_ID 		 = $course;
			$subj->AY 				 = $ay;
			$subj->SEMESTER 		 = $Semester;


			 $istrue = $subj->create(); 
			 if ($istrue == 1){
			 	
			 	message("New Course created successfully!","success");
				redirect('index.php?view=add');
			 }
}

}
}



function doEdit(){
	if (isset($_POST['savecourse'])){
	

	if ($_POST['subjcode'] == "" OR $_POST['subjdesc'] == "" OR $_POST['unit'] == "") {
		message("All field is required!","error");
		redirect('index.php');
	}else{
		

		$subj = new Subject();
		$Subjectid		= $_GET['id'];
		$subjcode   	= $_POST['subjcode'];
		$subjdesc	 	= $_POST['subjdesc'];
		$unit 			= $_POST['unit'];
		$pre 			= $_POST['pre'];
		$course 		= $_POST['course'];
		$ay 			= $_POST['ay'];
		$Semester 		= $_POST['Semester'];

			$subj->SUBJ_ID			 = $Subjectid;
			$subj->SUBJ_CODE		 = $subjcode;
			$subj->SUBJ_DESCRIPTION  = $subjdesc;
			$subj->UNIT 			 = $unit;
			$subj->PRE_REQUISITE 	 = $pre;
			$subj->COURSE_ID 		 = $course;
			$subj->AY 				 = $ay;
			$subj->SEMESTER 		 = $Semester;
 			$subj->update($Subjectid);
			message($subjcode. " has updated successfully!", "info");
			redirect('index.php');
			 
			
		}	 

		
	}
		
}

function doDelete(){
		  @$id=$_POST['selector'];
	  $key = count($id);
	//multi delete using checkbox as a selector
	
	for($i=0;$i<$key;$i++){
 
		$subj = new Subject();
		$subj->delete($id[$i]);
	}
	message("Course(s) already Deleted!","info");
	redirect('index.php');

}

?>