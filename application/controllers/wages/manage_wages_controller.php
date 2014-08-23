<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class manage_wages_controller extends CI_Controller {

    function __construct() {
        parent::__construct();

        if (!$this->session->userdata('EMPLOYEE_LOGGED_IN')) {
            redirect(site_url() . '/login/login_controller');
        } else {
//            $this->load->model('employee/employee_model');
//            $this->load->model('employee/employee_service');
            
            $this->load->model('company/company_model');
            $this->load->model('company/company_service');
           
        }
    }

    function manage_wages() {

//        $employee_service = new employee_service();
        $company_service = new company_service();
       

        $data['heading'] = "Wages Management";
//        $data['employees'] = $employee_service->get_employees_by_company_id_manage($this->session->userdata('EMPLOYEE_COMPANY_CODE'));
        $data['companies'] = $company_service->get_company_by_id($this->session->userdata('company_code'));
       
        
        $partials = array('content' => 'wages/manage_wages_view');
        $this->template->load('template/main_template', $partials, $data);
    }

}
