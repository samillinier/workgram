
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class wages_category_controller extends CI_Controller {

    function __construct() {
        parent::__construct();

        if (!$this->session->userdata('EMPLOYEE_LOGGED_IN')) {
            redirect(site_url() . '/login/login_controller');
        } else {
              $this->load->model('wages_category/wages_category_model');
             $this->load->model('wages_category/wages_category_service');
             
             $this->load->model('employee/employee_model');
            $this->load->model('employee/employee_service');
        }
    }

    function manage_wages_category() {

        $wages_category_service = new wages_category_service();

        $data['heading'] = "Manage Wages Categories";
        $data['wages_categories'] = $wages_category_service->get_all_wages_categories();

        $parials = array('content' => 'wages_category/wages_category_view');
        $this->template->load('template/main_template', $parials, $data);
    }

  
    function edit_wages_category_view($wages_category_id) {

        $wages_category_service = new wages_category_service();
        $data['heading'] = "Edit Wages Category";
        $data['wages_category'] = $wages_category_service->get_wages_category_by_id($wages_category_id);

        $partials = array('content' => 'wages_category/edit_wages_category');
        $this->template->load('template/main_template', $partials, $data);
    }
/*this function use to ADD new wages category */
    function add_new_wages_category() {

        $wages_category_service = new wages_category_service();
        $wages_category_model = new wages_category_model();

        $wages_category_model->set_category_name($this->input->post('category_name', TRUE));
        $wages_category_model->set_basic_salary($this->input->post('basic_salary', TRUE));
        $wages_category_model->set_ot_rate($this->input->post('ot_rate', TRUE));
        $wages_category_model->set_allowance($this->input->post('allowance', TRUE));
        $wages_category_model->set_bonus($this->input->post('bonus', TRUE));
        $wages_category_model->set_del_ind('1');  
        $wages_category_model->set_added_by($this->session->userdata('wages_category_id'));
        $wages_category_model->set_added_date(date("Y-m-d H:i:s"));

        echo $wages_category_service->add_new_wages_category($wages_category_model);
    }
/*this function use to edit new wages category*/
    function edit_wages_category() {

        $wages_category_model = new Wages_category_model();
        $wages_category_service = new Wages_category_service();

        $wages_category_model->set_wages_category_id($this->input->post('wages_category_id', TRUE));
        $wages_category_model->set_category_name($this->input->post('category_name', TRUE));
        $wages_category_model->set_basic_salary($this->input->post('basic_salary', TRUE));
        $wages_category_model->set_ot_rate($this->input->post('ot_rate', TRUE));
        $wages_category_model->set_allowance($this->input->post('allowance', TRUE));
        $wages_category_model->set_bonus($this->input->post('bonus', TRUE));
        
       
        echo $wages_category_service->update_wages_category($wages_category_model);
    }



   /*this function use to delete wages category*/
 function delete_wages_category() {

//        $perm = Access_controllerservice :: checkAccess('DELETE_COMPANY');
//        if ($perm) {
        $wages_category_service = new wages_category_service();
        $employee_service = new employee_service();

        $employees = $employee_service->get_employees_by_wages_category_id_manage(trim($this->input->post('id', TRUE)));

        //if no employees are assigned to category we can delete otherwise we cant delete the wages_category
        if (count($employees) == 0) {
            echo $wages_category_service->delete_wages_category(trim($this->input->post('id', TRUE)));
        } else {
            echo 2;
        }
//        } else {
//            $this->template->load('template/access_denied_page');
//        }
    }
    
   

}
