<?php
class PageManagement{
	// Properties
	// Insert and Manage pages
	function dashboard() {
		$subpage = include 'dashboard/dashboard.php';
		return $subpage;
	}
	function calender() {
		$subpage = include 'dashboard/calender.php';
		return $subpage;
	}

	function my_calender() {
		$subpage = include 'dashboard/my_calender.php';
		return $subpage;
	}
	function number_series() {
		$subpage = include 'pages/insertandmanage/number_series_list.php';
		return $subpage;
	}
	function client() {
		$subpage = include 'pages/insertandmanage/client_list.php';
		return $subpage;
	}


	function client_insert() {
		$subpage = include 'pages/insertandmanage/client_insert.php';
		return $subpage;
	}


	function leads_list() {
		$subpage = include 'pages/insertandmanage/leads_list.php';
		return $subpage;
	}

	function pre_sales_list() {
		$subpage = include 'pages/insertandmanage/pre_sales_list.php';
		return $subpage;
	}

	function Post_sales_list() {
		$subpage = include 'pages/insertandmanage/Post_sales_list.php';
		return $subpage;
	}

	function lost_leads_list() {
		$subpage = include 'pages/insertandmanage/lost_leads_list.php';
		return $subpage;
	}

	function Faculty_PI_list() {
		$subpage = include 'pages/insertandmanage/Faculty_PI_list.php';
		return $subpage;
	}

	function Faculty_Banking_info_list() {
		$subpage = include 'pages/insertandmanage/Faculty_Banking_info_list.php';
		return $subpage;
	}

	function faculty_capacity_list() {
		$subpage = include 'pages/insertandmanage/faculty_capacity_list.php';
		return $subpage;
	}

	function projects() {
		$subpage = include 'pages/insertandmanage/course_list.php';
		return $subpage;
	}

	function module() {
		$subpage = include 'pages/insertandmanage/module_list.php';
		return $subpage;
	}

	function module_insert() {
		$subpage = include 'pages/insertandmanage/module_list.php';
		return $subpage;
	}

	function assessment_list() {
		$subpage = include 'pages/insertandmanage/assessment_list.php';
		return $subpage;
	}

	function one_to_one_ass_list() {
		$subpage = include 'pages/insertandmanage/one_to_one_ass_list.php';
		return $subpage;
	}
	function one_eighty_ass_list() {
		$subpage = include 'pages/insertandmanage/one_eighty_ass_list.php';
		return $subpage;
	}
	function personal_test_ass_list() {
		$subpage = include 'pages/insertandmanage/personal_test_ass_list.php';
		return $subpage;
	}

	function review_list() {
		$subpage = include 'pages/insertandmanage/review_list.php';
		return $subpage;
	}

	function supervisor_review_list() {
		$subpage = include 'pages/insertandmanage/supervisor_review_list.php';
		return $subpage;
	}
	
	function consultant_review_list() {
		$subpage = include 'pages/insertandmanage/consultant_review_list.php';
		return $subpage;
	}
	function attendance_list() {
		$subpage = include 'pages/insertandmanage/attendance_list.php';
		return $subpage;
	}
	function calculations_list() {
		$subpage = include 'pages/insertandmanage/calculations_list.php';
		return $subpage;
	}

	function student_reg() {
		$subpage = include 'pages/insertandmanage/student_reg_list.php';
		return $subpage;
	}

	function deployment_list() { 
		$subpage = include 'pages/insertandmanage/deployment_list.php';
		return $subpage;
	}

	function create_batches_list() {
		$subpage = include 'pages/insertandmanage/create_batches_list.php';
		return $subpage;
	}
	function manual_registration_list() {
		$subpage = include 'pages/insertandmanage/manual_registration_list.php';
		return $subpage;
	}
	function batch_upload_list() {
		$subpage = include 'pages/insertandmanage/batch_upload_list.php';
		return $subpage;
	}
	function Update_attendance_list() {
		$subpage = include 'pages/insertandmanage/Update_attendance_list.php';
		return $subpage;
	}
	function Assessment_results_list() {
		$subpage = include 'pages/insertandmanage/Assessment_results_list.php';
		return $subpage;
	}
	
	function users() {
		$subpage = include 'pages/insertandmanage/users.php';
		return $subpage;
	}

	function usersettings() {
		$subpage = include 'pages/insertandmanage/usersettings.php';
		return $subpage;
	}

	
  }


?>