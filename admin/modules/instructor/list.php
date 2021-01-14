<div class="container">
<div class="well">
	<h3 align="left">List of Faculty</h3>
			    <form action="controller.php?action=delete" Method="POST"> 
			 <!--    <span id="printout"> 		 -->		
				<table id="example" class="table table-striped" cellspacing="0">
				
				  <thead>
				  	<tr>
				  		<th>No</th>
				  		<th>
				  		<input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"> 
				  		 Fullname</th>
				  		<th>Address</th>
				  		<th>Gender</th>
				  		<th>Civil Status</th>
				  		<th>Specialization</th>
				 		<th>Email Address</th>
				 		<th></th>
				  	</tr>	
				  </thead>
				  <tbody>
				  
				  	<?php
				        if($_SESSION['ACCOUNT_TYPE']=='Administrator'){
						

				  		$instructor = new Instructor();
			  	  		$instructor->listOfinstructor();
				  		loadresult();
				  	}else{
				  			$mydb->setQuery("SELECT * 
							FROM   instructor");
							loadresult();
					  		
					}
				  		function loadresult(){
					  		global $mydb;
					  		$cur = $mydb->loadResultlist();
							foreach ($cur as $result) {
						  		echo '<tr>';
						  		echo '<td width="5%" align="center"></td>';
						  		echo '<td><input type="checkbox" name="selector[]" id="selector[]" value="'.$result->INST_ID. '"/>
						  				<a href="index.php?view=edit&id='.$result->INST_ID.'">' . $result->INST_FULLNAME.'</a></td>';
						  		echo '<td>'. $result->INST_ADDRESS.'</td>';
						  		echo '<td>'. $result->INST_SEX.'</td>';
						  		echo '<td>'. $result->INST_STATUS.'</td>';
						  		echo '<td>'. $result->SPECIALIZATION.'</td>';
						  		echo '<td>'. $result->INST_EMAIL.'</td>';
					 			echo '<td><a href="index.php?view=instSubj&instructorId='.$result->INST_ID.'">List of Loads</a></td>';
						  		
						  		
						  		echo '</tr>';
					  		}
					  	} 
				  	?>
				  </tbody>
				
				</table>
				<?php
				if($_SESSION['ACCOUNT_TYPE']=='Administrator'){
						echo '
				<div class="btn-group">
				  <a href="index.php?view=add" class="btn btn-default"><span class="glyphicon glyphicon-plus-sign"></span> New</a>
				  <button type="submit" class="btn btn-default" name="delete"><span class="glyphicon glyphicon-trash"></span> Delete Selected</button>
				</div>';
			}
				?>

<!-- </span>
 <div class="btn-group" id="divButtons" name="divButtons">
	<input type="button" value="Print" onclick="tablePrint();" class="btn btn-default">
</div>  -->

				</form>
	  	</div><!--End of well-->

</div><!--End of container-->

 <script>
function tablePrint(){ 
 document.all.divButtons.style.visibility = 'hidden';  
    var display_setting="toolbar=no,location=no,directories=no,menubar=no,";  
    display_setting+="scrollbars=no,width=500, height=500, left=100, top=25";  
 //   var tableData = '<table border="1">'+document.getElementsByTagName('table')[0].innerHTML+'</table>';
    var content_innerhtml = document.getElementById("printout").innerHTML;  
    var document_print=window.open("","",display_setting);  
    document_print.document.open();  
    document_print.document.write('<body style="font-family:verdana; font-size:12px;" onLoad="self.print();self.close();" >');  
    document_print.document.write(content_innerhtml);  
    document_print.document.write('</body></html>');  
    document_print.print();  
    document_print.document.close(); 
   
    return false;  
    } 
/*  $(document).ready(function() {
    oTable = jQuery('#example').dataTable({
    "bJQueryUI": true,
    "sPaginationType": "full_numbers"
    } );
  });  */ 
</script>