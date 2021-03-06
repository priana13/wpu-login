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

    public function delete_menu(){

        $this->form_validation->set_rules('id' , 'ID' , 'required');
        
        if($this->form_validation->run() == false){

            $this->load->view('themplates/header', $data);
            $this->load->view('themplates/sidebar', $data);
            $this->load->view('themplates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('themplates/footer', $data);

        }else{
            $id = $this->input->post('id');
        
            $this->db->delete('user_menu', array('id' => $id));        

            redirect('menu');
        }



    }

    public function submenu(){

        $data['title'] = "Sub Menu Manajement";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('title' , 'Title' , 'required');
        $this->form_validation->set_rules('menu_id' , 'Menu' , 'required');
        $this->form_validation->set_rules('url' , 'URL' , 'required');
        $this->form_validation->set_rules('icon' , 'icon' , 'required');

        // Load Model dan diganti nama modelnya jadi menu
        $this->load->model('Menu_model' , 'menu');

        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();


        if($this->form_validation->run() == false){

            $this->load->view('themplates/header', $data);
            $this->load->view('themplates/sidebar', $data);
            $this->load->view('themplates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('themplates/footer', $data);

        }else{

            $data = [
                'title' => $this->input->post('title'), 
                'menu_id' => $this->input->post('menu_id'),
                'field_url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')

            ];

            $this->db->insert('user_sub_menu' , $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            New Sub Menu Added
            </div>');

            
            redirect('menu/submenu');

        }

    }

    public function delete_submenu(){

        $this->form_validation->set_rules('id' , 'ID' , 'required');
        
        if($this->form_validation->run() == false){

            $this->load->view('themplates/header', $data);
            $this->load->view('themplates/sidebar', $data);
            $this->load->view('themplates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('themplates/footer', $data);

        }else{
            $id = $this->input->post('id');
        
            $this->db->delete('user_sub_menu', array('id' => $id));        

            redirect('menu/submenu');
        }
    }

}