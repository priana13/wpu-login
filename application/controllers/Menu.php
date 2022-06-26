<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{

    public function index(){

        $data['title'] = "Menu Manajement";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu' , 'Menu' , 'required');

        if($this->form_validation->run() == false){

            $this->load->view('themplates/header', $data);
            $this->load->view('themplates/sidebar', $data);
            $this->load->view('themplates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('themplates/footer', $data);
        }else{

            $this->db->insert('user_menu' , ['menu' => $this->input->post('menu') ]);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            New Menu Added
          </div>');

          redirect('menu');

        }

     
    }

}