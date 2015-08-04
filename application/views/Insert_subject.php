<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 */
echo form_open('insert_subject');
?>
<div class="col-sm-8">
    <br /><br />
    <label>Program</label> <br />
    <select class="selectpicker" data-size="5" data-live-search="true"  name="program_id" data-dropup-auto="false">        
        <option value=""> Select Program </option>
        <?php
        $q = $this->db->query("select id, code, name from programs");
        foreach ($q->result() as $row) {
            ?>
            <option value="<?= $row->id ?>" ><?= $row->code ?> <?= $row->name ?> </option>
            <?php
        }
        ?>
    </select><br /><br />
    <label>Semester</label> <br />

    <select class="selectpicker" data-size="5" data-live-search="true"  name="semester" data-dropup-auto="false">        
        <option value=""> Select Semester </option>
        <?php
        for ($count = 1; $count <= 14; $count++) {
            ?>
            <option value="<?= $count ?>" > <?= $count ?> </option>
            <?php
        }
        ?>
    </select><br /><br />
    <label>Subject</label> <br />
    <select class="selectpicker" data-size="5" data-live-search="true"  name="subject_id" data-dropup-auto="false">        
        <option value=""> Select Subject </option>
        <?php
        $subjects = $this->db->query("select id,code,name from Subject");
        foreach ($subjects->result() as $row) {
            ?>
            <option value="<?= $row->id ?>" ><?= $row->code ?> - <?= $row->name ?></option>
            <?php
        }
        ?>
    </select><br /><br />
    <label>Nature</label> <br />
    <select class="selectpicker" data-size="5" data-live-search="true"  name="nature_id" data-dropup-auto="false">        
        <option value=""> Select Nature </option>
        <?php
        $natures = $this->db->query("select id,code,name from nature");
        foreach ($natures->result() as $row) {
            ?>
            <option value="<?= $row->id ?>" ><?= $row->code ?> - <?= $row->name ?></option>
            <?php
        }
        ?>
    </select>
    <br><br />
    <?php
    echo '<label><font color="red">' . validation_errors() . '</font></label>';
    ?>
    <div><input type="submit" value="Insert" class="btn btn-primary"/></div>
</div>
</form>