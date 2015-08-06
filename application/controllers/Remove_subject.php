<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Remove_subject extends CI_Controller {

    function index() {
        $record_id = $this->input->get('course_id');
        if ($record_id == NULL || $record_id == "")
            redirect("all_subjects");
        $this->db->query("delete from course_structure where id = '$record_id'");
        $program_id = $this->input->get('program');
        $semester = $this->input->get('semester');
         redirect('/All_subjects?program=' . $program_id . '&semester=' . $semester);
    }

}
