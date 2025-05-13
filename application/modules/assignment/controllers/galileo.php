<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function _construct(){
		parent::_construct();
		$this->load->model('galileo_model');
	}
	public function index()
	{ 
			$this->load->view('index');
	}

	/* GLOBAL FUNCTION */

		public function insertInTable($tableName,$option){
			if($tableName!="" && count($option) > 0){
			$dataArr = $this->galileo_model->insertInTable($tableName,$option); 
			
			if($dataArr!=false){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
		}


		public function getAlltableData($tableName,$redirectClass='',$succesPage='',$option){
			if($redirectClass!=""){
				if($tableName!=""){
					$dataArr = $this->galileo_model->getAlltableData($tableName,$option); 
					if($dataArr!=FALSE){
						$data['defaultData'] = $dataArr; 
						$this->load->view($succesPage,$data);
					}else{
						redirect('galileo/'.$redirectClass);
					}
				}else{
					redirect('galileo/'.$redirectClass);
				}
			}else{
				$dataArr = $this->galileo_model->getAlltableData($tableName,$option); 
				return  $dataArr;
			}
		
	}

	public function getDataFromTableById($tableName,$redirectClass,$succesPage,$option){
		if($tableName!="" && count($option) > 0){
			$dataArr = $this->galileo_model->getDataFromTableById($tableName,$option); 
			if($dataArr!=FALSE){
				$data['defaultEditData'] = $dataArr; 
				$this->load->view($succesPage,$data);
			}else{
				redirect('galileo/'.$redirectClass);
			}
		}else{
			redirect('galileo/'.$redirectClass);
		}
		
	}

	public function deleteResultFromTable($tableName,$option){
		if($tableName!="" && count($option) > 0){
			$dataArr = $this->galileo_model->deleteResultFromTable($tableName,$option); 
			
			if($dataArr!=false){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}


	public function changeStatusTable($tableName,$option,$where){
		if($tableName!="" && count($option) > 0 &&  count($where) > 0){
			$dataArr = $this->galileo_model->changeStatusTable($tableName,$option,$where); 
			if($dataArr!=false){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	/* GLOBAL FUNCTION END */

	/* AGENCY START  */

	public function addAgency(){
		$this->load->view('add-agency');
	}

	public function addAgencyAction(){
		$this->form_validation->set_rules('agencyName', 'Agency Name', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('add-agency');
		}
		else
		{
			$data = array('agency-name'=>$this->input->post('agencyName'),
						  'added-date'=>date("Y-m-d h:i:s"),
						  'added-by'=>'1511in15'
						  );
			$this->insertInTable('agency-name',$data);
			redirect('galileo/agencyList');
		}
	}

	public function agencyList(){

		$dataArr = $this->getAlltableData('agency-name','agencyList','agency-list',array());
	}

	public function editAgency(){
		$agencyId = $this->uri->segment(3);
		$opt = array('agencyId' => $agencyId);
		$this->getDataFromTableById('agency-name','agency-list','edit-agency',$opt);
	}

	public function editAgencyAction(){
		$agencyid = $this->input->post('agencyId');
		$this->form_validation->set_rules('agencyName', 'Agency Name', 'required');
		if ($this->form_validation->run() == FALSE)
		{ 
			redirect('galileo/agencyList');
		}
		else
		{ 
			$data = array('agency-name'=>$this->input->post('agencyName')
						  );
			$this->changeStatusTable('agency-name',$data,array('agencyId'=>$agencyid));
			redirect('galileo/agencyList');
		}
		
	}

	public function changeAgencyStatus(){
		$agencyId = $this->uri->segment(3);
		$statusId = ($this->uri->segment(4)==1)?0:1; 
		$dataArr = $this->changeStatusTable('agency-name',array('status'=>$statusId),array('agencyId'=>$agencyId));
		redirect('galileo/agencyList');
	}


	public function deleteAgency(){
		$agencyId = $this->uri->segment(3); 
		$dataArr = $this->deleteResultFromTable('agency-name',array('agencyId'=>$agencyId));
		redirect('galileo/agencyList');
	}

	/* AGENCY END  */


	/* PCC START  */

	public function addpcc(){
		$arrPcc = $this->getAlltableData('agency-name','','',array('status'=>1));
		$data['agencies'] = $arrPcc;
		$this->load->view('add-pcc',$data);
	}

	public function addpccAction(){
		$this->form_validation->set_rules('pccName', 'PCC Name', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('add-pcc');
		}
		else
		{
			$data = array('pcc'=>$this->input->post('pccName'),
				          'agencyId'=>$this->input->post('agencyName'),
						  'addedDate'=>date("Y-m-d h:i:s")
						  ); 
			$this->insertInTable('master-pcc',$data);
			redirect('galileo/pccList');
		}
	}

	public function pccList(){

		$dataArr = $this->getAlltableData('master-pcc','addpcc','pcc-list',array());
	}

	public function editpcc(){
		$pccId = $this->uri->segment(3);
		$opt = array('pccId' => $pccId);
		$this->getDataFromTableById('master-pcc','pcc-list','edit-pcc',$opt);
	}

	public function editpccAction(){
		$agencyid = $this->input->post('pccId');
		$this->form_validation->set_rules('pccName', 'PCC Name', 'required');
		if ($this->form_validation->run() == FALSE)
		{ 
			redirect('galileo/pccList');
		}
		else
		{ 
			$data = array('pcc'=>$this->input->post('pccName'),
						  'agencyId'=>$this->input->post('agencyName')
						  );
			$this->changeStatusTable('master-pcc',$data,array('pccId'=>$agencyid));
			redirect('galileo/pccList');
		}
		
	}


	public function changepccStatus(){
		$pccId = $this->uri->segment(3);
		$statusId = ($this->uri->segment(4)==1)?0:1; 
		$dataArr = $this->changeStatusTable('master-pcc',array('status'=>$statusId),array('pccId'=>$pccId));
		redirect('galileo/pccList');
	}


	public function deletepcc(){
		$pccId = $this->uri->segment(3); 
		$dataArr = $this->deleteResultFromTable('master-pcc',array('pccId'=>$pccId));
		redirect('galileo/pccList');
	}

	/* PCC END  */



	/* PROBLEM START  */

	public function addproblem(){
		$arrPcc = $this->getAlltableData('problems','','',array('status'=>1));
		$data['agencies'] = $arrPcc;
		$this->load->view('add-problem',$data);
	}

	public function addproblemAction(){
		$this->form_validation->set_rules('problemName', 'Problem Name', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('add-problem');
		}
		else
		{
			$data = array('problem-title'=>$this->input->post('problemName'),
				          'added-by'=>'1511in15',
						  'added-date'=>date("Y-m-d h:i:s")
						  ); 
			$this->insertInTable('problems',$data);
			redirect('galileo/problemList');
		}
	}

	public function problemList(){

		$dataArr = $this->getAlltableData('problems','addproblem','problem-list',array());
	}

	public function editproblem(){
		$pccId = $this->uri->segment(3);
		$opt = array('problemId' => $pccId);
		$this->getDataFromTableById('problems','problem-list','edit-problem',$opt);
	}

	public function editproblemAction(){
		$agencyid = $this->input->post('problemId');
		$this->form_validation->set_rules('problemName', 'Problem', 'required');
		if ($this->form_validation->run() == FALSE)
		{ 
			redirect('galileo/problemList');
		}
		else
		{ 
			$data = array('problem-title'=>$this->input->post('problemName')
						  );
			$this->changeStatusTable('problems',$data,array('problemId'=>$agencyid));
			redirect('galileo/problemList');
		}
		
	}


	public function changeproblemStatus(){
		$pccId = $this->uri->segment(3);
		$statusId = ($this->uri->segment(4)==1)?0:1; 
		$dataArr = $this->changeStatusTable('problems',array('status'=>$statusId),array('problemId'=>$pccId));
		redirect('galileo/problemList');
	}


	public function deleteproblem(){
		$pccId = $this->uri->segment(3); 
		$dataArr = $this->deleteResultFromTable('problems',array('problemId'=>$pccId));
		redirect('galileo/problemList');
	}

	/* PROBLEM END  */


	/* PRODUCT START  */

	public function addproduct(){
		$arrPcc = $this->getAlltableData('product','','',array('status'=>1));
		$data['agencies'] = $arrPcc;
		$this->load->view('add-product',$data);
	}

	public function addproductAction(){
		$this->form_validation->set_rules('productName', 'Product Name', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('add-product');
		}
		else
		{
			$data = array('product-title'=>$this->input->post('productName'),
				          'added-by'=>'1511in15',
						  'added-date'=>date("Y-m-d h:i:s")
						  ); 
			$this->insertInTable('product',$data);
			redirect('galileo/productList');
		}
	}

	public function productList(){

		$dataArr = $this->getAlltableData('product','addproduct','product-list',array());
	}

	public function editproduct(){
		$pccId = $this->uri->segment(3);
		$opt = array('productId' => $pccId);
		$this->getDataFromTableById('product','product-list','edit-product',$opt);
	}

	public function editproductAction(){
		$agencyid = $this->input->post('productId');
		$this->form_validation->set_rules('productName', 'Product', 'required');
		if ($this->form_validation->run() == FALSE)
		{ 
			redirect('galileo/productList');
		}
		else
		{ 
			$data = array('product-title'=>$this->input->post('productName')
						  );
			$this->changeStatusTable('product',$data,array('productId'=>$agencyid));
			redirect('galileo/productList');
		}
		
	}


	public function changeproductStatus(){
		$pccId = $this->uri->segment(3);
		$statusId = ($this->uri->segment(4)==1)?0:1; 
		$dataArr = $this->changeStatusTable('product',array('status'=>$statusId),array('productId'=>$pccId));
		redirect('galileo/productList');
	}


	public function deleteproduct(){
		$pccId = $this->uri->segment(3); 
		$dataArr = $this->deleteResultFromTable('product',array('productId'=>$pccId));
		redirect('galileo/productList');
	}

	/* PRODUCT END  */

	/* STATUS START  */

	public function addstatus(){
		$arrPcc = $this->getAlltableData('status','','',array('status'=>1));
		$data['agencies'] = $arrPcc;
		$this->load->view('add-status',$data);
	}

	public function addstatusAction(){
		$this->form_validation->set_rules('statusName', 'Status Name', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('add-status');
		}
		else
		{
			$data = array('status-title'=>$this->input->post('statusName'),
				          'added-by'=>'1511in15',
						  'added-date'=>date("Y-m-d h:i:s")
						  ); 
			$this->insertInTable('status',$data);
			redirect('galileo/statusList');
		}
	}

	public function statusList(){

		$dataArr = $this->getAlltableData('status','addstatus','status-list',array());
	}

	public function editstatus(){
		$pccId = $this->uri->segment(3);
		$opt = array('statusId' => $pccId);
		$this->getDataFromTableById('status','status-list','edit-status',$opt);
	}

	public function editstatusAction(){
		$agencyid = $this->input->post('statusId');
		$this->form_validation->set_rules('statusName', 'Status', 'required');
		if ($this->form_validation->run() == FALSE)
		{ 
			redirect('galileo/statusList');
		}
		else
		{ 
			$data = array('status-title'=>$this->input->post('statusName')
						  );
			$this->changeStatusTable('status',$data,array('statusId'=>$agencyid));
			redirect('galileo/statusList');
		}
		
	}


	public function changestatusStatus(){
		$pccId = $this->uri->segment(3);
		$statusId = ($this->uri->segment(4)==1)?0:1; 
		$dataArr = $this->changeStatusTable('status',array('status'=>$statusId),array('statusId'=>$pccId));
		redirect('galileo/statusList');
	}


	public function deletestatus(){
		$pccId = $this->uri->segment(3); 
		$dataArr = $this->deleteResultFromTable('status',array('statusId'=>$pccId));
		redirect('galileo/statusList');
	}

	/* STATUS END  */



	/* CALL LOG START  */

	public function addcallLog(){
		$data['pcc'] = $this->getAlltableData('master-pcc','','',array('status'=>1));
		$data['agency'] = $this->getAlltableData('agency-name','','',array('status'=>1));
		$data['problems'] = $this->getAlltableData('problems','','',array('status'=>1));
		$data['status'] = $this->getAlltableData('status','','',array('status'=>1));
		$data['product'] = $this->getAlltableData('product','','',array('status'=>1));
		$this->load->view('add-calls',$data);
	}

	public function addcallLogAction(){
		$this->form_validation->set_rules('pccName', 'PCC Name', 'required');
		$this->form_validation->set_rules('agencyName', 'Agency Name', 'required');
		$this->form_validation->set_rules('issueName', 'Issue Title', 'required');
		$this->form_validation->set_rules('PNRNumber', 'PNR', 'required');
		$this->form_validation->set_rules('CallerName', 'Caller Name', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('statusTitle', 'Status Title', 'required');
		$this->form_validation->set_rules('productName', 'Product Name', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('add-calls');
		}
		else
		{
			$data = array('pccId'=>$this->input->post('pccName'),
						  'agencyId'=>$this->input->post('agencyName'),
						  'problemId'=>$this->input->post('issueName'),
						  'pnr'=>$this->input->post('PNRNumber'),
						  'caller'=>$this->input->post('CallerName'),
						  'description'=>$this->input->post('description'),
						  'statusId'=>$this->input->post('statusTitle'),
						  'productId'=>$this->input->post('productName'),
				          'addedBy'=>'1511in15',
						  'callDate'=>date("Y-m-d h:i:s"),
						  'updateDate'=>date("Y-m-d h:i:s"),
						  ); 
			$this->insertInTable('callLog',$data);
			redirect('galileo/callLogList');
		}
	}

	public function callLogList(){

		$dataArr = $this->getAlltableData('callLog','addcallLog','calls-list',array());
	}

	public function editcallLog(){
		$pccId = $this->uri->segment(3);
		$opt = array('productId' => $pccId);
		$this->getDataFromTableById('callLog','calls-list','edit-calls',$opt);
	}

	public function editcallLogAction(){
		$agencyid = $this->input->post('callLogId');
		$this->form_validation->set_rules('productName', 'Product', 'required');
		if ($this->form_validation->run() == FALSE)
		{ 
			redirect('galileo/callLogList');
		}
		else
		{ 
			$data = array('product-title'=>$this->input->post('productName')
						  );
			$this->changeStatusTable('callLog',$data,array('productId'=>$agencyid));
			redirect('galileo/callLogList');
		}
		
	}


	public function changeCallLogStatus(){
		$pccId = $this->uri->segment(3);
		$statusId = ($this->uri->segment(4)==1)?0:1; 
		$dataArr = $this->changeStatusTable('callLog',array('status'=>$statusId),array('productId'=>$pccId));
		redirect('galileo/callLogList');
	}


	public function deletecallLog(){
		$pccId = $this->uri->segment(3); 
		$dataArr = $this->deleteResultFromTable('callLog',array('productId'=>$pccId));
		redirect('galileo/callLogList');
	}

	/* CALL LOG END  */

	
} 

