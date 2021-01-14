<?php require_once ("../../../includes/initialize.php"); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Note there is no responsive meta tag here -->

   

    <title>Student Transcript</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap.css" rel="stylesheet">
<style type="text/css">
body { 
background-image: url(); 
background-repeat: no-repeat; 
height: 100%; 
width: 100%; 
background-position: bottom; 
margin-top: 0cm;

} 
.top {
    border-top:thin solid;
    border-color:black;
}

.bottom {
    border-bottom:thin solid;
    border-color:black;
}

.left {
    border-left:thin solid;
    border-color:black;
}

.right {
    border-right:thin solid;
    border-color:black;
}
.header-row { position:fixed; top:0; left:0; }
.table {padding-top:5px; }
</style>
    <!-- Custom styles for this template -->
    <link href="non-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
<?php
  $mydb->setQuery("SELECT * 
  FROM tblstudent WHERE IDNO=".$_GET['studentId']);
  $cur = $mydb->loadResultList();
  foreach($cur as $object){


  ?>
    <div class="container">

      <div class="page-header">
     <hr>
        <div class="row">
        <div class="col-xs-6"><H6>NAME: <?php echo $object->LNAME . ' '.$object->FNAME; ?></H6></div>
        <div class="col-xs-6" align="right"><B></B></div>
<!--         <div class="col-xs-4">One third</div> -->
      </div>
       <div class="row">
        <div class="col-xs-6"><H6>DATE OF BIRTH: <?php echo $object->BDAY; ?></h6></div>
        <div class="col-xs-6" align="right"><H6>REG NO.: <?php echo $object->IDNO; ?></H6></div>
<!--         <div class="col-xs-4">One third</div> -->
      </div>
       <div class="row">
        <div class="col-xs-6"><H6>PLACE OF BIRTH: <?php echo $object->BPLACE;  ?></H6></div>
       <!--  <div class="col-xs-6" align="right"><H6>NATIONAL ID NO.: <?php echo $object->NAT_ID; ?></H6></div> -->
<!--         <div class="col-xs-4">One third</div> -->
      </div>
    

      <?php
    }
    ?>
     </div>
     <div class="row">
        <div class="col-xs-6" align="Left"><H6>ACADEMIC YEAR: <?php echo $_GET['ay']; ?> </h6></div>
        <div class="col-xs-6" align="right"></div>
<!--         <div class="col-xs-4">One third</div> -->
      </div>
      <div class="row">
        <div class="col-xs-6"><H6>PROGRAM : UNDERGRADUTE DEGREE</H6></div>
        <div class="col-xs-6" align="right"><h6 align="Right">GRADE SYSTEM</h6></div>
<!--         <div class="col-xs-4">One third</div> -->
      </div> 
      <div class="row">
        <div class="col-xs-6"><H6>FACULTY : <?php //echo $object->FAC;  ?></H6></div>
        <div class="col-xs-6" align="right"><h6 align="Left"></h6></div>
<!--         <div class="col-xs-4">One third</div> -->
      </div>
         <div class="row">
        <div class="col-xs-5"><H6>DEPARTMENT: MATHEMATICS</H6> </div>
        <div class="col-xs-3" align="left">
         
        A   4.00GP  80-100% EXCELLENT<br/>
        B+  3.50GP  70-79%  VERY GOOD<br/>
        B   3.00GP  60-69%  GOOD<br/>
        C+  2.50GP  55-59%  FAIR<br/>
         C   2.00GP  50-54%  AVERAGE<br/>
        D+  1.50GP  45-49%  BELOW AVERAGE<br/>
       
        </div>
         <div class="col-xs-3" align="Left">
          <p>
          
        D   1.00GP  40-44%  POOR<br/>
        F   0.00GP   0-39%  FAIL<br/>
        GPTS  GRADE POINTS  GPA GRADE POINT AVERAGE <br/>
        CV   CREDIT VALUE  CGPA  COMMULATIVE GPA<br/>
          </div>

<!--         <div class="col-xs-4">One third</div> -->
      </div>

      
<table style="width:100%;">
  <tr>
    <td align="left" id="table">
      <table  style="width:100%;" border="0">
        <tr>
          <th align="left" width="50" class="bottom"><strong>Code</strong></th>
          <th align="left" width="150" class="bottom"><strong>Course Title</strong></th>
          <th align="left" width="30" class="bottom"><strong>GPTS</strong></th>
          <th align="left" width="30" class="bottom"><strong>CV</strong></th>
          <th align="left" width="30" class="bottom"> <strong>GRADE</strong></th>
        </tr>
      <?php

              
        $mydb->setQuery("SELECT * , 
                    CASE 
                    WHEN  `AVE` = 4.00  THEN 'A'
                    WHEN  `AVE` BETWEEN 3.50 AND 3.99 THEN  'B+'
                    WHEN  `AVE` BETWEEN 3.00 AND 3.49 THEN  'B'
                    WHEN  `AVE` BETWEEN 2.50 AND 2.99 THEN  'C+'
                    WHEN  `AVE` BETWEEN 2.00 AND 2.49 THEN  'C'
                    WHEN  `AVE` BETWEEN 1.50 AND 1.99 THEN  'D+'
                    WHEN  `AVE` BETWEEN 1.00 AND 1.49 THEN  'D'
                    WHEN  `AVE` = 0.00 THEN  'F'
                    END  'Grade'
                    FROM  `subject` s,  `course` c ,`grades` g
                    WHERE s.`COURSE_ID` = c.`COURSE_ID` AND s.`SUBJ_ID`=g.`SUBJ_ID`
                    AND s.`SEMESTER`= 'First' 
                    AND  `IDNO` = '{$_GET['studentId']}' AND c.`COURSE_ID`='{$_GET['cid']}'");
          
                
          $cur1 = $mydb->loadResultList();
          $res = $mydb->executeQuery();
          $res_count = $mydb->num_rows($res);
          $target_record = 10;
          
          $remaining_record = $target_record - $res_count;

          $mydb->setQuery("SELECT round(SUM(  `AVE` ) / COUNT( * ) , 2) AS GPA
                    FROM  `subject` s,  `course` c ,`grades` g
                    WHERE s.`COURSE_ID` = c.`COURSE_ID` AND s.`SUBJ_ID`=g.`SUBJ_ID` 
                    AND s.`SEMESTER`= 'First' 
                    AND  `IDNO` = '{$_GET['studentId']}' AND c.`COURSE_ID`='{$_GET['cid']}'");
          $GP1 = $mydb->loadResultList();
          
          
          foreach($cur1 as $object1){

          echo '<tr >
            <td class="">'.$object1->SUBJ_CODE.'</td>
            <td class="">'.$object1->SUBJ_DESCRIPTION.'</td>
            <td class="">'.$object1->AVE.'</td>
            <td class="">'.$object1->UNIT.'</td>
            <td class="">'.$object1->Grade.'</td>
            </tr>';
          }
          $i = 1;
          while ($i <= $remaining_record ) {
            echo '<tr><td>&nbsp;</td></tr>';
            $i++;
          }
          ?>
          
        <tr>
        <?php
        foreach($GP1 as $GPA1){
        echo '<td colspan="5"><strong>Semester 1 GPA: '.$GPA1->GPA . '</strong></td>'; }?>
        </tr> 
      </table><!--end of left table-->
    </td>
    <td align="right">
      <table style="width:100%;" border="0">
        <tr >
          <th align="left" width="50" class="bottom"><strong>Code</strong></th>
          <th align="left" width="150" class="bottom"><strong>Course Title</strong></th>
          <th align="left" width="30" class="bottom"><strong>GPTS</strong></th>
          <th align="left" width="30" class="bottom"><strong>CV</strong></th>
          <th align="left" width="30" class="bottom"> <strong>GRADE</strong></th>
        </tr>
        
        <?php
        $mydb->setQuery("SELECT * , 
                    CASE 
                    WHEN  `AVE` = 4.00  THEN 'A'
                    WHEN  `AVE` BETWEEN 3.50 AND 3.99 THEN  'B+'
                    WHEN  `AVE` BETWEEN 3.00 AND 3.49 THEN  'B'
                    WHEN  `AVE` BETWEEN 2.50 AND 2.99 THEN  'C+'
                    WHEN  `AVE` BETWEEN 2.00 AND 2.49 THEN  'C'
                    WHEN  `AVE` BETWEEN 1.50 AND 1.99 THEN  'D+'
                    WHEN  `AVE` BETWEEN 1.00 AND 1.49 THEN  'D'
                    WHEN  `AVE` = 0.00 THEN  'F'
                    END  'Grade'
                    FROM  `subject` s,  `course` c ,`grades` g
                    WHERE s.`COURSE_ID` = c.`COURSE_ID` AND s.`SUBJ_ID`=g.`SUBJ_ID` 
                    AND s.`SEMESTER`= 'Second' 
                    AND  `IDNO` = '{$_GET['studentId']}' AND c.`COURSE_ID`='{$_GET['cid']}'");
        $cur2 = $mydb->loadResultList();
        $res = $mydb->executeQuery();
        $res_count = $mydb->num_rows($res);
        $target_record = 10;
        
        $remaining_record = $target_record - $res_count;      
        foreach($cur2 as $object2){

        echo '<tr >
          <td class="">'.$object2->SUBJ_CODE.'</td>
          <td class="">'.$object2->SUBJ_DESCRIPTION.'</td>
          <td class="">'.$object2->AVE.'</td>
          <td class="">'.$object2->UNIT.'</td>
          <td class="" align="center">'.$object2->Grade.'</td>
          </tr>';
        }
        $i = 1;
          while ($i <= $remaining_record ) {
            echo '<tr><td>&nbsp;</td></tr>';
            $i++;
          }
        ?>
        <tr>
        
        <?php
        $mydb->setQuery("SELECT round(SUM(  `AVE` ) / COUNT( * ) , 2) AS GPA
                FROM  `subject` s,  `course` c ,`grades` g
                WHERE s.`COURSE_ID` = c.`COURSE_ID` AND s.`SUBJ_ID`=g.`SUBJ_ID` 
                AND s.`SEMESTER`= 'Second' 
                AND  `IDNO` = '{$_GET['studentId']}' AND c.`COURSE_ID`='{$_GET['cid']}'");
          $GP2 = $mydb->loadResultList();       
        foreach($GP2 as $GPA2){
          echo '<td colspan="5"><strong>Semester 2 GPA: '.$GPA2->GPA.'</strong></td>'; } ?>
        </tr> 
      </table><!--end of right table-->
    </td> 

</tr>
    <tr>
      <td></td>
      <?php
      $mydb->setQuery("SELECT round(SUM(  `AVE` ) / COUNT( * ) , 2) AS GPA
                FROM  `subject` s,  `course` c ,`grades` g
                WHERE s.`COURSE_ID` = c.`COURSE_ID` AND s.`SUBJ_ID`=g.`SUBJ_ID` 
                AND  `IDNO` = '{$_GET['studentId']}' AND c.`COURSE_ID`='{$_GET['cid']}'");
          $AnnualGP1 = $mydb->loadResultList();       
        foreach($AnnualGP1 as $AnnGPA){
          echo '<td colspan="2" align="center"><h4>ANNUAL GPA: '.$AnnGPA->GPA.'</h4></td>'; }?>
    </tr>
    <tr>
      <td></td>
      <td align="center"><h4>TRANSCRIPT IS ONLY VALID WITH THIS SIGNATURE</h4></td>
    </tr>
    <tr>
      <td>
      </td>
      <td>
      <table class="" style="width:100%;" border="0">
      <td></td>
      <td align="center" class="top bottom left right">&nbsp;</td>
      
      <td></td>
      </table>
      </td>
      
    </tr>
    <tr>
      <?php
        $mydb->setQuery("SELECT HEX(CONCAT(IDNO, AGE)) as serialno 
        FROM tblstudent WHERE  IDNO=".$_GET['studentId']);
        $cur = $mydb->loadResultList();
        foreach($cur as $object){


        ?>
    <td>
      </td>
      <td>
      <table class="" style="width:100%;" border="0">
      <td></td>
      <td align="center"><strong><?php echo $object->serialno; ?></strong></td>
      <?php
        }
      ?>
      <td></td>
      </table>
      </td>
    </tr> 
    
</table>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../../assets/js/jquery.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
  </body>
</html>
