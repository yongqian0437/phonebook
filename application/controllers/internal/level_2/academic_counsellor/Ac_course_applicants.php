<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ac_course_applicants extends CI_Controller 
{
    public function __construct()
	{
		parent::__construct();
		$this->load->model(['user_ac_model', 'course_applicants_model']);
        date_default_timezone_set('Asia/Kuala_Lumpur');
        
        // Checks if session is set and if user is signed in as Employer (authorised access). If not, deny his/her access.
        // if (!$this->session->userdata('user_id') || $this->session->userdata('user_role') != "Employer"){  
        //     redirect('user/login/Auth/login');
        // }

        if ($this->session->userdata('has_login') != 0 && $this->session->userdata('user_role') != "Academic Counsellor"){
            redirect('user/login/Auth/login');
        }
	}

    public function index()
    {   
        $data['title'] = 'iJEES | Course Applicants';
        $data['include_js'] = 'ac_course_applicants_list';

        $ac_details = $this->user_ac_model->ac_details($this->session->userdata('user_id'));
        $data['course_applicants'] = $this->course_applicants_model->get_applicants_from_course($ac_details['ac_id'] , $ac_details['uni_id']);

        $this->load->view('internal/templates/header', $data);
        $this->load->view('internal/templates/sidenav');
        $this->load->view('internal/templates/topbar');
        $this->load->view('internal/level_2/academic_counsellor/ac_course_app_list_view');
        $this->load->view('internal/templates/footer');
    }

    function course_applicants_list()
    {
        // Datatables Variables
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));

        $ac_details = $this->user_ac_model->ac_details($this->session->userdata('user_id'));
        $course_applicants = $this->course_applicants_model->get_applicants_from_course($ac_details['ac_id'] , $ac_details['uni_id']);

        $counter = 1;

		$data = array();
		$base_url = base_url();

        foreach($course_applicants as $course_app) {
            
			$view = '<span><button type="button" onclick="view_course_applicant('.$course_app['c_applicant_id'].')" class="btn icon-btn btn-xs btn-info waves-effect waves-light" data-toggle="modal" data-target="#view_course_applicant"><span class="fas fa-eye"></span></button></span>';
            $chat = '<span class = "px-1 "><a type="button" onclick="chat_with_course_applicant(\''.str_replace("'", "\\'", $course_app['user_id']).'\', \''.str_replace("'", "\\'", $course_app['user_fname']).'\', \''.str_replace("'", "\\'", $course_app['user_lname']).'\');")" id="'.$course_app['user_id'].'" title="'.$course_app['user_fname'].' '.$course_app['user_lname'].'" class="btn icon-btn btn-xs btn-success waves-effect waves-light"><span class="fas fa-comment"></span></a></span>';
            
            $function = $view.$chat;

			$data [] = [ 
				$counter,
				$course_app['c_applicant_fname']. ' ' .$course_app['c_applicant_lname'], // from course_applicants table
				$course_app['c_applicant_nationality'], // from course_applicants table
				$course_app['course_name'], // from courses table
                $course_app['c_app_submitdate'], // from course_applicants table
                $function,
            ];

            $counter++;
		}

        $output = array(
			"draw" => $draw,
			"recordsTotal" => count($course_applicants),
			"recordsFiltered" =>count($course_applicants),
			"data" => $data
		);

		echo json_encode($output);
		exit();
    }

    function view_course_applicant()
    {
        $course_applicant_details = $this->course_applicants_model->course_applicant_details($this->input->post('c_applicant_id'));

        $output ='
        <table class="table table-striped" style = "border:0;">
            <tbody>
                <tr>
                <th scope="row">Date Applied</th>
                    <td>'.$course_applicant_details['c_app_submitdate'].'</td>
                </tr>
                <tr>
                    <th scope="row">Course Name</th>
                    <td>'.$course_applicant_details['course_name'].'</td>
                </tr>
                <tr>
                    <th scope="row">Full Name</th>
                    <td>'.$course_applicant_details['c_applicant_fname']. ' ' .$course_applicant_details['c_applicant_lname'].'</td>
                </tr>
                <tr>
                    <th scope="row">Nationality</th>
                    <td>'.$course_applicant_details['c_applicant_nationality'].'</td>
                </tr>
                <tr>
                    <th scope="row">Identification</th>
                    <td>'.$course_applicant_details['c_applicant_identification'].'</td>
                </tr>
                <tr>
                    <th scope="row">Address</th>
                    <td>'.$course_applicant_details['c_applicant_address'].'</td>
                </tr>
                <tr>
                    <th scope="row">Applicant Method</th>
                    <td>'.$course_applicant_details['c_applicant_method'].'</td>
                </tr>
                <tr>
                    <th scope="row">Email</th>
                    <td>'.$course_applicant_details['c_applicant_email'].'</td>
                </tr>
                <tr>
                    <th scope="row">Phone Number</th>
                    <td>'.$course_applicant_details['c_applicant_phonenumber'].'</td>
                </tr>
            </tbody>
        </table>
        
        ';

        echo $output;
    }

}

?>