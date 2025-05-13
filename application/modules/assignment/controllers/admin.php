<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function _construct(){
		parent::__construct();
		$this->load->model('galileo_model');
		$this->load->library('session');
	}
	public function checkuserloginonpage(){
		$result = $this->session->userdata('userid');
		if($result){
			return true;
		}else{
			redirect('admin/index');
		}
	}
	public function index()
	{ 
		//$this->checkuserloginonpage();
		$data['title'] = $this->titleclass->Tdashboard();
		$this->load->view('login',$data);
	}
	
	public function testing(){
		$dataArr = $this->galileo_model->testingData();
		echo json_encode($dataArr);

	}
	public function checkLogin(){
		$this->form_validation->set_rules('username', 'Email', 'required');
		$this->form_validation->set_rules('userpassword', 'Password', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('index');
		}
		else
		{
			$option = array('userName'=>$this->input->post('username'),
				'userEmail'=>$this->input->post('username'),
				'userPass'=>$this->input->post('userpassword')
				);
			$tableName = "users";
			$dataArr = $this->galileo_model->checkuserlogin($tableName,$option); 
			if($dataArr){ 
				$ses = array('userid'=>$dataArr[0]['userId'],
						'fname'=>$dataArr[0]['firstName'],
						'lname'=>$dataArr[0]['lastName'],
						'uname'=>$dataArr[0]['userName'],
						'email'=>$dataArr[0]['userEmail'],
						'role'=>$dataArr[0]['userRole'],
						'activeDate'=>$dataArr[0]['userAddedDate'],
						'picture'=>$dataArr[0]['picture']
					);
				$this->session->set_userdata($ses);
				redirect('admin/dashboard');
			}
		}
	}

	public function dashboard(){
		$this->checkuserloginonpage();
		$data['tresult'] = $this->galileo_model->getTablesDetails();
		$data['boldmenu'] = 'dashboard';
		$options = "";
		$opttt = Array('drive_start_date >='=>date('d-m-Y'));
		$data['total'] = $this->student_model->getTotalRecords('student');
		$data['totalVaccination'] = $this->student_model->getTotalRecords('vaccine_registration');
		$data['totalUpcoming'] = $this->student_model->getTotalRecords('drive',$opttt);
		$data['title'] = $this->titleclass->Tdashboard();
		$this->load->view('index',$data);
	}
	
	public function sessionout(){
		$this->session->sess_destroy();
		redirect('admin/index');
	}

	/* GLOBAL FUNCTION */

		public function insertInTable($tableName,$option){
			if($tableName!="" && count($option) > 0){
			$dataArr = $this->galileo_model->insertInTable($tableName,$option); 
			
			if($dataArr!=false){
				return $dataArr;
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

	public function getDataFromTableById($tableName,$redirectClass,$succesPage,$option,$other=""){
		if($tableName!="" && count($option) > 0){
			$dataArr = $this->galileo_model->getDataFromTableById($tableName,$option); 
			if($dataArr!=FALSE){
				if($other!=""){
					$data['arrList'] = $other;
				}
				$data['error'] = "";
				$data['defaultEditData'] = $dataArr; 
				$data['boldmenu'] = "";
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

	public function getLAstIDFromTable($tableName){
		if($tableName){
			$dataArr = $this->galileo_model->getLAstIDFromTable($tableName);
			return $dataArr;
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

	/* ECO START */

	public function continent(){
		$this->checkuserloginonpage();
		$dataArr = $this->getAlltableData('continents','','',array());
		$data['defaultData'] = $dataArr;
		$this->load->view('continent',$data);
	}
	public function country(){
		$dataArr = $this->getAlltableData('country','','',array());
		$data['defaultData'] = $dataArr;
		$this->load->view('country',$data);
	}
	public function addCountryDetails($n){
		if(!empty($n)){
			$data['countryId'] = $n;
			$this->load->view('country-details',$data);
		}else{
			redirect('admin/country');
		}
	}
	public function countryDetailsAction($id){
		$this->form_validation->set_rules('countryId', 'Country id not found', 'required');
		if ($this->form_validation->run() == FALSE)
		{ 
			redirect('admin/country');
		}
		else
		{ 
			$filename = 'noimage.png';
			if(!empty($_FILES['file']['name'])){
			$k = rand(1000,999);
				$fileExtention = end(explode('.', $_FILES['file']['name']));
				$filename = date('dmyhms').time().'.'.$fileExtention;
				$fileGetMove = move_uploaded_file($_FILES['file']['tmp_name'], '../wp-backend/uploads/countryimage/'.$filename);

				if($fileGetMove){
					$filename = $filename;
				}else{
					$filename = 'noimage.png';
				}
				$data = array('CId'=>$this->input->post('countryId'),
						'CDetails'=>$this->input->post('countryDetails'),
						'CImage'=>$filename,
						'CDate'=>date("Y-m-d h:i:s")
						);
			}else{
				$data = array('CId'=>$this->input->post('countryId'),
						'CDetails'=>$this->input->post('countryDetails'),
						'userAddedDate'=>date("Y-m-d h:i:s")
						);
			}

			$resultID = $this->insertInTable('countrydetails',$data);
			redirect('admin/country');
		}
	}
	public function city(){
		$dataArr = $this->getAlltableData('airpor_tlist','','',array());
		$data['defaultData'] = $dataArr;
		$this->load->view('city',$data);
	}

	public function exclusive(){
		$dataArr = $this->getAlltableData('Exclusive','','',array());
		$data['defaultData'] = $dataArr;
		$this->load->view('exclusive',$data);
	}

	/* ECO END */


/* -----------------------------------------------------Quotation Builder Start -----------------------*/


 function list(){
 	$this->checkuserloginonpage();
	$dataArr = $this->getAlltableData('tourdetails','','',array());
	$data['defaultData'] = $dataArr;
	$data['boldmenu'] = 'chef';
	$this->load->view('qlist',$data);
 }

/* ----------------------------------------------------Quotation Builder End -------------------------*/

	/* TOUR START */

	public function tours(){
		$data['results'] = $this->galileo_model->getAllTourFromTable();
		//print_r($data); die;
		$this->load->view('tour',$data);
	}
	public function addTour(){
		$dataArrContinent = $this->getAlltableData('continents','','',array());
		$data['continent'] = $dataArrContinent;
		$dataArr = $this->getAlltableData('Exclusive','','',array());
		$data['defaultData'] = $dataArr;
		$dataArrInclusions = $this->getAlltableData('inclusions','','',array());
		$data['defaultDataIncl'] = $dataArrInclusions;
		$dataArrExclusions = $this->getAlltableData('exclusions','','',array());
		$data['defaultDataExcl'] = $dataArrExclusions;
		$dataArrGuide = $this->getAlltableData('tourguidedetails','','',array());
		$data['defaultDataGuide'] = $dataArrGuide;
		$this->load->view('add-tour',$data);
	}
	public function addTourAction(){
		$this->form_validation->set_rules('tourname', 'Tour name', 'required');
		$this->form_validation->set_rules('continentName', 'Continent name', 'required');
		$this->form_validation->set_rules('countryName', 'Country name', 'required');
		$this->form_validation->set_rules('cityName', 'City name', 'required');
		$this->form_validation->set_rules('tourDescription', 'Tour description', 'required');
		$this->form_validation->set_rules('maxadult', 'Number of adult', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('add-tour');
		}
		else
		{
			$cityName = implode('@', $this->input->post('cityName'));
			$inclusionNames = implode('@', $this->input->post('inclusionNames'));
			$exclusionNames = implode('@', $this->input->post('exclusionNames'));
			$tDaysNight = $this->input->post('tourDays').'D/'.$this->input->post('tourDays').'N';
			$depositDetails = $this->input->post('depositSelect').'@'.$this->input->post('depositAmount');
			$taxDetails = $this->input->post('taxSelect').'@'.$this->input->post('taxAmount');
			$paymentOptions = implode('@', $this->input->post('paymentOption'));
			$data = array('tourName'=>$this->input->post('tourname'),
						'tourContinent'=>$this->input->post('continentName'),
						'tourCountry'=>$this->input->post('countryName'),
						'tourCity'=>$cityName,
						'tourDescription'=>$this->input->post('tourDescription'),
						'tourGuideId'=>$this->input->post('tourOprName'),
						'tourHours'=>$this->input->post('tourHours'),
						'tourDaysNight'=>$tDaysNight,
						'tourType'=>$this->input->post('tourType'),
						'tourStartsFrom'=>$this->input->post('fromDate'),
						'tourExpireDate'=>$this->input->post('toDate'),
						'deposite'=>$depositDetails,
						'tax'=>$taxDetails,
						'relatedTours'=>$this->input->post('tourType'),
						 'tourCreatedDate'=>date("Y-m-d h:i:s")
						  );
			$resultID = $this->insertInTable('tourdetails',$data);
			if($resultID){
				$dataPrice = array('TId'=>$resultID,
						'numberAdult'=>$this->input->post('maxadult'),
						'numberChild'=>$this->input->post('maxchild'),
						'numberInfant'=>$this->input->post('maxinfant'),
						'APrice'=>$this->input->post('adultprice'),
						'CPrice'=>$this->input->post('childprice'),
						'IPrice'=>$this->input->post('infantprice')
						  );
			$resultID = $this->insertInTable('tourprice',$dataPrice);
			$dataExtra = array('TId'=>$resultID,
				'tourInclusions'=>$inclusionNames,
				'tourExclusions'=>$exclusionNames,
				'metaTitle'=>$this->input->post('metaTitle'),
				'metaKeywords'=>$this->input->post('metaKeywords'),
				'metaDescription'=>$this->input->post('metaDescription'),
				'paymentOptions'=>$paymentOptions,
				'termsAndConditions'=>$this->input->post('policyAndTerm')
				);
			$resultID = $this->insertInTable('tourextras',$dataExtra);
			}
			redirect('admin/tours');
		}
	}
	public function viewTourDetails(){
		$tourId = $this->uri->segment(3);
		$data['results'] = $this->galileo_model->getDataFromTableById('tourdetails',array('tourId'=>$tourId));
		$data['resultsp'] = $this->galileo_model->getDataFromTableById('tourprice',array('TId'=>$tourId));
		$data['resultsi'] = $this->galileo_model->getDataFromTableById('tourimages',array('TId'=>$tourId));
		$data['resultsex'] = $this->galileo_model->getDataFromTableById('tourextras',array('TId'=>$tourId));
		$this->load->view('tour-details',$data);
	}
	public function editTour(){
		$tourId = $this->uri->segment(3);
		if(!$tourId){
			redirect('admin/tours');
		}else{
			$dataArrContinent = $this->getAlltableData('continents','','',array());
			$data['continent'] = $dataArrContinent;
			$dataArr = $this->getAlltableData('Exclusive','','',array());
			$data['defaultData'] = $dataArr;
			$dataArrInclusions = $this->getAlltableData('inclusions','','',array());
			$data['defaultDataIncl'] = $dataArrInclusions;
			$dataArrExclusions = $this->getAlltableData('exclusions','','',array());
			$data['defaultDataExcl'] = $dataArrExclusions;
			$dataArrGuide = $this->getAlltableData('tourguidedetails','','',array());
			$data['defaultDataGuide'] = $dataArrGuide;
			$data['results'] = $this->galileo_model->getTourFromTableById($tourId);
			$this->load->view('edit-tour',$data);
		}
	}
	public function ajaxRequest()
	   {
	   		$opt = $_POST; 
			$res = $this->galileo_model->getCountryByName($opt);
			//print_r($res);
			$option='';
			foreach($res as $k=>$v){
				$option.='<option value="'.$v['Name'].'">'.$v['Name'].'</option>';
			}
			echo $option;
	   } 
	   public function ajaxRequestCity()
	   {
	   		$opt = $_POST; 
			$res = $this->galileo_model->getCityByName($opt);
			//print_r($res);
			$option='';
			foreach($res as $k=>$v){
				$option.='<option value="'.$v['city'].'">'.$v['city'].'</option>';
			}
			echo $option;
	   }
	   /* INCLUSION START */
	   public function inclusions(){
			$dataArr = $this->getAlltableData('inclusions','','',array());
			$data['defaultData'] = $dataArr;
			$this->load->view('inclusions',$data);
		}

		public function addInclusion(){
		$this->load->view('add-inclusions');
	}

	public function addInclusionAction(){
		$this->form_validation->set_rules('agencyName', 'Inclusion Name', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('add-inclusions');
		}
		else
		{
			$data = array('inclusionName'=>$this->input->post('agencyName'),
						  'inclusionDate'=>date("Y-m-d h:i:s")
						  );
			$this->insertInTable('inclusions',$data);
			redirect('admin/inclusions');
		}
	}

	public function InclusionList(){

		$dataArr = $this->getAlltableData('agency-name','inclusionList','inclusion-list',array());
	}

	public function editInclusion(){
		$agencyId = $this->uri->segment(3);
		$opt = array('inclusionId' => $agencyId);
		$this->getDataFromTableById('inclusions','inclusion','edit-inclusions',$opt);
	}

	public function editInclusionAction(){
		$agencyid = $this->input->post('agencyId');
		$this->form_validation->set_rules('agencyName', 'Inclusion Name', 'required');
		if ($this->form_validation->run() == FALSE)
		{ 
			redirect('admin/inclusions');
		}
		else
		{ 
			$data = array('inclusionName'=>$this->input->post('agencyName'));
			$this->changeStatusTable('inclusions',$data,array('inclusionId'=>$agencyid));
			redirect('admin/inclusions');
		}
		
	}

	public function changeInclusionStatus(){
		$agencyId = $this->uri->segment(3);
		$statusId = ($this->uri->segment(4)==1)?0:1; 
		$dataArr = $this->changeStatusTable('inclusions',array('inclusionStatus'=>$statusId),array('inclusionId'=>$agencyId));
		redirect('admin/inclusions');
	}


	public function deleteInclusion(){
		$agencyId = $this->uri->segment(3); 
		$dataArr = $this->deleteResultFromTable('inclusions',array('inclusionId'=>$agencyId));
		redirect('admin/inclusions');
	}
	/* INCLUSIONS END */

	public function addGallery(){
		$agencyId = $this->uri->segment(3); 
		$data['tourId'] = $agencyId;
		$dataArr = $this->getAlltableData('tourimages','','',array('TId'=>$agencyId));
		$data['defaultData'] = $dataArr;
		$this->load->view('gallery',$data);
	}
	public function deleteImage(){
		$agencyId = $this->uri->segment(3); 
		$agencyTId = $this->uri->segment(4); 
		$dataArr = $this->deleteResultFromTable('tourimages',array('tourImageId'=>$agencyId));
		redirect('admin/addGallery/'+$agencyTId);
	}
	public function makeThumbnail(){
		$tid = $this->uri->segment(3);
		$imgid = $this->uri->segment(4);
		$result = $this->galileo_model->makeThumbnail($tid,$imgid);
		if($result){
			redirect('admin/addGallery/'.$tid);
		}
	}
	public function changeImageStatus(){
		$agencyId = $this->uri->segment(3);
		$statusId = ($this->uri->segment(4)==1)?0:1; 
		$dataArr = $this->changeStatusTable('tourimages',array('imageStatus'=>$statusId),array('tourImageId'=>$agencyId));
		redirect('admin/addGallery');
	}
	public function addGalleryAction(){ //print_r($_FILES); die;
		$agencyId = $this->uri->segment(3); 
		if(!empty($_FILES['file']['name'])){
			$k = rand(1000,999);
			$lastIdFromTable = $this->getLAstIDFromTable('tourimages');
				$fileExtention = end(explode('.', $_FILES['file']['name']));
				$filename = date('dmyhms').time().$lastIdFromTable.'.'.$fileExtention;
				$fileGetMove = move_uploaded_file($_FILES['file']['tmp_name'], '../wp-backend/uploads/tourgallery/'.$filename);

				if($fileGetMove){
									
						$data = array('TId'=>$agencyId,
									'imageName'=>$filename
									  ); 
						$this->insertInTable('tourimages',$data);
						redirect('admin/addGallery');
					
				}else{
					$data['error'] = $_FILES['file']['error'];
					$this->load->view('gallery',$data);
				}
			}
	}

	/*  BANNERS */

		public function banners(){
		$this->checkuserloginonpage();
		$dataArr = $this->getAlltableData('banners','','',array());
		$data['defaultData'] = $dataArr;
		$data['boldmenu'] = 'banners';
		$this->load->view('banner',$data);
	}
	public function deleteBanner(){
		$this->checkuserloginonpage();
		$agencyId = $this->uri->segment(3); 
		$dataArr = $this->deleteResultFromTable('banners',array('bannerId'=>$agencyId));
		redirect('admin/banners/'.$agencyId);
	}
	public function makeFirstBanners(){
		$this->checkuserloginonpage();
		$tid = $this->uri->segment(3);
		$result = $this->galileo_model->makeFirstBanners($tid);
		if($result){
			redirect('admin/banners');
		}
	}
	public function changeBannerStatus(){
		$this->checkuserloginonpage();
		$agencyId = $this->uri->segment(3);
		$statusId = ($this->uri->segment(4)==1)?0:1; 
		$dataArr = $this->changeStatusTable('banners',array('bannerStatus'=>$statusId),array('bannerId'=>$agencyId));
		redirect('admin/banners');
	}
	public function addBannersAction(){ //print_r($_FILES); die;
		$this->checkuserloginonpage();
		if(!empty($_FILES['file']['name'])){
			$lastIdFromTable = $this->getLAstIDFromTable('banners');
			$k = rand(1000,999);
				$fileExtention = end(explode('.', $_FILES['file']['name']));
				$filename = date('dmyhms').time().$lastIdFromTable.'.'.$fileExtention;
				$fileGetMove = move_uploaded_file($_FILES['file']['tmp_name'], '../wp-backend/uploads/sliders/'.$filename);

				if($fileGetMove){
									
						$data = array(
									'bannerName'=>$filename
									  ); 
						$this->insertInTable('banners',$data);
						redirect('admin/banners');
					
				}else{
					$data['error'] = $_FILES['file']['error'];
					$this->load->view('banner',$data);
				}
			}
	}

	/* BANNERS */
	/* EXCLUSIONS */

		public function exclusions(){
			$dataArr = $this->getAlltableData('exclusions','','',array());
			$data['defaultData'] = $dataArr;
			$this->load->view('exclusions',$data);
		}

		public function addExclusion(){
		$this->load->view('add-exclusions');
	}

	public function addExclusionAction(){
		$this->form_validation->set_rules('agencyName', 'Exclusion Name', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('add-exclusions');
		}
		else
		{
			$data = array('exclusionName'=>$this->input->post('agencyName'),
						  'exclusionDate'=>date("Y-m-d h:i:s")
						  );
			$this->insertInTable('exclusions',$data);
			redirect('admin/exclusions');
		}
	}

	public function ExclusionList(){

		$dataArr = $this->getAlltableData('agency-name','inclusionList','inclusion-list',array());
	}

	public function editExclusion(){
		$agencyId = $this->uri->segment(3);
		$opt = array('exclusionId' => $agencyId);
		$this->getDataFromTableById('exclusions','exclusion','edit-exclusions',$opt);
	}

	public function editExclusionAction(){
		$agencyid = $this->input->post('agencyId');
		$this->form_validation->set_rules('agencyName', 'Exclusion Name', 'required');
		if ($this->form_validation->run() == FALSE)
		{ 
			redirect('admin/exclusions');
		}
		else
		{ 
			$data = array('exclusionName'=>$this->input->post('agencyName'));
			$this->changeStatusTable('exclusions',$data,array('exclusionId'=>$agencyid));
			redirect('admin/exclusions');
		}
		
	}

	public function changeExclusionStatus(){
		$agencyId = $this->uri->segment(3);
		$statusId = ($this->uri->segment(4)==1)?0:1; 
		$dataArr = $this->changeStatusTable('exclusions',array('exclusionStatus'=>$statusId),array('exclusionId'=>$agencyId));
		redirect('admin/exclusions');
	}


	public function deleteExclusion(){
		$agencyId = $this->uri->segment(3); 
		$dataArr = $this->deleteResultFromTable('exclusions',array('exclusionId'=>$agencyId));
		redirect('admin/exclusions');
	}

	/* EXCLUSIONS */
	/* USERS */

	public function users(){
			$dataArr = $this->getAlltableData('users','','',array());
			$data['defaultData'] = $dataArr;
			$this->load->view('users',$data);
		}

		public function addUser(){
		$this->load->view('add-user');
	}

	public function addUserAction(){
		$this->form_validation->set_rules('FirstName', 'First name', 'required');
		$this->form_validation->set_rules('LastName', 'Last name', 'required');
		$this->form_validation->set_rules('Username', 'Username', 'required|is_unique[users.userName]');
		$this->form_validation->set_rules('useremail', 'Email', 'trim|required|valid_email|is_unique[users.userEmail]');
		$this->form_validation->set_rules('userPass', 'Password', 'trim|required|min_length[8]',
        array('rule3' => 'Password must be of 8 charecters'));
		$this->form_validation->set_rules('userContact', 'Contact', 'required');
		$this->form_validation->set_rules('userRole', 'User Role', 'required'); 
		$this->form_validation->set_rules('userGender', 'User Gender', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('add-user');
		}
		else
		{
			$filename = 'noimage.png';
			if(!empty($_FILES['file']['name'])){
			$k = rand(1000,999);
				$fileExtention = end(explode('.', $_FILES['file']['name']));
				$filename = date('dmyhms').time().'.'.$fileExtention;
				$fileGetMove = move_uploaded_file($_FILES['file']['tmp_name'], '../wp-backend/uploads/users/'.$filename);

				if($fileGetMove){
					$filename = $filename;
				}else{
					$filename = 'noimage.png';
				}
			}
			$data = array('firstName'=>$this->input->post('FirstName'),
						'lastName'=>$this->input->post('LastName'),
						'userName'=>$this->input->post('Username'),
						'userEmail'=>$this->input->post('useremail'),
						'userPass'=>md5($this->input->post('userPass')),
						'userGender'=>$this->input->post('userGender'),
						'userRole'=>$this->input->post('userRole'),
						'userContact'=>$this->input->post('userContact'),
						'picture'=>$filename,
						  'userAddedDate'=>date("Y-m-d h:i:s")
						  );
			$this->insertInTable('users',$data);
			redirect('admin/users');
		}
	}

	public function UsersList(){

		$dataArr = $this->getAlltableData('agency-name','inclusionList','inclusion-list',array());
	}

	public function editUser(){
		$agencyId = $this->uri->segment(3);
		$opt = array('userId' => $agencyId);
		$this->getDataFromTableById('users','users','edit-user',$opt);
	}

	public function editUserAction(){
		$agencyid = $this->input->post('agencyId');
		$this->form_validation->set_rules('FirstName', 'First name', 'required');
		$this->form_validation->set_rules('LastName', 'Last name', 'required');
		$this->form_validation->set_rules('useremail', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('userContact', 'Contact', 'required');
		$this->form_validation->set_rules('userRole', 'User Role', 'required'); 
		$this->form_validation->set_rules('userGender', 'User Gender', 'required');
		if ($this->form_validation->run() == FALSE)
		{ 
			redirect('admin/users');
		}
		else
		{ 
			$filename = 'noimage.png';
			if(!empty($_FILES['file']['name'])){
			$k = rand(1000,999);
				$fileExtention = end(explode('.', $_FILES['file']['name']));
				$filename = date('dmyhms').time().'.'.$fileExtention;
				$fileGetMove = move_uploaded_file($_FILES['file']['tmp_name'], '../wp-backend/uploads/users/'.$filename);

				if($fileGetMove){
					$filename = $filename;
				}else{
					$filename = 'noimage.png';
				}
				$data = array('firstName'=>$this->input->post('FirstName'),
						'lastName'=>$this->input->post('LastName'),
						'userEmail'=>$this->input->post('useremail'),
						'userGender'=>$this->input->post('userGender'),
						'userRole'=>$this->input->post('userRole'),
						'userContact'=>$this->input->post('userContact'),
						'picture'=>$filename,
						'userAddedDate'=>date("Y-m-d h:i:s")
						);
			}else{
				$data = array('firstName'=>$this->input->post('FirstName'),
						'lastName'=>$this->input->post('LastName'),
						'userEmail'=>$this->input->post('useremail'),
						'userGender'=>$this->input->post('userGender'),
						'userRole'=>$this->input->post('userRole'),
						'userContact'=>$this->input->post('userContact'),
						'userAddedDate'=>date("Y-m-d h:i:s")
						);
			}

			$this->changeStatusTable('users',$data,array('userId'=>$agencyid));
			redirect('admin/users');
		}
		
	}

	public function changeUsersStatus(){
		$agencyId = $this->uri->segment(3);
		$statusId = ($this->uri->segment(4)==1)?0:1; 
		$dataArr = $this->changeStatusTable('users',array('userStatus'=>$statusId),array('userId'=>$agencyId));
		redirect('admin/users');
	}


	public function deleteUsers(){
		$agencyId = $this->uri->segment(3); 
		$dataArr = $this->deleteResultFromTable('users',array('userId'=>$agencyId));
		redirect('admin/users');
	}

	/* USERS END */

	/* TOUR EXTRA */
		public function tour_extras(){
			$dataArr = $this->getAlltableData('extras','','',array());
			$data['defaultData'] = $dataArr;
			$this->load->view('extras',$data);
		}
		public function addExtras(){
			$data['error'] = "";
			$this->load->view('add-extra',$data);
		}
		public function addExtraAction(){ 
			$this->form_validation->set_rules('status', 'Status', 'required');
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('price', 'Price', 'trim|required'); 
			if ($this->form_validation->run() == FALSE)
				{ 
					$data['error'] = '';
					$this->load->view('add-extra',$data);
				}else{ 
					if(!empty($_FILES['file']['name'])){
						$fileExtention = end(explode('.', $_FILES['file']['name']));
						$filename = date('dmyhmsu').'.'.$fileExtention;
						$fileGetMove = move_uploaded_file($_FILES['file']['tmp_name'], '../wp-backend/uploads/'.$filename);

						if($fileGetMove){
											
								$data = array('fileName'=>$filename,
											'extraStatus'=>$this->input->post('status'),
											'extraName'=>$this->input->post('name'),
											'extraPrice'=>$this->input->post('price'),
											  'userAddedDate'=>date("Y-m-d h:i:s")
											  ); print_r($data);
								$this->insertInTable('extras',$data);
								redirect('admin/tour_extras');
							
						}else{
							$data['error'] = $_FILES['file']['error'];
							$this->load->view('add-extra',$data);
						}
					}
				}
		}
		public function changeExtraStatus(){
			$agencyId = $this->uri->segment(3);
			$statusId = ($this->uri->segment(4)==1)?0:1; 
			$dataArr = $this->changeStatusTable('extras',array('extraStatus'=>$statusId),array('extraId'=>$agencyId));
			redirect('admin/tour_extras');
		}
		public function deleteExtras(){
			$agencyId = $this->uri->segment(3); 
			$dataArr = $this->deleteResultFromTable('extras',array('extraId'=>$agencyId));
			redirect('admin/tour_extras');
		}
		public function editExtra(){
			$agencyId = $this->uri->segment(3);
			$opt = array('extraId' => $agencyId);
			$this->getDataFromTableById('extras','tour_extras','edit-extra',$opt);
		}
		public function editExtraAction(){
		$agencyid = $this->input->post('agencyId');
		$this->form_validation->set_rules('status', 'Status', 'required');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('price', 'Price', 'trim|required'); 
		if ($this->form_validation->run() == FALSE)
		{ 
			$data['error'] = '';
			$this->load->view('edit-extra',$data);
		}
		else
		{ 
			if(!empty($_FILES['file']['name'])){
				$fileExtention = end(explode('.', $_FILES['file']['name']));
				$filename = date('dmyhmsu').'.'.$fileExtention;
				$fileGetMove = move_uploaded_file($_FILES['file']['tmp_name'], '../wp-backend/uploads/'.$filename);

				if($fileGetMove){
									
						$data = array('fileName'=>$filename,
									'extraStatus'=>$this->input->post('status'),
									'extraName'=>$this->input->post('name'),
									'extraPrice'=>$this->input->post('price'),
									  'userAddedDate'=>date("Y-m-d h:i:s")
									  ); 
						$this->changeStatusTable('extras',$data,array('extraId'=>$agencyid));
						redirect('admin/tour_extras');
					
				}else{
					$data['error'] = $_FILES['file']['error'];
					$this->load->view('add-extra',$data);
				}
			}else{
				$data = array(	'extraStatus'=>$this->input->post('status'),
								'extraName'=>$this->input->post('name'),
								'extraPrice'=>$this->input->post('price'),
								'userAddedDate'=>date("Y-m-d h:i:s")
							); 
						$this->changeStatusTable('extras',$data,array('extraId'=>$agencyid));
						redirect('admin/tour_extras');
			}
			
		}
		
	}
	/* TOUR EXTRA END addMenusCategoryAction*/

/* ----------------------------------------------------- MADO START --------------------------------- */
		public function menuCategory(){
			$this->checkuserloginonpage();
			$dataArr = $this->getAlltableData('menuCategory','','',array());
			$data['error'] = "";
			$data['defaultData'] = $dataArr;
			$data['boldmenu'] = 'menuCategory';
			$this->load->view('menu-category',$data);
		}
		public function addMenuCategory(){
			$this->checkuserloginonpage();
			$data['error'] = "";
			$data['boldmenu'] = 'menuCategory';
			$this->load->view('add-menu-category',$data);
		}
		public function addMenuCategoryAction(){
			$this->checkuserloginonpage();
			$this->form_validation->set_rules('name', 'Menu Category Name', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('add-menu-category');
			}
			else
			{
				$data = array('catName'=>$this->input->post('name')
							  );
				$this->insertInTable('menuCategory',$data);
				redirect('admin/menuCategory');
			}
		}
		public function editMenuCategory(){
			$this->checkuserloginonpage();
			$agencyId = $this->uri->segment(3);
			$opt = array('catId' => $agencyId);
			$this->getDataFromTableById('menuCategory','menuCategory','edit-menu-category',$opt);
		}
		public function editMenuCategoryAction(){
			$this->checkuserloginonpage();
			$agencyid = $this->input->post('agencyId');
			$this->form_validation->set_rules('name', 'Category Name', 'required');
			if ($this->form_validation->run() == FALSE)
			{ 
				redirect('admin/menuCategory');
			}
			else
			{ 
				$data = array('catName'=>$this->input->post('name'));
				$this->changeStatusTable('menuCategory',$data,array('catId'=>$agencyid));
				redirect('admin/menuCategory');
			}
		}
		public function changeMenuCategoryStatus(){
			$this->checkuserloginonpage();
			$agencyId = $this->uri->segment(3);
			$statusId = ($this->uri->segment(4)==1)?0:1; 
			$dataArr = $this->changeStatusTable('menuCategory',array('status'=>$statusId),array('catId'=>$agencyId));
			redirect('admin/menuCategory');
		}
		public function deleteMenuCategory(){
			$this->checkuserloginonpage();
			$agencyId = $this->uri->segment(3); 
			$dataArr = $this->deleteResultFromTable('menuCategory',array('catId'=>$agencyId));
			redirect('admin/menuCategory');
		}
	/* MADO MENU START */
		public function menus(){
			$this->checkuserloginonpage();
			$dataArr = $this->getAlltableData('menus','','',array());
			$data['defaultData'] = $dataArr;
			$data['dataCatName'] = $this->getAlltableData('menuCategory','','',array('status'=>1));
			$data['boldmenu'] = 'menus';
			$this->load->view('menus',$data);
		}
		public function addMenus(){
			$this->checkuserloginonpage();
			$dataArr = $this->getAlltableData('menuCategory','','',array());
			$data['categoryList'] = $dataArr;
			$data['error'] = "";
			$data['boldmenu'] = 'menus';
			$this->load->view('add-menus',$data);
		}
		public function addMenusAction(){ 
			$this->checkuserloginonpage();
			$this->form_validation->set_rules('category', 'Category', 'required');
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('nameAr', 'Name in Arabic', 'required');
			$this->form_validation->set_rules('portion', 'Portion', 'required');
			if ($this->form_validation->run() == FALSE)
				{ 
					$data['error'] = '';
					$this->load->view('add-menus',$data);
				}else{ 
					if(!empty($_FILES['file']['name'])){
						$fileExtention = end(explode('.', $_FILES['file']['name']));
						//$rand = rand('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890');
						$filename = date('dmyhmsu').'.'.$fileExtention;
						$fileGetMove = move_uploaded_file($_FILES['file']['tmp_name'], '../wp-backend/uploads/menus/'.$filename);

						if($fileGetMove){
											
								$data = array('image'=>$filename,
											'name'=>$this->input->post('name'),
											'nameAr'=>$this->input->post('nameAr'),
											'portion'=>$this->input->post('portion'),
											'price'=>$this->input->post('price'),
											'categoryId'=>$this->input->post('category'),
											'description'=>$this->input->post('Description'),
											'descriptionAr'=>$this->input->post('descriptionAr'),
											 'addedDate'=>date("Y-m-d h:i:s")
											  );
								$this->insertInTable('menus',$data);
								redirect('admin/menus');
							
						}else{
							$data['error'] = $_FILES['file']['error'];
							$this->load->view('add-menus',$data);
						}
					}
				}
		}
		public function changeMenusStatus(){
			$this->checkuserloginonpage();
			$agencyId = $this->uri->segment(3);
			$statusId = ($this->uri->segment(4)==1)?0:1; 
			$dataArr = $this->changeStatusTable('menus',array('status'=>$statusId),array('menuid'=>$agencyId));
			redirect('admin/menus');
		}
		public function deleteMenus(){
			$this->checkuserloginonpage();
			$agencyId = $this->uri->segment(3); 
			$dataArr = $this->deleteResultFromTable('menus',array('menuid'=>$agencyId));
			redirect('admin/menus');
		}
		public function editMenus(){
			$this->checkuserloginonpage();
			$dataArr = $this->getAlltableData('menuCategory','','',array('status'=>1));
			$agencyId = $this->uri->segment(3);
			$opt = array('menuid' => $agencyId);
			$data['boldmenu'] = 'menus';
			$this->getDataFromTableById('menus','menus','edit-menus',$opt,$dataArr);
		}
		public function editMenusAction(){
			$this->checkuserloginonpage();
		$agencyid = $this->input->post('agencyId');
		$this->form_validation->set_rules('category', 'Category', 'required');
			$this->form_validation->set_rules('name', 'Name', 'required');
		if ($this->form_validation->run() == FALSE)
		{ 
			$data['error'] = '';
			$this->load->view('edit-menus',$data);
		}
		else
		{ 
			if(!empty($_FILES['file']['name'])){
				$fileExtention = end(explode('.', $_FILES['file']['name']));
				$filename = date('dmyhmsu').'.'.$fileExtention;
				$fileGetMove = move_uploaded_file($_FILES['file']['tmp_name'], '../wp-backend/uploads/menus/'.$filename);

				if($fileGetMove){
									
						$data = array('image'=>$filename,
										'name'=>$this->input->post('name'),
										'nameAr'=>$this->input->post('nameAr'),
										'portion'=>$this->input->post('portion'),
										'price'=>$this->input->post('price'),
										'categoryId'=>$this->input->post('category'),
										'description'=>$this->input->post('Description'),
										'descriptionAr'=>$this->input->post('DescriptionAr'),
										  'addedDate'=>date("Y-m-d h:i:s")
									  ); 
						$this->changeStatusTable('menus',$data,array('menuid'=>$agencyid));
						redirect('admin/menus');
					
				}else{
					$data['error'] = $_FILES['file']['error'];
					$this->load->view('edit-menus',$data);
				}
			}else{
				$data = array(	'name'=>$this->input->post('name'),
								'nameAr'=>$this->input->post('nameAr'),
								'portion'=>$this->input->post('portion'),
								'price'=>$this->input->post('price'),
								'categoryId'=>$this->input->post('category'),
								'description'=>$this->input->post('Description'),
								'descriptionAr'=>$this->input->post('DescriptionAr'),
								 'addedDate'=>date("Y-m-d h:i:s")
							); 
						$this->changeStatusTable('menus',$data,array('menuid'=>$agencyid));
						redirect('admin/menus');
			}
			
		}
		
	}

	function addMenusAsDisplayOnHome(){
		$this->checkuserloginonpage();
		$this->galileo_model->updateHomeMunu();
		$data = array('showOnhome'=>1);
		foreach($_POST as $k=>$v){
			$agencyid = $v;
			$this->changeStatusTable('menus',$data,array('menuid'=>$agencyid));
		}
	} 

	function addMenusAsSpecial(){
		$this->checkuserloginonpage();
		$this->galileo_model->updateHomeSpecialMunu();
		$data = array('specialMenu'=>1);
		foreach($_POST as $k=>$v){
			$agencyid = $v;
			$this->changeStatusTable('menus',$data,array('menuid'=>$agencyid));
		}
	}

	/* MADO MENU END */

	/* MADO ABOUT US */
		public function about(){
			$this->checkuserloginonpage();
			$dataArr = $this->getAlltableData('aboutMado','','',array());
			$data['defaultData'] = $dataArr;
			$data['boldmenu'] = 'about';
			$this->load->view('about',$data);
		}
		public function addAbout(){
			$this->checkuserloginonpage();
			$dataArr = $this->getAlltableData('aboutMado','','',array());
			$data['error'] = "";
			$data['boldmenu'] = 'about';
			$this->load->view('add-about',$data);
		}
		public function addAboutAction(){ 
			$this->checkuserloginonpage();
					if(!empty($_FILES['file']['name'])){
						$fileExtention = end(explode('.', $_FILES['file']['name']));
						//$rand = rand('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890');
						$filename = date('dmyhmsu').'.'.$fileExtention;
						$fileGetMove = move_uploaded_file($_FILES['file']['tmp_name'], '../wp-backend/uploads/crm/'.$filename);
						if($fileGetMove){
								$data = array('imageName'=>$filename,
											'description'=>$this->input->post('Description'),
											'descriptionAr'=>$this->input->post('DescriptionAr')
											  );
								$this->insertInTable('aboutMado',$data);
								redirect('admin/about');
						}else{
							$data['error'] = $_FILES['file']['error'];
							$this->load->view('add-about',$data);
						}
					}
		}
		public function changeAboutStatus(){
			$this->checkuserloginonpage();
			$agencyId = $this->uri->segment(3);
			$statusId = ($this->uri->segment(4)==1)?0:1; 
			$dataArr = $this->changeStatusTable('aboutMado',array('status'=>$statusId),array('aboutId'=>$agencyId));
			redirect('admin/about');
		}
		public function deleteAbout(){
			$this->checkuserloginonpage();
			$agencyId = $this->uri->segment(3); 
			$dataArr = $this->deleteResultFromTable('aboutMado',array('aboutId'=>$agencyId));
			redirect('admin/about');
		}
		public function editAbout(){
			$this->checkuserloginonpage();
			$dataArr = $this->getAlltableData('aboutMado','','',array());
			$agencyId = $this->uri->segment(3);
			$opt = array('aboutId' => $agencyId);
			$data['boldmenu'] = 'about';
			$this->getDataFromTableById('aboutMado','aboutMado','edit-about',$opt,$dataArr);
		}
		public function editAboutAction(){
			$this->checkuserloginonpage();
		$agencyid = $this->input->post('agencyId');
		$this->form_validation->set_rules('Description', 'Description', 'required');
		if ($this->form_validation->run() == FALSE)
		{ 
			$data['error'] = '';
			$this->load->view('edit-about',$data);
		}
		else
		{ 
			if(!empty($_FILES['file']['name'])){
				$fileExtention = end(explode('.', $_FILES['file']['name']));
				$filename = date('dmyhmsu').'.'.$fileExtention;
				$fileGetMove = move_uploaded_file($_FILES['file']['tmp_name'], '../wp-backend/uploads/crm/'.$filename);

				if($fileGetMove){
									
						$data = array('image'=>$filename,
										'description'=>$this->input->post('Description'),
										'descriptionAr'=>$this->input->post('DescriptionAr')
									  ); 
						$this->changeStatusTable('aboutMado',$data,array('aboutId'=>$agencyid));
						redirect('admin/about');
					
				}else{
					$data['error'] = $_FILES['file']['error'];
					$this->load->view('edit-about',$data);
				}
			}else{
				$data = array(	'description'=>$this->input->post('Description'),
								'descriptionAr'=>$this->input->post('DescriptionAr')
							); 
						$this->changeStatusTable('aboutMado',$data,array('aboutId'=>$agencyid));
						redirect('admin/about');
			}
			
		}
		
	}
	/* MADO ABOUT US END */

	/* MADO CHEF START */
		public function chef(){ 
			$this->checkuserloginonpage();
			$dataArr = $this->getAlltableData('chef','','',array());
			$data['defaultData'] = $dataArr;
			$data['boldmenu'] = 'chef';
			$this->load->view('chef',$data);
		}
		public function addChef(){
			$this->checkuserloginonpage();
			$dataArr = $this->getAlltableData('chef','','',array());
			$data['error'] = "";
			$data['boldmenu'] = 'chef';
			$this->load->view('add-chef',$data);
		}
		public function addChefAction(){ 
			$this->checkuserloginonpage();
				$this->form_validation->set_rules('chefName', 'Chef Name', 'required');
				$this->form_validation->set_rules('Description', 'Description', 'required');
				if ($this->form_validation->run() == FALSE)
				{ 
					$data['error'] = '';
					$this->load->view('add-chef',$data);
				}
				else
				{ 
					if(!empty($_FILES['file']['name'])){
						$fileExtention = end(explode('.', $_FILES['file']['name']));
						//$rand = rand('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890');
						$filename = date('dmyhmsu').'.'.$fileExtention;
						$fileGetMove = move_uploaded_file($_FILES['file']['tmp_name'], '../wp-backend/uploads/crm/'.$filename);
						if($fileGetMove){
								$data = array('imageName'=>$filename,
											'chefName'=>$this->input->post('chefName'),
											'description'=>$this->input->post('Description')
											  );
								$this->insertInTable('chef',$data);
								redirect('admin/chef');
						}else{
							$data['error'] = $_FILES['file']['error'];
							$this->load->view('add-chef',$data);
						}
					}
				}
		}
		public function changeChefStatus(){
			$this->checkuserloginonpage();
			$agencyId = $this->uri->segment(3);
			$statusId = ($this->uri->segment(4)==1)?0:1; 
			$dataArr = $this->changeStatusTable('chef',array('status'=>$statusId),array('chefId'=>$agencyId));
			redirect('admin/chef');
		}
		public function deleteChef(){
			$this->checkuserloginonpage();
			$agencyId = $this->uri->segment(3); 
			$dataArr = $this->deleteResultFromTable('chef',array('chefId'=>$agencyId));
			redirect('admin/chef');
		}
		public function editChef(){
			$this->checkuserloginonpage();
			$dataArr = $this->getAlltableData('chef','','',array());
			$agencyId = $this->uri->segment(3);
			$opt = array('chefId' => $agencyId);
			$data['boldmenu'] = 'chef';
			$this->getDataFromTableById('chef','chef','edit-chef',$opt,$dataArr);
		}
		public function editChefAction(){
			$this->checkuserloginonpage();
		$agencyid = $this->input->post('agencyId');
		$this->form_validation->set_rules('chefName', 'Chef Name', 'required');
		$this->form_validation->set_rules('Description', 'Description', 'required');
		if ($this->form_validation->run() == FALSE)
		{ 
			$data['error'] = '';
			$this->load->view('edit-chef',$data);
		}
		else
		{ 
			if(!empty($_FILES['file']['name'])){
				$fileExtention = end(explode('.', $_FILES['file']['name']));
				$filename = date('dmyhmsu').'.'.$fileExtention;
				$fileGetMove = move_uploaded_file($_FILES['file']['tmp_name'], '../wp-backend/uploads/crm/'.$filename);

				if($fileGetMove){
									
						$data = array('imageName'=>$filename,
										'chefName'=>$this->input->post('chefName'),
										'description'=>$this->input->post('Description')
									  ); 
						$this->changeStatusTable('chef',$data,array('chefId'=>$agencyid));
						redirect('admin/chef');
					
				}else{
					$data['error'] = $_FILES['file']['error'];
					$this->load->view('edit-chef',$data);
				}
			}else{
				$data = array(	'description'=>$this->input->post('Description'),
								'chefName'=>$this->input->post('chefName')
							); 
						$this->changeStatusTable('chef',$data,array('chefId'=>$agencyid));
						redirect('admin/chef');
			}
			
		}
		
	}
	/* MADO CHEF END */
/* ----------------------------------------------------- MADO END ------------------------------------ */
	



	public function addwriteuptxt(){
		$writeuptxt = $_POST['writeuptxts'];  //writeuptxt
		$writeuptxtIds = $_POST['bid'];
		$data = array('writeuptxt'=>$writeuptxt
						  );
		$res = $this->changeStatusTable('banners',$data,array('bannerId'=>$writeuptxtIds));
		if($res == true){
			echo 'done';
		}else{
			echo 'failed';
		}
	}
	/* TOUR GUIDE */
		
		public function tour_guide(){
			$dataArr = $this->getAlltableData('tourguidedetails','','',array());
			$data['defaultData'] = $dataArr;
			$this->load->view('tourguide',$data);
		} 

		public function addGuides(){
			$data['error'] = "";
			$this->load->view('add-guides',$data);
		} 

		public function addGuideAction(){ 
			$this->form_validation->set_rules('tourOprName', 'Tour operator name', 'required');
			$this->form_validation->set_rules('tourOprEmail', 'Tour operator email', 'required');
			$this->form_validation->set_rules('tourOprContact', 'Tour operator contact', 'required');
			$this->form_validation->set_rules('tourOprAddress', 'Tour operator address', 'required');
			if ($this->form_validation->run() == FALSE)
				{ 
					$data['error'] = '';
					$this->load->view('add-guides',$data);
				}else{ 
					if(!empty($_FILES['file']['name'])){
						$fileExtention = end(explode('.', $_FILES['file']['name']));
						$filename = date('dmyhmsu').'.'.$fileExtention;
						$fileGetMove = move_uploaded_file($_FILES['file']['tmp_name'], '../wp-backend/uploads/guides/'.$filename);

						if($fileGetMove){
											
								$data = array('tourGuideName'=>$this->input->post('tourOprName'),
											'tourGuideEmail'=>$this->input->post('tourOprEmail'),
											'tourGuidePhone'=>$this->input->post('tourOprContact'),
											'tourGuideAddress'=>$this->input->post('tourOprAddress'),
											'tourGuidePicture'=>$filename,
											  'tourGuideCreatedDate'=>date("Y-m-d h:i:s")
											  );
								$this->insertInTable('tourguidedetails',$data);
								redirect('admin/tour_guide');
							
						}else{
							$data['error'] = $_FILES['file']['error'];
							$this->load->view('add-guides',$data);
						}
					}else{
						$data = array('tourGuideName'=>$this->input->post('tourOprName'),
											'tourGuideEmail'=>$this->input->post('tourOprEmail'),
											'tourGuidePhone'=>$this->input->post('tourOprContact'),
											'tourGuideAddress'=>$this->input->post('tourOprAddress'),
											  'tourGuideCreatedDate'=>date("Y-m-d h:i:s")
											  );
								$this->insertInTable('tourguidedetails',$data);
								redirect('admin/tour_guide');
					}
				}
		}

		public function editGuide(){
			$agencyId = $this->uri->segment(3);
			$opt = array('tourGuideId' => $agencyId);
			$this->getDataFromTableById('tourguidedetails','tour_guide','edit-guides',$opt);
		}
		public function editGuideAction(){
		$agencyid = $this->input->post('agencyId');
		$this->form_validation->set_rules('tourOprName', 'Tour operator name', 'required');
		$this->form_validation->set_rules('tourOprEmail', 'Tour operator email', 'required');
		$this->form_validation->set_rules('tourOprContact', 'Tour operator contact', 'required');
		$this->form_validation->set_rules('tourOprAddress', 'Tour operator address', 'required'); 
		if ($this->form_validation->run() == FALSE)
		{ 
			$data['error'] = '';
			$this->load->view('edit-guides',$data);
		}
		else
		{ 
			if(!empty($_FILES['file']['name'])){
				$fileExtention = end(explode('.', $_FILES['file']['name']));
				$filename = date('dmyhmsu').'.'.$fileExtention;
				$fileGetMove = move_uploaded_file($_FILES['file']['tmp_name'], '../wp-backend/uploads/guides/'.$filename);

				if($fileGetMove){
									
						$data = array('tourGuideName'=>$this->input->post('tourOprName'),
											'tourGuideEmail'=>$this->input->post('tourOprEmail'),
											'tourGuidePhone'=>$this->input->post('tourOprContact'),
											'tourGuideAddress'=>$this->input->post('tourOprAddress'),
											'tourGuidePicture'=>$filename,
											  'tourGuideCreatedDate'=>date("Y-m-d h:i:s")
											  );
						$this->changeStatusTable('tourguidedetails',$data,array('tourGuideId'=>$agencyid));
						redirect('admin/tour_guide');
					
				}else{
					$data['error'] = $_FILES['file']['error'];
					$this->load->view('add-extra',$data);
				}
			}else{
				$data = array('tourGuideName'=>$this->input->post('tourOprName'),
											'tourGuideEmail'=>$this->input->post('tourOprEmail'),
											'tourGuidePhone'=>$this->input->post('tourOprContact'),
											'tourGuideAddress'=>$this->input->post('tourOprAddress'),
											  'tourGuideCreatedDate'=>date("Y-m-d h:i:s")
											  );
						$this->changeStatusTable('tourguidedetails',$data,array('tourGuideId'=>$agencyid));
						redirect('admin/tour_guide');
			}
			
		}
		
	}

	public function changeGuideStatus(){
			$agencyId = $this->uri->segment(3);
			$statusId = ($this->uri->segment(4)==1)?0:1; 
			$dataArr = $this->changeStatusTable('tourguidedetails',array('tourGuideStatus'=>$statusId),array('tourGuideId'=>$agencyId));
			redirect('admin/tour_guide');
		}

	/* TOUR GUIDE END */

	 public function do_upload()
        {
            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 100;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('thumbnail'))
            {
                    $error = array('error' => $this->upload->display_errors());

                    $this->load->view('add-extra', $error);
            }
            else
            {
                    $data = array('upload_data' => $this->upload->data());

                    $this->load->view('add-extra', $data);
            }
        }

	/* TOUR END */

	/* START PRODUCT EXCLUSIVE */

	public function addExclusive(){
		$this->load->view('add-exclusive');
	}

	public function addExclusiveAction(){
		$this->form_validation->set_rules('agencyName', 'Exclusive Name', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('add-exclusive');
		}
		else
		{
			$data = array('ExclusiveName'=>$this->input->post('agencyName'),
						  'ExDate'=>date("Y-m-d h:i:s")
						  );
			$this->insertInTable('Exclusive',$data);
			redirect('admin/exclusive');
		}
	}

	public function ExclusiveList(){

		$dataArr = $this->getAlltableData('agency-name','agencyList','agency-list',array());
	}

	public function editExclusive(){
		$agencyId = $this->uri->segment(3);
		$opt = array('ExclusiveID' => $agencyId);
		$this->getDataFromTableById('Exclusive','exclusive','edit-exclusive',$opt);
	}

	public function editExclusiveAction(){
		$agencyid = $this->input->post('agencyId');
		$this->form_validation->set_rules('agencyName', 'Agency Name', 'required');
		if ($this->form_validation->run() == FALSE)
		{ 
			redirect('admin/exclusive');
		}
		else
		{ 
			$data = array('ExclusiveName'=>$this->input->post('agencyName'));
			$this->changeStatusTable('Exclusive',$data,array('ExclusiveID'=>$agencyid));
			redirect('admin/exclusive');
		}
		
	}

	public function changeExclusiveStatus(){
		$agencyId = $this->uri->segment(3);
		$statusId = ($this->uri->segment(4)==1)?0:1; 
		$dataArr = $this->changeStatusTable('Exclusive',array('ExStatus'=>$statusId),array('ExclusiveID'=>$agencyId));
		redirect('admin/exclusive');
	}


	public function deleteExclusive(){
		$agencyId = $this->uri->segment(3); 
		$dataArr = $this->deleteResultFromTable('Exclusive',array('ExclusiveID'=>$agencyId));
		redirect('admin/exclusive');
	}

	/* AGENCY END  */
	/* END PRODUCT EXCLUSIVE */

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

