
<?php

if ($this->input->get('program') != NULL)
        $program = $this->input->get('program');
    else
        $program = "NULL";

    if ($this->input->get('semester') != NULL)
        $semester = $this->input->get('semester');
    else
        $semester = "NULL";
    $select_rows = "select Subject.code as sub_code, Subject.name as sub_name, Subject.credit as sub_credit, nature.code as nature_code, course_structure.id as cs_id from course_structure, nature, Subject where course_structure.subject_id =  Subject.id and course_structure.nature_id = nature.id and course_structure.program_id = " . $program . " and course_structure.semester = " . $semester;
    
$setExcelName = "student";

$q = $this->db->query($select_rows);

$setMainHeader="";
$setData="";
    $setMainHeader .= "Code \t";
	$setMainHeader .= "Nature \t";
	$setMainHeader .= "Name \t";
	$setMainHeader .= "Credit \t" . "\n";

foreach($q->result() as  $rec)   {
  $rowLine = '';
    $rowLine .= $rec->sub_code ."\t";
	$rowLine .= $rec->nature_code ."\t";
	$rowLine .= $rec->sub_name ."\t";
	$rowLine .= $rec->sub_credit ."\t";
	$rowLine .= "\n";
  
  $setData .= trim($rowLine)."\n";
}
  $setData = str_replace("\r", "", $setData);

if ($setData == "") {
  $setData = "nno matching records foundn";
}

$setCounter = $q->num_rows();



//This Header is used to make data download instead of display the data
 header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=".$setExcelName."_Reoprt.xls");

header("Pragma: no-cache");
header("Expires: 0");

//It will print all the Table row as Excel file row with selected column name as header.
echo ucwords($setMainHeader)."\n".$setData."\n";

?>

