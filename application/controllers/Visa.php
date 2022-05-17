<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Visa extends CI_Controller {

 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('visa_model','visa');
    }
    

    public function load_view_visa() {
        $this->load->view('visa_view');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(site_url().'home/index/');
    }

    public function ajax_list()
    {
        $list = $this->visa->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $visa) {
            $no++;
            $row = array();
            $row[] = $visa->id;
            $row[] = $visa->im;
            $row[] = $visa->nom;
            $row[] = $visa->dateDepot;
            $row[] = $visa->dateEnvoie;
            $row[] = $visa->nature;
            

            //add html for action
        $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$visa->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
            <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_person('."'".$visa->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
            <a class="btn btn-sm btn-default" href="javascript:void(0)" title="View" onclick="view_person('."'".$visa->id."'".')"><i class="glyphicon glyphicon-file"></i> View</a>';

            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->visa->count_all(),
                        "recordsFiltered" => $this->visa->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }




    public function ajax_edit($id)
    {
        $data = $this->visa->get_by_id($id);
        echo json_encode($data);
    }


    public function ajax_add_visa()
    {
        $data = array(
                'im' => $this->input->post('im'),
                'nom' => $this->input->post('nom'),
                'dateDepot' => $this->input->post('dateDepot'),
                'dateEnvoie' => $this->input->post('dateEnvoie'),
                'observation' => $this->input->post('observation'),
                'service_direction' => $this->input->post('service_direction'),
                'ministere' => $this->input->post('ministere'),
                'bordereau' => $this->input->post('bordereau'),
                'analyse' => $this->input->post('analyse'),
                'dateDecision' => $this->input->post('dateDecision'),
                'nature' => $this->input->post('nature'),
            );
        $insert = $this->visa->save($data);
        echo json_encode(array("status" => TRUE));
    }



    public function ajax_update()
    {
        $data = array(
            'im' => $this->input->post('im'),
            'nom' => $this->input->post('nom'),
            'dateDepot' => $this->input->post('dateDepot'),
            'dateEnvoie' => $this->input->post('dateEnvoie'),
            'observation' => $this->input->post('observation'),
            'service_direction' => $this->input->post('service_direction'),
            'ministere' => $this->input->post('ministere'),
            'bordereau' => $this->input->post('bordereau'),
            'analyse' => $this->input->post('analyse'),
            'dateDecision' => $this->input->post('dateDecision'),
            'nature' => $this->input->post('nature'),
            );
        $this->visa->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }


    public function ajax_delete($id) {
        $this->visa->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

        public function list_by_id($id) {
          $data['output'] = $this->visa->get_by_id_view($id);
          $this->load->view('view_Detail_visa', $data);
         }


   
  
///////////////////////////////// importation and exportation excel////////////////////////////////////////////////////////////////////////////

         // exportation excel
         public function export() {
            error_reporting(E_ALL);
        
            include_once './assets/phpexcel/Classes/PHPExcel.php';
            $objPHPExcel = new PHPExcel();
    
            $data = $this->visa->select_all();

            $objPHPExcel = new PHPExcel(); 
            $objPHPExcel->setActiveSheetIndex(0); 
            $rowCount = 1; 
    
            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, "ID");
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, "IM");
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, "Nom");
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, "dateDepot");
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, "dateEnvoie");
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, "observation");
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, "service_direction");
            $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, "bordereau");
            $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, "analyse");
            $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, "ministere");
            $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, "projetAviser");
            $objPHPExcel->getActiveSheet()->SetCellValue('L'.$rowCount, "dateDecision");
            $rowCount++;

            foreach($data as $value){
                $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $value->id); 
                $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $value->im); 
                $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $value->nom); 
                $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $value->dateDepot); 
                $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $value->dateEnvoie); 
                
                $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $value->observation); 
                $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $value->service_direction); 
                $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, $value->bordereau); 
               
                $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, $value->analyse); 
                $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, $value->ministere); 

                $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, $value->projetAviser); 
                $objPHPExcel->getActiveSheet()->SetCellValue('L'.$rowCount, $value->dateDecision); 
                $rowCount++; 
            } 
    
            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
            $objWriter->save('./assets/excel/Data visa.xlsx'); 
    
            $this->load->helper('download');
            force_download('./assets/excel/Data visa.xlsx', NULL);
        }



// mbola ts vita
// importation sous excel
 public function import() {
    $this->form_validation->set_rules('excel', 'File', 'trim|required');

    if ($_FILES['excel']['name'] == '') {
        $this->session->set_flashdata('msg', 'File harus diisi');
    } else {
        $config['upload_path'] = './assets/excel/';
        $config['allowed_types'] = 'xls|xlsx';
        
        $this->load->library('upload', $config);
        
        if ( ! $this->upload->do_upload('excel')){
            $error = array('error' => $this->upload->display_errors());
        }
        else{
            $data = $this->upload->data();
            
            error_reporting(E_ALL);
            date_default_timezone_set('Asia/Jakarta');

            include './assets/phpexcel/Classes/PHPExcel/IOFactory.php';

            $inputFileName = './assets/excel/' .$data['file_name'];
            $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
            $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

            $index = 0;
            foreach ($sheetData as $key => $value) {
                if ($key != 1) {
                    $id = md5(DATE('ymdhms').rand());
                    $check = $this->chambre->check_im($value['B']);

                    if ($check != 1) {
                        $resultData[$index]['id'] = $id;
                        $resultData[$index]['im'] = ucwords($value['B']);
                        $resultData[$index]['nom'] = $value['C'];
                        $resultData[$index]['dateDepot'] = $value['D'];
                        $resultData[$index]['dateEnvoie'] = $value['E'];
                        $resultData[$index]['dateDecision'] = $value['F'];
                        $resultData[$index]['observation'] = $value['G'];
                        $resultData[$index]['service'] = $value['H'];
                        $resultData[$index]['numeroCompte'] = $value['I'];
                        $resultData[$index]['bordereau'] = $value['J'];
                        $resultData[$index]['titulaire'] = $value['K'];
                        $resultData[$index]['analyse'] = $value['L'];
                        $resultData[$index]['montant'] = $value['M'];
                    }
                }
                $index++;
            }

            unlink('./assets/excel/' .$data['file_name']);

            if (count($resultData) != 0) {
                $result = $this->chambre->insert_batch($resultData);
                if ($result > 0) {
                    $this->session->set_flashdata('msg', show_succ_msg('Data bien importer dans la base de donnee')); // Data Pegawai Berhasil diimport ke database
                    redirect('welcome/load_view');
                }
            } else {
                $this->session->set_flashdata('msg', show_msg('Data Pegawai Gagal diimport ke database (Data Sudah terupdate)', 'warning', 'fa-warning'));
                redirect('welcome/load_view');
            }

        }
    }
}





}

/* End of file Visa.php */
































?>