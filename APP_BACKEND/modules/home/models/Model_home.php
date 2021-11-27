<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_home extends CI_Model{

	public function getdata($year,$phase){
		$data	   = [];
		//keep 4 array
		$reserve    = $this->cal('pedding',$year,$phase);
		$check_in   = $this->cal('success',$year,$phase);
		$cancelled  = $this->cal('cancelled',$year,$phase);
		$expired    = $this->cal('expired',$year,$phase);
		
		if($phase==1){
			$month = ['มกราคม', 'กุมภาพันธ์', 'มีนาคม'];
		}elseif($phase==2){
			$month = ['เมษยาน', 'พฤษภาคม', 'มิถุนายน'];
		}elseif($phase==3){
			$month = ['กรกฏาคม','สิงหาคม','กันยายน'];
		}elseif($phase==4){
			$month = ['ตุลาคม','พฤษจิกายน','ธันวาคม'];
		}else{
			$month = ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษยาน', 'พฤษภาคม', 'มิถุนายน', 'กรกฏาคม','สิงหาคม','กันยายน','ตุลาคม','พฤษจิกายน','ธันวาคม'];
		}

		return $data = [$reserve,$check_in,$cancelled,$expired,$month];
	}

	public function cal($keep,$year,$month){
		// default
		
		if($year==''){
			$year = date('Y');
		}

		if($month==''){
			$month_start  = 1;
			$month_end 	  = 12;
		}else{
			switch ($month) {
				case '1':
					$month_start  = 1;
					$month_end 	  = 3;
					break;

				case '2':
					$month_start  = 4;
					$month_end 	  = 6;
					break;

				case '3':
					$month_start  = 7;
					$month_end 	  = 9;
					break;

				case '4':
					$month_start  = 10;
					$month_end 	  = 12;
					break;

				default:
					$month_start  = 1;
					$month_end 	  = 12;
					break;
			}
		}

		$datestart = '';
		$dateend   = '';
		$data      = [];

		for ($i=$month_start; $i <= $month_end; $i++) { 
			$day = cal_days_in_month(CAL_GREGORIAN, $i, $year);
			if(strlen($i)==1){
				$i = '0'.$i;
			}
			$datestart = $year.'-'.$i.'-01'. ' 00:00:00';
			$dateend  = $year.'-'.$i.'-'.$day. ' 23:59:59';

			$this->db->where('reserve_log_start >=',$datestart);
			$this->db->where('reserve_log_start <=',$dateend);
			if($keep!='pedding'){
				$this->db->where('status',$keep);
			}
			$this->db->from('reserve_log');
			$query = $this->db->get();
			$number = $query->num_rows();

			$data[] = $number;
		}
		return $data;
	}
}