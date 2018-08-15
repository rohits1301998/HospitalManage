<?php

class Pages extends CI_Controller {

        public function view($page = 'home')
        {
            if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
            {
                    // Whoops, we don't have a page for that!
                    show_404();
            }
    
            $data['title'] = ucfirst($page); // Capitalize the first letter
            $this->load->library('session');
            if($page=='opd'){
                $this->load->model('OpdModel');
                $srNo = $this->OpdModel->getMaxSerial();
                $receipt = $this->OpdModel->prepareReceiptNo($srNo);
                $data['srNo']=$srNo;
                $data['receipt']=$receipt;
            }
            $this->load->view('templates/header', $data);
            $this->load->view('pages/'.$page, $data);
            $this->load->view('templates/footer', $data);
        }

        public function opdSubmit(){
                $inputs = $this->input->post();
                $this->load->model('OpdModel');
                $srNo = $this->OpdModel->getMaxSerial();
                $receipt = $this->OpdModel->prepareReceiptNo($srNo);
                $data=["receipt_no"=>$receipt,"patient_name"=>$inputs["full_name"],"contact_no"=>$inputs["contact_number"],"address"=>$inputs["residential_addrs"],"age"=>$inputs["age"],"diagnosis"=>$inputs["diagnosis"],"sex"=>$inputs["optionsRadios"],"checked_by"=>$inputs["doctor"],"remarks"=>$inputs["feedback"]];
                $this->OpdModel->insertOpdDetails($data);
                redirect('/pages/view/opd');
        }

        
}


?>