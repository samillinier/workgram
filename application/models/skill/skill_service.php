<?php

class Skill_service extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('skill/skill_model');
    }

    public function get_all_skills() {
        $this->db->select('skill.*,skill_category.skill_cat_name');
        $this->db->from('skill');
        $this->db->join('skill_category', 'skill_category.skill_cat_code = skill.skill_cat_code');
        $this->db->where('skill_category.del_ind', '1');
        $this->db->where('skill.del_ind', '1');
        $this->db->order_by("skill.skill_code", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    function add_new_skill($skill_model) {

        return $this->db->insert('skill', $skill_model);
    }

    function delete_skill($skill_code) {
        $data = array('del_ind' => '0');
        $this->db->where('skill_code', $skill_code);
        return $this->db->update('skill', $data);
    }

    function get_skill_by_code($skill_code) {

        $query = $this->db->get_where('skill', array('skill_code' => $skill_code,'del_ind'=>'1'));
        return $query->row();
    }
    
    public function get_skills_by_skill_cat_code($skill_model) {
        $this->db->select('*');
        $this->db->from('skill');
        $this->db->where('del_ind', '1');
        $this->db->where('skill_cat_code', $skill_model->get_skill_cat_code());
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_skills_by_skill_cat_codes($skill_cat_codes) {
        $this->db->select('*');
        $this->db->from('skill');
        $this->db->where('del_ind', '1');
        $this->db->where('skill_cat_code IN('.$skill_cat_codes.')');
        $query = $this->db->get();
        return $query->result();
    }
    
   
    function update_skill($skill_model) {

        $data = array(
            'skill_name' => $skill_model->get_skill_name(),
            'skill_cat_code' => $skill_model->get_skill_cat_code()
        );


        $this->db->where('skill_code', $skill_model->get_skill_code());

        return $this->db->update('skill', $data);
    }

}
