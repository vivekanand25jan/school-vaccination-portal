<?php
	class Galileo_model extends CI_Model{
		public function _construct(){
			parent::_construct();
		}

		/* GLOBAL FUNCTION */

		public function insertInTable($tableName,$option){
			$this->db->insert($tableName,$option);
			$query = $this->db->affected_rows();
			$lastInsertId = $this->db->insert_id();
			if($query > 0){
				return $lastInsertId;
			}else{
				return false;
			}
		}

		public function getLAstIDFromTable($tableName){
			$query = $this->db->get($tableName);
			if($query->num_rows()>0){
				$count = $query->result_array();
				$TheNumber = count($count);
				return $TheNumber;
			}else{
				return false;
			}
		}

		public function getAllAgencyList(){
			$query = $this->db->get('agency-name');
			if($query->num_rows()>0){
				return $query->result_array();
			}else{
				return false;
			}
		}

		public function getAlltableData($tableName,$option){ 
			$this->db->select('*');
			$this->db->from($tableName);
			if(count($option) > 0){
				$array = $option;
				$this->db->where($array); 
			}
			$query = $this->db->get();
			//echo $this->db->last_query(); die;
			if($query->num_rows() > 0){
				return $query->result_array();
			}else{
				return false;
			}
		}

		public function getDataFromTableById($tableName,$option){
			
			$this->db->select('*');
			$this->db->from($tableName);
			if(count($option) > 0){
				$array = $option;
				$this->db->where($array); 
			}
			$query = $this->db->get(); 
			if($query->num_rows() > 0){
				return $query->result_array();
			}else{
				return false;
			}
		}


		public function deleteResultFromTable($tableName,$option){
			if(count($option) > 0){
				$array = $option;
				$this->db->where($array);
				$this->db->delete($tableName);
			}

			$query = $this->db->affected_rows();
			if($query > 0){
				return true;
			}else{
				return false;
			}

		}


		public function changeStatusTable($tableName,$option,$where){ 
			if(count($where) > 0){
				$array = $where;
				$this->db->where($array);
			}
			$this->db->update($tableName, $option); 
			$query = $this->db->affected_rows();
			if($query > 0){
				return true;
			}else{
				return false;
			}

		}

		public function updateHomeMunu(){
			$this->db->update('menus', array('showOnhome'=>0)); 
			$query = $this->db->affected_rows();
		}

		public function updateHomeSpecialMunu(){
			$this->db->update('menus', array('specialMenu'=>0)); 
			$query = $this->db->affected_rows();
		}

		public function getCountryByName($arr){
			$this->db->select('*');
			$this->db->from($arr['tname']);
			if(count($arr) > 0){
				$array = $arr;
				$this->db->where('Continent',$array['cname']); 
				$this->db->or_where('Region',$array['cname']);
			}
			$query = $this->db->get(); 
			if($query->num_rows() > 0){
				return $query->result_array();
			}else{
				return false;
			}
		}

		public function testingData(){
			$this->db->select('*');
			$this->db->from('country');
			$query = $this->db->get(); 
			if($query->num_rows() > 0){
				return $query->result_array();
			}else{
				return false;
			}
		}

		public function getCityByName($arr){
			$this->db->select('*');
			$this->db->from($arr['tname']);
			if(count($arr) > 0){
				$array = $arr;
				$this->db->where('countryName',$array['cname']); 
				//$this->db->or_where('Region',$array['cname']);
			}
			$query = $this->db->get(); 
			if($query->num_rows() > 0){
				return $query->result_array();
			}else{
				return false;
			}
		}

		/* GLOBAL FUNCTION END */

		public function makeThumbnail($tid,$imgid){
			$array = array('TId'=>$tid);
			$this->db->where($array);
			$option = array('imageType'=>'banner');
			$this->db->update('tourimages', $option); 
			$query = $this->db->affected_rows();
				$arrays = array('tourImageId'=>$imgid);
				$this->db->where($arrays);
				$options = array('imageType'=>'Thumbnail');
				$this->db->update('tourimages', $options); 
				$queryss = $this->db->affected_rows();
				if($queryss > 0){
					return true;
				}else{
					return false;
				}
		}

		public function makeFirstBanners($tid){
			$query = "UPDATE banners SET bannerType='banner'";
			$sql = $this->db->query($query); //echo $sql; die;
			//$n = $query->affected_rows();
			if($sql > 0){
				$queryss = "UPDATE banners SET bannerType='Thumbnail' WHERE bannerId='".$tid."'"; 
				$sqlss = $this->db->query($queryss);
				//$nss = $queryss->affected_rows();
				if($sqlss > 0){
					return true;
				}else{
					return false;
				}
			}
		}

		public function getTablesDetails(){
			$sql = $this->db->query("(select count(*) as menuscount from menus where STATUS=1) UNION (select count(*) as bcount from banners) UNION (select count(*) as ccount from chef) UNION (select count(*) as mccount from menucategory)");
			if($sql->num_rows() > 0){
				return $sql->result_array();
			}else{
				return false;
			}
		}
		public function getAllTourFromTable(){
			$sql = $this->db->query("SELECT tourdetails.*,(SELECT COUNT(tourimages.tourImageId) from tourimages WHERE tourimages.TId=tourdetails.tourId) as totalImage,tourimages.* from tourdetails LEFT JOIN tourimages ON tourdetails.tourId = tourimages.TId AND tourdetails.tourStatus=1 AND tourimages.imageType = 'Thumbnail'");
			if($sql->num_rows() > 0){
				return $sql->result_array();
			}else{
				return false;
			}
		}

		public function getAllTourFromTabless(){
			$this->db->select('*');
			$this->db->where('tourStatus',1);
			$this->db->from('tourdetails');
			$query = $this->db->get();
			if($query->num_rows() > 0){
				$data = $query->result_array();
				$k = 0;
				foreach ($data as $key => $value) {
					$whereAnd = array('imageStatus'=>1,'TId'=>$value['tourId']);
					$this->db->select('*');
					$this->db->where('imageStatus',1);
					$this->db->where('imageStatus',1);
					$this->db->from('tourimages');
					$querys = $this->db->get();
					if($querys->num_rows() > 0){
						$datas = json_encode($querys->result_array());
					}
					$resultSet[$k]['tour'] = json_encode($data);
					$resultSet[$k]['image'] = $datas;
				}
				return json_encode($resultSet);
			}else{
				return false;
			}
		}

		public function getTourFromTableById($tid){
			$this->db->select('*');
			$this->db->where('tourStatus',1);
			$this->db->from('tourdetails');
			$query = $this->db->get();
			if($query->num_rows() > 0){
				$data = $query->result_array();
			}
		}

		public function checkuserlogin($table,$option){
			if($table!="" && count($option) > 0){
				$d = array('userName'=>$option['userName'],'userEmail'=>$option['userEmail']);
				$this->db->select('*');
				$this->db->or_where($d);
				$this->db->where('userPass',md5($option['userPass']));
				$this->db->from($table);

				$query = $this->db->query("SELECT * FROM (`users`) WHERE (`userName` = '".$option['userName']."' OR `userEmail` = '".$option['userName']."') AND `userPass` = '".md5($option['userPass'])."' AND userStatus=1");
				//echo $this->db->last_query(); die;
					if($query->num_rows() > 0){
						return $query->result_array();
					}else{
						return false;
					}
			
			}
		}
	}
?>