<?php

 defined('BASEPATH') OR exit('No direct script access allowed');
 class Correspondance extends CI_Controller {
 
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('correspondance_model','correspondance');
        $this->load->model('visa_model','visa');
        $this->load->library('form_validation');
    }

    public function load_view_corresp() {
        
            //count correspondance
            $data['countvv'] = $this->correspondance->selectVisaa();
            $data['countaa'] = $this->correspondance->selectArrr();
            $data['countrejj'] = $this->correspondance->selectRejj();
            
            //max id corresp
            $data['maxid'] = $this->correspondance->select_maxid();
            //max id visa
           //  $data['maxidvisa'] = $this->visa->select_maxid_visa();

            $this->load->view('correspondance_view', $data);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(site_url().'home/index/');
    }

      //function delete all
   function delete_all()  {   
    if($this->input->post('checkbox_value'))   {    
        $id = $this->input->post('checkbox_value');    
        for($count = 0; $count < count($id); $count++)    {     
            $this->correspondance->delete($id[$count]);    
         }   
     }  
 }   

    //date range 
    public function search_date(){

        $first_date  =  $this->input->post('first_date');
        $second_date =  $this->input->post('second_date');
    
        //
        if(isset($_POST['true'])){
        $listDt = $this->correspondance->searchDepot($first_date, $second_date);
        $array1['output'] = $listDt->result();
        $this->load->view('daterangeCorresp', $array1);
        }

        //
        if(isset($_POST['false'])){
        $listDe = $this->correspondance->searchEnvoie($first_date, $second_date);
        $array2['output'] = $listDe->result();
        $this->load->view('daterangeCorresp', $array2);
        }

         // all dates
         if(isset($_POST['xor'])) {
            $array3['output'] = $this->correspondance->select_all();
            $this->load->view('daterangeCorresp',$array3);
        }
     
     }



    public function ajax_list()
    {
        $list = $this->correspondance->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $correspondance) {
            $no++;
            $row = array();
            $row[] = $correspondance->id;
            $row[] = $correspondance->im;
            $row[] = $correspondance->nom;
            $row[] = $correspondance->dateDepot;
            $row[] = $correspondance->dateEnvoie;
            $row[] = $correspondance->ministere;
            $row[] = '<a style="margin:0px auto;" class="btn btn-sm btn-success" href="javascript:void(0)" title="Deplace" onclick="deplace_add_to_visa('."'".$correspondance->id."'".')"> <img src="images/icons8_Data_16.png" /> Deplace </a>';
            

            //add html for action
        $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_corresp('."'".$correspondance->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
            <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_corresp('."'".$correspondance->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
            <a class="btn btn-sm btn-default" href="javascript:void(0)" title="View" onclick="view_person('."'".$correspondance->id."'".')"><i class="glyphicon glyphicon-file"></i> View</a>';

            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->correspondance->count_all(),
                        "recordsFiltered" => $this->correspondance->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }



///////////////View All list in ajax//////////////////////////////////
public function ajax_listViewAll()
    {
        $list = $this->correspondance->get_datatablesViewAll();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $correspondance) {
            $no++;
            $row = array();
            $row[] = $correspondance->id;
            $row[] = $correspondance->nom;
            $row[] = $correspondance->im;
            $row[] = $correspondance->dateDepot;
            $row[] = $correspondance->dateEnvoie;
            $row[] = $correspondance->observation;
            $row[] = $correspondance->service_direction;
            $row[] = $correspondance->nature;
            $row[] = $correspondance->bordereau;
            $row[] = $correspondance->analyse;
            $row[] = $correspondance->ministere;

            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->correspondance->count_all(),
                        "recordsFiltered" => $this->correspondance->count_filteredViewAll(),
                        "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }


     public function view_all_corresp() {
        $this->load->view('view_all_corresp');
     }



    public function ajax_edit($id)
    {
        $data = $this->correspondance->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_add()
    {
        $this->form_validation->set_error_delimiters('','');
        $this->form_validation->set_rules('im','im', 'required');
        $this->form_validation->set_rules('nom','nom', 'required');
        $this->form_validation->set_rules('dateDepot','dateDepot', 'required');
        $this->form_validation->set_rules('dateEnvoie','dateEnvoie', 'required');
        $this->form_validation->set_rules('observation','observation', 'required');
        $this->form_validation->set_rules('service_direction','service_direction', 'required');
        $this->form_validation->set_rules('ministere','ministere', 'required');
        $this->form_validation->set_rules('bordereau','bordereau', 'required');
        $this->form_validation->set_rules('nature','nature', 'required');
        $this->form_validation->set_rules('analyse','analyse', 'required');
        if($this->form_validation->run() == FALSE ) {
            echo validation_errors();
        }
        else {
            $data = array(
                'im' => $this->input->post('im'),
                'nom' => $this->input->post('nom'),
                'dateDepot' => $this->input->post('dateDepot'),
                'dateEnvoie' => $this->input->post('dateEnvoie'),
                'observation' => $this->input->post('observation'),
                'service_direction' => $this->input->post('service_direction'),
                'ministere' => $this->input->post('ministere'),
                'bordereau' => $this->input->post('bordereau'),
                'nature' => $this->input->post('nature'),
                'analyse' => $this->input->post('analyse'),
            );
        $insert = $this->correspondance->save($data);
        echo json_encode(array("status" => TRUE));
        }
       
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
            'nature' => $this->input->post('nature'),
            'analyse' => $this->input->post('analyse'),
            );
        $this->correspondance->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id) {
        $this->correspondance->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

        public function list_by_id($id) {
          $data['output'] = $this->correspondance->get_by_id_view($id);
          $this->load->view('view_Detail_corresp', $data);
         }

    

  
///////////////////////////////// importation and exportation excel////////////////////////////////////////////////////////////////////////////
// exportation excel
public function export() {
    error_reporting(E_ALL);

    include_once './assets/phpexcel/Classes/PHPExcel.php';
    $objPHPExcel = new PHPExcel();

    $data = $this->correspondance->select_all();

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
    $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, "nature");
    $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, "bordereau");
    $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, "analyse");
    $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, "ministere");
    $rowCount++;

    foreach($data as $value){
        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $value->id); 
        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $value->im); 
        $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $value->nom); 
        $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $value->dateDepot); 
        $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $value->dateEnvoie); 
        $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $value->observation); 
        $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $value->service_direction); 
        $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, $value->nature); 
        $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, $value->bordereau); 
        $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, $value->analyse); 
        $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, $value->ministere); 
        $rowCount++; 
    } 

    $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
    $objWriter->save('./assets/excel/Data correspondance.xlsx'); 

    $this->load->helper('download');
    force_download('./assets/excel/Data correspondance.xlsx', NULL);
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
                    $check = $this->correspondance->check_im($value['B']);

                    if ($check != 1) {
                        $resultData[$index]['id'] = $id;
                        $resultData[$index]['im'] = ucwords($value['B']);
                        $resultData[$index]['nom'] = $value['C'];
                        $resultData[$index]['dateDepot'] = $value['D'];
                        $resultData[$index]['dateEnvoie'] = $value['E'];
                        $resultData[$index]['observation'] = $value['F'];
                        $resultData[$index]['service_direction'] = $value['G'];
                        $resultData[$index]['nature'] = $value['H'];
                        $resultData[$index]['bordereau'] = $value['I'];
                        $resultData[$index]['analyse'] = $value['J'];
                        $resultData[$index]['ministere'] = $value['K'];
                    }
                }
                $index++;
            }

            unlink('./assets/excel/' .$data['file_name']);

            if (count($resultData) != 0) {
                $result = $this->correspondance->insert_batch($resultData);
                if ($result > 0) {
                    $url = $_SERVER['HTTP_REFERER'];
                    $this->session->set_flashdata('msg', show_succ_msg('Data bien importer dans la base de donnee')); // Data Pegawai Berhasil diimport ke database
                    redirect($url);
                }
            } else {
                $url = $_SERVER['HTTP_REFERER'];
                $this->session->set_flashdata('msg', show_msg('Data Pegawai Gagal diimport ke database (Data Sudah terupdate)', 'warning', 'fa-warning'));
                redirect($url);
            }

        }
    }
}






 }
 
?>