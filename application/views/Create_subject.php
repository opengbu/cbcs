<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 */
echo form_open('create_subject');
?>
<div class="col-sm-8">
    <br /><br />
    <input class="form-control" autofocus="true" value="<?php echo set_value('name'); ?>" placeholder="Subject Name" name="name" required="required"/>
    <br />
    
    <input class="form-control" value="<?php echo set_value('credit'); ?>" placeholder="Credits" name="credit" required="required"/>
    <br />
    
    <input class="form-control" placeholder="Code (Leave empty if you want to auto generate using nature)" name="code"/>
    <br />

    <select class="selectpicker" data-size="5" data-live-search="true"  name="code_as_sub" data-dropup-auto="false">        
        <option value=""> Select Nature</option>
        <?php
        $natures = $this->db->query("select code_as_sub,code,name from nature");
        foreach ($natures->result() as $row) {
            ?>
            <option value="<?= $row->code_as_sub ?>" ><?= $row->code_as_sub ?> - <?= $row->name ?></option>
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