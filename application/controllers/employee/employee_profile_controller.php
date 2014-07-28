<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Employee_profile_controller extends CI_Controller {

    function __construct() {
        parent::__construct();

        if (!$this->session->userdata('EMPLOYEE_LOGGED_IN')) {
            redirect(site_url() . '/login/login_controller');
        } else {

            $this->load->model('employee/employee_model');
            $this->load->model('employee/employee_service');
        }
    }

    function view_profile() {

        $employee_service = new Employee_service();

        $data['heading'] = "My Profile";
        $data['employee_detail'] = $employee_service->get_employee_by_id($this->session->userdata('EMPLOYEE_CODE'));



        $partials = array('content' => 'employee/employee_profile_view');
        $this->template->load('template/main_template', $partials, $data);
    }

    function upload_employee_cover_pic() {

        $uploaddir = './uploads/employee_cover_pics/';
        $unique_tag = 'cover_pic';

        $filename = $unique_tag . time() . '-' . basename($_FILES['uploadfile']['name']); //this is the file name
        $file = $uploaddir . $filename; // this is the full path of the uploaded file

        if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) {
            echo $filename;
        } else {
            echo "error";
        }
    }

    function upload_employee_avatar() {

        $uploaddir = './uploads/employee_avatar/';
        $unique_tag = 'employee_avatar';

        $filename = $unique_tag . time() . '-' . basename($_FILES['uploadfile2']['name']); //this is the file name
        $file = $uploaddir . $filename; // this is the full path of the uploaded file

        if (move_uploaded_file($_FILES['uploadfile2']['tmp_name'], $file)) {
            echo $filename;
        } else {
            echo "error";
        }
    }

    function update_employee_avatar() {
        $employee_service = new Employee_service();
        $employee_model = new Employee_model();

        $employee_model->set_employee_avatar($this->input->post('employee_avatar', TRUE));

        echo $employee_service->update_employee_avatar($employee_model);
    }
    
    function edit_employee_profile($employee_code) {
//        $perm = Access_controllerservice :: checkAccess('EDIT_EMPLOYEE_PROFILE');
//        if ($perm) {

        $employee_service = new employee_service();


        $data['heading'] = "Edit Employee Details";
        $data['employee_detail'] = $employee_service->get_employee_by_id($employee_code);


        $partials = array('content' => 'employee/edit_employee_profile');
        $this->template->load('template/main_template', $partials, $data);
//        } else {
//            $this->template->load('template/access_denied_page');
//        }
    }
    
    public function get_task_for_employee() {

        $task_service = new Task_service();
        $result = $task_service->get_employee_task_by_project($this->input->post('employee_code'));
        
        echo json_encode($result);
    }
    
    
    


}

?>
