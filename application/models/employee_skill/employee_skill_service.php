<?php

class Employee_skill_service extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('employee_skill/employee_skill_model');
    }

    public function get_all_employee_skills() {
        $this->db->select('*');
        $this->db->from('employee_skill');
        $query = $this->db->get();
        return $query->result();
    }

    function get_skill_by_employee_code($employee_code) {

        $query = $this->db->get_where('employee_skill', array('employee_code' => $employee_code));
        return $query->result();
    }

    function delete_employee_skill($employee_skill_id) {

        return $this->db->delete('employee_skill', array('employee_skill_id' => $employee_skill_id));
    }

    function update_employee_skill($employee_skill_model) {

        $data = array(
            'employee_code' => $employee_skill_model->get_employee_code(),
            'skill_code' => $employee_skill_model->get_skill_code()
        );


        $this->db->where('employee_skill_code', $employee_skill_model->get_employee_skill_id());

        return $this->db->update('employee_skill', $data);
    }

    function add_new_employee_skill($employee_skill_model) {

        $this->db->select('*');
        $this->db->from('employee_skill');
        $this->db->where('employee_code', $employee_skill_model->get_employee_code());
        $this->db->where('skill_code', $employee_skill_model->get_skill_code());
        $query = $this->db->get();
        $a = 0;
        foreach ($query->result() as $pri) {
            $a = 1;
            $employee_skill_model->set_employee_skill_id($pri->employee_skill_id);
        }
        if ($a == 0) {
            return $this->db->insert('employee_skill', $employee_skill_model);
        } else {
            return $this->db->delete('employee_skill', array('employee_skill_id' => $employee_skill_model->get_employee_skill_id()));
        }
    }

}