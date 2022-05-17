<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

        public function __construct()
    {
        parent::__construct();
        $this->load->model('chambre_model','chambre');
        $this->load->model('visa_model','visa');
        $this->load->model('correspondance_model','correspondance');
    }

        

	public function index()
	{
        $data['nbvisa'] = $this->visa->total_rows_visa();
        $data['nbcorresp'] = $this->correspondance->total_rows_corresp();
        $data['nbcham'] = $this->chambre->total_rows_chambre();

          //count chambre
          $data['countv'] = $this->chambre->selectVisa();
          $data['counta'] = $this->chambre->selectArr();
          $data['countrej'] = $this->chambre->selectRej();
          //

            //count correspondance
            $data['countvv'] = $this->correspondance->selectVisaa();
            $data['countaa'] = $this->correspondance->selectArrr();
            $data['countrejj'] = $this->correspondance->selectRejj();
            //

        $this->load->view('welcome_message', $data);
      
	}

    public function Load_view()
    {
      
        //count 
        $data['countv'] = $this->chambre->selectVisa();
        $data['counta'] = $this->chambre->selectArr();
        $data['countrej'] = $this->chambre->selectRej();

        //MAX ID 
        $data['maxid'] = $this->chambre->select_maxid();
        $this->load->view('chambre_view',$data);
    }

  

    public function Load_chartchambre()
    {
        //visee
        $data['sjv'] = $this->chambre->countJanvierVisee();
        $data['sfv'] = $this->chambre->countFevierVisee();
        $data['smv'] = $this->chambre->countMarsVisee();
        $data['sav'] = $this->chambre->countAvrilVisee();
        $data['smaiv'] = $this->chambre->countMaiVisee();
        $data['sjuv'] = $this->chambre->countJuinVisee();

        //arrivee
        $data['sja'] = $this->chambre->countJanvierArriver();
        $data['sfa'] = $this->chambre->countFevierArrivee();
        $data['sma'] = $this->chambre->countMarsArrivee();
        $data['saa'] = $this->chambre->countAvrilArrivee();
        $data['smaia'] = $this->chambre->countMaiArrivee();
        $data['sjua'] = $this->chambre->countJuinArrivee();

         //rejete
         $data['sjr'] = $this->chambre->countJanvierRejete();
         $data['sfr'] = $this->chambre->countFevierRejete();
         $data['smr'] = $this->chambre->countMarsRejete();
         $data['sar'] = $this->chambre->countAvrilRejete();
         $data['smair'] = $this->chambre->countMaiRejete();
         $data['sjur'] = $this->chambre->countJuinRejete();

        
        
        $this->load->view('chartchambre', $data);
    }

    public function Load_chartCorr()
    {
         //count correspondance
         $data['countvv'] = $this->correspondance->selectVisaa();
         $data['countaa'] = $this->correspondance->selectArrr();
         $data['countrejj'] = $this->correspondance->selectRejj();

        $this->load->view('chartCorresp', $data);
    }

    public function Load_Activity()
    {
        $this->load->view('activity');
    }

        public function Load_Notes()
    {
        $this->load->view('notes');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(site_url().'Auth');
    }

   //function delete all
   function delete_all()  {   
       if($this->input->post('checkbox_value'))   {    
           $id = $this->input->post('checkbox_value');    
           for($count = 0; $count < count($id); $count++)    {     
               $this->chambre->delete($id[$count]);    
            }   
        }  
    }   


    // function search date range
     public function search_date(){

          $first_date  =  $this->input->post('first_date');
          $second_date =  $this->input->post('second_date');
          
          //date Depot
          if(isset($_POST['true'])){
          $listDt = $this->chambre->searchDepot($first_date, $second_date);
          $array1['output'] = $listDt->result();
          $this->load->view('daterangeChambre', $array1);
          }
          
          //date envoie
          if(isset($_POST['false'])){
          $listDe = $this->chambre->searchEnvoie($first_date, $second_date);
          $array2['output'] = $listDe->result();
          $this->load->view('daterangeChambre', $array2);
          }
          
          // all dates
          if(isset($_POST['xor'])) {
              $array3['output'] = $this->chambre->select_all();
              $this->load->view('daterangeChambre',$array3);
          }
       
       }


    public function ajax_list()
    {
        $list = $this->chambre->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $chambre) {
            $no++;
            $row = array();
            $row[] = $chambre->id;
            $row[] = $chambre->im;
            $row[] = $chambre->nom;
            $row[] = $chambre->dateDepot;
            $row[] = $chambre->dateEnvoie;
            

            //add html for action
        $row[] = '<a class="btn btn-sm btn-primary" id="edit" href="javascript:void(0)" title="Edit" onclick="edit_chambre('."'".$chambre->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
            <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_chambre('."'".$chambre->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
            <a class="btn btn-sm btn-default" href="javascript:void(0)" title="View" onclick="view_chambre('."'".$chambre->id."'".')"><i class="glyphicon glyphicon-file"></i> View</a>';

            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->chambre->count_all(),
                        "recordsFiltered" => $this->chambre->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_edit($id)
    {
        $data = $this->chambre->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_add()
    {
        $data = array(
                'id' => $this->input->post('id'),
                'im' => $this->input->post('im'),
                'nom' => $this->input->post('nom'),
                'dateDepot' => $this->input->post('dateDepot'),
                'dateEnvoie' => $this->input->post('dateEnvoie'),
                'observation' => $this->input->post('observation'),
                'service' => $this->input->post('service'),
                'numeroCompte' => $this->input->post('numeroCompte'),
                'bordereau' => $this->input->post('bordereau'),
                'titulaire' => $this->input->post('titulaire'),
                'analyse' => $this->input->post('analyse'),
                'montant' => $this->input->post('montant'),
                'dateDecision' => $this->input->post('dateDecision'),
            );
        $insert = $this->chambre->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update()
    {
        $data = array(
            'id' => $this->input->post('id'),
            'im' => $this->input->post('im'),
            'nom' => $this->input->post('nom'),
            'dateDepot' => $this->input->post('dateDepot'),
            'dateEnvoie' => $this->input->post('dateEnvoie'),
            'observation' => $this->input->post('observation'),
            'service' => $this->input->post('service'),
            'numeroCompte' => $this->input->post('numeroCompte'),
            'bordereau' => $this->input->post('bordereau'),
            'titulaire' => $this->input->post('titulaire'),
            'analyse' => $this->input->post('analyse'),
            'montant' => $this->input->post('montant'),
            'dateDecision' => $this->input->post('dateDecision'),
            );
        $this->chambre->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id) {
        $this->chambre->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

        public function list_by_id($id) {
          $data['output'] = $this->chambre->get_by_id_view($id);
          $this->load->view('view_Detail_chambre', $data);
         }

///////date between////////////////////////

public function ajax_date() {
  $this->chambre->ajax_date(array('dateDepot' => $this->input->post('min')), array('dateDepot' => $this->input->post('max')));
  echo json_encode(array("status" => TRUE));
}
        

///////////////View All list in ajax//////////////////////////////////
public function ajax_listViewAll()
    {
        $list = $this->chambre->get_datatablesViewAll();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $chambre) {
            $no++;
            $row = array();
            $row[] = $chambre->id;
            $row[] = $chambre->im;
            $row[] = $chambre->nom;
            $row[] = $chambre->dateDepot;
            $row[] = $chambre->dateEnvoie;
            $row[] = $chambre->dateDecision;
            $row[] = $chambre->observation;
            $row[] = $chambre->service;
            $row[] = $chambre->numeroCompte;
            $row[] = $chambre->bordereau;
            $row[] = $chambre->titulaire;
            $row[] = $chambre->analyse;
            $row[] = $chambre->montant;

            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->chambre->count_all(),
                        "recordsFiltered" => $this->chambre->count_filteredViewAll(),
                        "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }


     public function view_all_chambre() {
        $this->load->view('view_all_chambre');
     }
     
///////////////////////////////// importation and exportation excel////////////////////////////////////////////////////////////////////////////

         // exportation excel
         public function export() {
            error_reporting(E_ALL);
        
            include_once './assets/phpexcel/Classes/PHPExcel.php';
            $objPHPExcel = new PHPExcel();
    
            $data = $this->chambre->select_all();

            $objPHPExcel = new PHPExcel(); 
            $objPHPExcel->setActiveSheetIndex(0); 
            $rowCount = 1; 
    
            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, "ID");
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, "IM");
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, "Nom");
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, "dateDepot");
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, "dateEnvoie");
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, "dateDecision");
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, "observation");
            $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, "service");
            $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, "numeroCompte");
            $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, "bordereau");
            $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, "titulaire");
            $objPHPExcel->getActiveSheet()->SetCellValue('L'.$rowCount, "analyse");
            $objPHPExcel->getActiveSheet()->SetCellValue('M'.$rowCount, "montant");
            $rowCount++;

            foreach($data as $value){
                $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $value->id); 
                $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $value->im); 
                $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $value->nom); 
                $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $value->dateDepot); 
                $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $value->dateEnvoie); 
                $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $value->dateDecision); 
                $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $value->observation); 
                $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, $value->service); 
                $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, $value->numeroCompte); 
                $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, $value->bordereau); 
                $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, $value->titulaire); 
                $objPHPExcel->getActiveSheet()->SetCellValue('L'.$rowCount, $value->analyse); 
                $objPHPExcel->getActiveSheet()->SetCellValue('M'.$rowCount, $value->montant); 
                $rowCount++; 
            } 
    
            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
            $objWriter->save('./assets/excel/Data chambre.xlsx'); 
    
            $this->load->helper('download');
            force_download('./assets/excel/Data chambre.xlsx', NULL);
        }




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
                    redirect('welcome');
                }
            } else {
                $this->session->set_flashdata('msg', show_msg('Data Pegawai Gagal diimport ke database (Data Sudah terupdate)', 'warning', 'fa-warning'));
                redirect('welcome/load_view');
            }

        }
    }
}









}






















