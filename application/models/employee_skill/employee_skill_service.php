<?php

class Employee_skill_service extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('employee_skill/employee_skill_model');
    }

    public function get_all_employee_skills() {
        $this->db->select('*');
        $this->db->from('employee_skill');
        $this->db->where('del_ind', '1');
        $query = $this->db->get();
        return $query->result();
    }

    function get_skill_by_employee_code($employee_code) {

        $query = $this->db->get_where('employee_skill', array('employee_code' => $employee_code));
        return $query->result();
    }

    function get_skills_for_employee($emp_code) {

        $this->db->select('employee_skill.*,skill.skill_name');
        $this->db->from('employee_skill');
        $this->db->join('skill', 'employee_skill.skill_code = skill.skill_code');
        $this->db->where('employee_skill.del_ind', '1');
        $this->db->where('skill.del_ind', '1');
        $this->db->where('employee_skill.employee_code', $emp_code);
        $this->db->order_by("employee_skill.employee_skill_id", "desc");
        $query = $this->db->get();

        return $query->result();
    }

    function get_skill_categories_for_employee($emp_code) {

        $this->db->select('employee_skill.*,skill.skill_cat_code,skill_category.colour');
        $this->db->from('employee_skill');
        $this->db->join('skill', 'employee_skill.skill_code = skill.skill_code');
        $this->db->join('skill_category', 'skill_category.skill_cat_code = skill.skill_cat_code');
        $this->db->where('employee_skill.del_ind', '1');
        $this->db->where('skill.del_ind', '1');
        $this->db->where('skill_category.del_ind', '1');
        $this->db->where('employee_skill.employee_code', $emp_code);
        $this->db->group_by("skill.skill_cat_code");
        $query = $this->db->get();

        return $query->result();
    }

    function get_skills_for_employee_by_skill_cat_code($emp_code, $skill_cat_code) {

        $this->db->select('employee_skill.*,skill.skill_name,skill.skill_cat_code');
        $this->db->from('employee_skill');
        $this->db->join('skill', 'employee_skill.skill_code = skill.skill_code');
        $this->db->where('employee_skill.del_ind', '1');
        $this->db->where('skill.del_ind', '1');
        $this->db->where('employee_skill.employee_code', $emp_code);
        $this->db->where('skill.skill_cat_code', $skill_cat_code);
        $query = $this->db->get();

        return $query->result();
    }

    function delete_employee_skill($employee_skill_id) {
        $data = array('del_ind' => '0');
        $this->db->where('employee_skill_id', $employee_skill_id);
        return $this->db->update('employee_skill', $data);
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

        return $this->db->insert('employee_skill', $employee_skill_model);
    }

}
