<?php

class Insert_subject extends CI_Controller {

    function index() {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('program_id', 'Program', 'required');
        $this->form_validation->set_rules('semester', 'Semester', 'required');
        $this->form_validation->set_rules('subject_id', 'Subject', 'required');
        $this->form_validation->set_rules('nature_id', 'Nature', 'required');
        $this->form_validation->set_rules('check_duplicate', '', 'callback_check_duplicate');

        $this->load->view('common/header');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('Insert_subject');
        } else {
            $program_id = $this->input->post('program_id');
            $semester = $this->input->post('semester');
            $subject_id = $this->input->post('subject_id');
            $nature_id = $this->input->post('nature_id');

            $this->db->query("insert into course_structure (program_id, semester, subject_id, nature_id ) values ('$program_id', '$semester', '$subject_id', '$nature_id')");
            redirect('/All_subjects');
        }

        $this->load->view('common/footer');
    }

    function check_duplicate() {
        $program_id = $this->input->post('program_id');
        $semester = $this->input->post('semester');
        $subject_id = $this->input->post('subject_id');

        $q = $this->db->query("select * from course_structure where program_id = '$program_id' and semester = '$semester' and subject_id = '$subject_id'");
        if ($q->num_rows() == 0)
            return TRUE;
        $this->form_validation->set_message('check_duplicate', 'Subject already exists in above Program and Semester.');
        return FALSE;
        }

}
