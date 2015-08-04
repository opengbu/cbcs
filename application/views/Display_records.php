<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<script>
    function del_ask(str, n)
    {
        var x = confirm("Do you want to remove " + n + "?");
        if (x == true)
            location.href = "remove_subject?course_id=" + str;
    }
</script>
<div class="col-sm-12">
    <br /><br />
    <form>
        <div class="col-sm-3">

            <select class="selectpicker" data-size="5" data-dropup-auto="false" data-live-search="true" onchange="this.form.submit()" name="program" >        
                <option value="-1"> Select Program </option>
                <?php
                $q = $this->db->query("select id, code, name, school, student_tag from programs");
                foreach ($q->result() as $row) {
                    ?>
                    <option value="<?= $row->id ?>" 
                    <?php if ($row->id == $this->input->get('program')) echo 'selected="selected" '; ?>        
                            ><?= $row->code ?> <?= $row->name ?> (<?= $row->school ?>) (<?= $row->student_tag ?>)</option>
                            <?php
                        }
                        ?>
            </select>   
        </div>

        <div class=" col-sm-6">

            <select class="selectpicker" data-dropup-auto="false" data-size="5" data-live-search="true" onchange="this.form.submit()" name="semester" data-width=50%>        
                <option value="-1"> Select Semester </option>
                <?php
                for ($count = 1; $count <= 14; $count++) {
                    ?>
                    <option value="<?= $count ?>" 
                    <?php if ($count == $this->input->get('semester')) echo 'selected="selected" '; ?>        
                            > <?= $count ?> </option>
                            <?php
                        }
                        ?>
            </select>   
        </div>

        <div class="col-sm-1">
            <a href ="<?= site_url() . "insert_subject" ?>" class="btn btn-primary"> Insert </a>
        </div>

        <div class="col-sm-1">
            <a href ="<?= site_url() . "create_subject" ?>" class="btn btn-primary"> Create </a>
        </div>
    </form>
    <br /><br /><br /><br >
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
    $sum = 0;

    $result = $this->db->query($select_rows);
    if ($result->num_rows() > 0)
    {
    ?>

    <ul class="nav nav-list col-sm-12"> 
		<b>
            <li class="list-group-item">
                <div class="row">
                    <div class="col-sm-2">
                        Code
                    </div>
                    <div class="col-sm-1">
                        Nature
                    </div>
                    <div class="col-sm-7">
                        Subject Name
                    </div>
                    <div class="col-sm-1">
                        Credits
                    </div>
                 </div>
            </li>
			</b>
		<?php
        foreach ($result->result() as $row) {
            $sum+= $row->sub_credit;
            ?>
            <li class="list-group-item">
                <div class="row">
                    <div class="col-sm-2">
                        <?= $row->sub_code ?>
                    </div>
                    <div class="col-sm-1">
                        <?= $row->nature_code ?>
                    </div>
                    <div class="col-sm-7">
                        <?= $row->sub_name ?>
                    </div>
                    <div class="col-sm-1">
                        <?= $row->sub_credit ?>
                    </div>
                    <div class="col-sm-1">
                        <a onclick="del_ask('<?php echo$row->cs_id ?>', '<?php echo$row->sub_code ?>')" class="pull-right btn btn-xs btn-danger"><i class="fa fa-trash-o fa-lg"></i> Delete</a>  
                    </div>
                </div>
            </li>

            <?php
        }
        ?>
        <li class="list-group-item">
            <div class="row">
                <div class="col-sm-10">
                    <b>Total</b>
                </div>
                <div class="col-sm-2">
                    <b><?= $sum ?></b>
                </div>
            </div>
        </li>
		<br>
		<a href ="<?=site_url('Cdownload/dnld?semester=' . $semester . '&program=' . $program)?>" class="btn btn-primary"> Download in Excel </a>
    </ul>
	
    <?php
    }
    else
    {
        echo "<b>Nothing to Display, please select appropriate Program and Semester to view details</b>";
    }
    ?>
	<br>
	
	
	</div>
