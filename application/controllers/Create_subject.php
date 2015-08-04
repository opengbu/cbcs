<?php

class Create_subject extends CI_Controller {

    function index() {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('credit', 'Credits', 'required');
        $this->form_validation->set_rules('code_as_sub', 'Nature or Code', 'callback_check_if_possible');

        $this->load->view('common/header');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('Create_subject');
        } else {
            $name = $this->input->post('name');
            $credit = $this->input->post('credit');
            $code = $this->input->post('code');
            $code_as_sub = $this->input->post('code_as_sub');

            if ($code == NULL || $code == "") { // Now we have generate code using nature
                $q = $this->db->query(" select count(*) as total from Subject where code like '" . $code_as_sub . "%' ");
                $row = $q->row(); //get first row
                $code = $code_as_sub . ($row->total + 1);
            }

            $this->db->query("insert into Subject (name, credit, code) values ('$name', '$credit', '$code')");
            redirect('/All_subjects');
        }

        $this->load->view('common/footer');
    }

    function check_if_possible() {
        if (($this->input->post('code') == NULL || $this->input->post('code') == "") && ($this->input->post('code_as_sub') == NULL || $this->input->post('code_as_sub') == "")) {
            $this->form_validation->set_message('check_if_possible', 'Code or Nature is required.');
            return FALSE;
        }

        return TRUE;
    }

}
