<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class All_subjects extends CI_Controller {

    function index() {
        $this->load->view("common/header");
        $this->load->view('Display_records');
        $this->load->view("common/footer");
    }

    function insert() {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('subject_id', 'Subject', 'required');
        $this->form_validation->set_rules('nature_id', 'Nature', 'required');
        $this->form_validation->set_rules('check_duplicate', '', 'callback_check_duplicate');

        if ($this->form_validation->run() == FALSE) {
            // validation_errors();
             $array = array(
                "errors" => validation_errors(),
                 "result" => "error"
            );
            // $data['json'] = $array;
            echo(json_encode($array));
        } else {
            $program_id = $this->input->post('program');
            $semester = $this->input->post('semester');
            $subject_id = $this->input->post('subject_id');
            $nature_id = $this->input->post('nature_id');

            $this->db->query("insert into course_structure (program_id, semester, subject_id, nature_id ) values ('$program_id', '$semester', '$subject_id', '$nature_id')");
            $record_id = $this->db->insert_id();
            $get_sub_details = $this->db->query("select * from Subject where id = '$subject_id'");
            $sub_details = $get_sub_details->row();
            
            
            $nature_details_q = $this->db->query("select code from nature where id = '$nature_id'");
            $nature_details = $nature_details_q->row();
            
            $array = array(
                "result" => "success",
                "sub_code" => $sub_details->code,
                "name" => $sub_details->name,
                "credit" => $sub_details->credit,
                "nature_code" => $nature_details->code,
                "record_id" => $record_id,
                "program" => $program_id,
                "semester" => $semester,
            );
            echo(json_encode($array));
        }
    }

    function check_duplicate() {
        $program_id = $this->input->post('program');
        $semester = $this->input->post('semester');
        $subject_id = $this->input->post('subject_id');

        $q = $this->db->query("select * from course_structure where program_id = '$program_id' and semester = '$semester' and subject_id = '$subject_id'");
        if ($q->num_rows() == 0)
            return TRUE;
        $this->form_validation->set_message('check_duplicate', 'Subject already exists in above Program and Semester.');
        return FALSE;
    }

}
