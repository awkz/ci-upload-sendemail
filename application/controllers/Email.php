<?php

class Email extends CI_Controller{
    public function index()
    {
        $this->load->view('email_form');
    }
    function send_email(){
        $to = $this->input->post('to');
        $subject = $this->input->post('subject');
        $message = $this->input->post('message');
        $config = Array(
            'protocol' => 'smtp',  
            'smtp_host' => 'ssl://smtp.googlemail.com',  
            'smtp_port' => 465,  
            'smtp_user' => 'arabkebalik@gmail.com',   
            'smtp_pass' => 'brasd789',   
            'mailtype' => 'html',   
            'charset' => 'iso-8859-1' 
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");

        // Set to, from, message, etc.

        $result = $this->email->send();
        $this->email->from('arabkebalik@gmail.com', 'Bara');
        $this->email->to($to); 

        $this->email->subject($subject);
        $this->email->message($message);  

        if ($this->email->send()) {
            $data['message_display'] = 'Email Successfully Send !';
            //echo $this->email->print_debugger();
        } else {
            $data['message_display'] =  '<p class="error_msg">Invalid Gmail Account or Password !</p>';
        }
        $this->load->view('email_form', $data);


    }
    function send_email_with_file(){
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 100000;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file')) {

            $data['message_display'] = $this->upload->display_errors();
        } else {
            $to = $this->input->post('to');
            $subject = $this->input->post('subject');
            $message = $this->input->post('message');
            $config = array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => 'arabkebalik@gmail.com',
                'smtp_pass' => 'brasd789',
                'mailtype' => 'html',
                'charset' => 'iso-8859-1'
            );
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");

            // Set to, from, message, etc.

            $result = $this->email->send();
            $this->email->from('arabkebalik@gmail.com', 'Bara');
            $this->email->to($to);
            $this->email->subject($subject);
            $this->email->message($message);
            $this->email->attach(base_url('uploads/').$this->upload->data('file_name'));
            if ($this->email->send()) {
                $data['message_display'] = 'Email Successfully Send !';
            //echo $this->email->print_debugger();
            } else {
                $data['message_display'] = '<p class="error_msg">Invalid Gmail Account or Password !</p>';
            }
        }
        $this->load->view('email_form', $data);
    }
    
}