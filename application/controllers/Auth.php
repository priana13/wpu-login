<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Login";
        $this->load->view('themplates/auth/header');
        $this->load->view('auth/login');
        $this->load->view('themplates/auth/footer');
    }

    public function registration()
    {

        $this->form_validation->set_rules('name', 'Name', 'required|trim');

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password1', 'Password1', 'required|matches[password2]');
        $this->form_validation->set_rules('password2', 'Password2', 'required|matches[password1]');

        if ($this->form_validation->run() == false) {

            $data['title'] = "Registrasi";

            $this->load->view('themplates/auth/header', $data);
            $this->load->view('auth/registration');
            $this->load->view('themplates/auth/footer');
        } else {

            $data = [
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 1,
                'is_active' => 1,
                'date_created' => time()
            ];

            $this->db->insert('user', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Alhamdulillah, Anda berhasil melakukan registrasi
          </div>');

            redirect('auth');
        }
    }

    public function page()
    {

        echo 'test page';
    }
}