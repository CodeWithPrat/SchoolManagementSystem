<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *	@author 	: Optimum Linkup Universal Concepts
 *	date		: 27 June, 2016
 *	Optimum Linkup Universal Concepts
 *	http://optimumlinkup.com.ng/school/Optimum Linkup Universal Concepts
 *	optimumproblemsolver@gmail.com
 */

class Mobile extends CI_Controller
{
    
    
	function __construct()
	{
		parent::__construct();
		$this->load->database();

        // Authenticate data manipulation with the user level security key
        if ($this->validate_auth_key() != 'success')
            die;
    }

    
    
    // generate response to home page with all pixels and advertise_id
    function get_class() {
        $response       =   $this->db->get('class')->result_array();
        echo json_encode($response);
    }

    // returns image of user, returns blank image if not found.
    function get_image_url($type = '', $id = '') {

        $type           =   $this->input->post('user_type');
        $id             =   $this->input->post('user_id');
        $response       =   array();

        if (file_exists('uploads/' . $type . '_image/' . $id . '.jpg'))
            $response['image_url'] = base_url() . 'uploads/' . $type . '_image/' . $id . '.jpg';
        else
            $response['image_url'] = base_url() . 'uploads/user.jpg';

        echo json_encode($response);
    }

    // returns system name and logo as public call
    function get_system_info() {

        $response['system_name']    =   $this->db->get_where('settings' , array('type' => 'system_name'))->row()->description;
        echo json_encode($response);
    }

    // returns the students of a specific class according to requested class_id
    function get_students_of_class() {
        
        $response       =   array();
        $class_id       =   $this->input->post('class_id');
        $students       =   $this->db->get_where('student' , array('class_id' => $class_id))->result_array();

        foreach ($students as $row) {
            $data['student_id'] =   $row['student_id'];
            $data['name']       =   $row['name'];
            $data['birthday']   =   $row['birthday'];
            $data['gender']     =   $row['sex'];
            $data['address']    =   $row['address'];
            $data['phone']      =   $row['phone'];
            $data['email']      =   $row['email'];
            $data['roll']       =   $row['roll'];
            $data['class']      =   $this->db->get_where('class' ,      array('class_id'    =>  $row['class_id']))->row()->name;
            $data['section']    =   $this->db->get_where('section' ,    array('section_id'  =>  $row['section_id']))->row()->name;
            $data['parent_name']=   $this->db->get_where('parent' ,     array('parent_id'   =>  $row['parent_id']))->row()->name;

            $data['image_url']  =   $this->crud_model->get_image_url( 'student' , $row['student_id'] );

            array_push($response , $data);
        }

        echo json_encode($response);
    }

    // get students basic info
    function get_student_profile_information() {

        $response       =   array();
        $student_id     =   $this->input->post('student_id');

        $student_profile=   $this->db->get_where('student' , array('student_id' => $student_id))->result_array();

        foreach ($student_profile as $row) {
            $data['student_id'] =   $row['student_id'];
            $data['name']       =   $row['name'];
            $data['birthday']   =   $row['birthday'];
            $data['gender']     =   $row['sex'];
            $data['address']    =   $row['address'];
            $data['phone']      =   $row['phone'];
            $data['email']      =   $row['email'];
            $data['roll']       =   $row['roll'];
            $data['class']      =   $this->db->get_where('class' ,      array('class_id'    =>  $row['class_id']))->row()->name;
            $data['section']    =   $this->db->get_where('section' ,    array('section_id'  =>  $row['section_id']))->row()->name;
            $data['parent_name']=   $this->db->get_where('parent' ,     array('parent_id'   =>  $row['parent_id']))->row()->name;

            $data['image_url']  =   $this->crud_model->get_image_url( 'student' , $row['student_id'] );

            array_push($response , $data);
        }


        echo json_encode($response);
    }

    // get student's mark info
    function get_student_mark_information() {

        $response       =   array();
        $mark_array     =   array();
        $exam_id        =   $this->input->post('exam_id');
        $student_id     =   $this->input->post('student_id');
        $student_marks  =   $this->db->get_where('mark' , array('exam_id' => $exam_id , 'student_id' => $student_id))->result_array();

        $response['exam_id'] = $exam_id;
        foreach ($student_marks as $row) {
            $data['mark_obtained']      =   $row['mark_obtained'];
            $data['subject']            =   $this->db->get_where('subject' , array('subject_id' =>  $row['subject_id']))->row()->name;

            $grade                      =   $this->crud_model->get_grade($row['mark_obtained']);
            $data['grade']              =   $grade['name'];

            array_push($mark_array , $data);
        }
        $response['marks'] = $mark_array;
        echo json_encode($response);
    }

    // teacher list of the school
    function get_teachers() {
        
        $response       =   array();
        $teachers       =   $this->db->get('teacher')->result_array();


        foreach ($teachers as $row) {
            $data['teacher_id'] =   $row['teacher_id'];
            $data['name']       =   $row['name'];
            $data['birthday']   =   $row['birthday'];
            $data['gender']     =   $row['sex'];
            $data['address']    =   $row['address'];
            $data['phone']      =   $row['phone'];
            $data['email']      =   $row['email'];
            $data['image_url']  =   $this->crud_model->get_image_url( 'teacher' , $row['teacher_id'] );

            array_push($response , $data);
        }

        echo json_encode($response);
        
    }

    // teacher profile information
    function get_teacher_profile() {

        $response       =   array();
        $teacher_id     =   $this->input->post('teacher_id');
        $response       =   $this->db->get_where('teacher' , array('teacher_id' => $teacher_id))->row();
        echo json_encode($response);
        
    }



// librarian list of the school
    function get_librarians() {
        
        $response       =   array();
        $librarians       =   $this->db->get('librarian')->result_array();


        foreach ($librarians as $row) {
            $data['librarian_id'] =   $row['librarian_id'];
            $data['name']       =   $row['name'];
            $data['birthday']   =   $row['birthday'];
            $data['gender']     =   $row['sex'];
            $data['address']    =   $row['address'];
            $data['phone']      =   $row['phone'];
            $data['email']      =   $row['email'];
            $data['image_url']  =   $this->crud_model->get_image_url( 'librarian' , $row['librarian_id'] );

            array_push($response , $data);
        }

        echo json_encode($response);
        
    }

    // librarian profile information
    function get_librarian_profile() {

        $response       =   array();
        $librarian_id     =   $this->input->post('librarian_id');
        $response       =   $this->db->get_where('librarian' , array('librarian_id' => $librarian_id))->row();
        echo json_encode($response);
        
    }



    // get parent list
    function get_parents() {

        $response       =   array();
        $parents       =   $this->db->get('parent')->result_array();

        foreach ($parents as $row) {
            $data['parent_id']  =   $row['parent_id'];
            $data['name']       =   $row['name'];
            $data['profession'] =   $row['profession'];
            $data['address']    =   $row['address'];
            $data['phone']      =   $row['phone'];
            $data['email']      =   $row['email'];
            $data['image_url']  =   $this->crud_model->get_image_url( 'parent' , $row['parent_id'] );

            array_push($response , $data);
        }

        echo json_encode($response);
    }

    // get single parent profile
    function get_parent_profile() {

        $response       =   array();
        $parent_id      =   $this->input->post('parent_id');
        $response       =   $this->db->get_where('parent' , array('parent_id' => $parent_id))->row();
        echo json_encode($response);
    }

    // income or expense history of school of submitted month
    function get_accounting() {

        $response       =   array();
        $month          =   $this->input->post('month');
        $year           =   $this->input->post('year');
        $type           =   $this->input->post('type');

        $start_timestamp=   strtotime("1-".$month."-".$year);
        $end_timestamp  =   strtotime("30-".$month."-".$year);

        $this->db->where("timestamp >=" , $start_timestamp);
        $this->db->where("timestamp <=" , $end_timestamp);
        $this->db->where("payment_type"         , $type);

        $response       =   $this->db->get('payment')->result_array();
        echo json_encode($response);
    }

    // attendance data response
    function get_attendance() {

        $response       =   array();
        $date           =   $this->input->post('date');
        $month          =   $this->input->post('month');
        $year           =   $this->input->post('year');
        $class_id       =   $this->input->post('class_id');

        $students       =   $this->db->get_where('student' , array('class_id' => $class_id))->result_array();
        foreach ($students as $row) {
            $data['student_id']     =   $row['student_id'];
            $data['name']           =   $row['name'];
            $data['roll']           =   $row['roll'];

            $full_date                   =   $year . '-' . $month . '-' . $date;
            $attendance_query       =   $this->db->get_where('attendance' , array('date' => $full_date , 
                                                                                    'student_id' => $row['student_id']));
            if ( $attendance_query->num_rows() > 0) {
                $attendance_result_row     =   $attendance_query->row();
                $data['status']            =   $attendance_result_row->status;
            }
            else {
                $data['status']            =   '0';
            }

            array_push($response , $data);
        }

        echo json_encode($response);
    }

    // class routine : class and weekly day wise
    function get_class_routine() {

        $response       =   array();
        $class_id       =   $this->input->post('class_id');
        $day            =   $this->input->post('day');
        $class_routines =   $this->db->get_where('class_routine' , array('class_id' => $class_id , 'day' => $day))->result_array();
        foreach ($class_routines as $row) {
            $data['class_id']       =   $row['class_id'];
            $data['subject']        =   $this->db->get_where('subject',array('subject_id' => $row['subject_id']))->row()->name;;
            $data['time_start']     =   $row['time_start'];
            $data['time_end']       =   $row['time_end'];
            $data['day']            =   $row['day'];
            
            array_push($response , $data);
        }
        echo json_encode($response);
    }


    // get subject name of subject_id
    function get_subject_name() {

        $response       =   array();
        $subject_id     =   $this->input->post('subject_id');
        $response       =   $this->db->get_where('subject' , array('subject_id' => $subject_id))->row();
        echo json_encode($response);
    }

    // event calendar or noticeboard event list
    function get_event_calendar() {

        $response       =   array();
        $response       =   $this->db->get('noticeboard')->result_array();
        echo json_encode($response);
    }

    // exam list
    function get_exam_list() {

        $response       =   array();
        $response       =   $this->db->get('exam')->result_array();
        echo json_encode($response);
    }

    // get subjects of a class
    function get_subject_of_class() {

        $response       =   array();
        $class_id       =   $this->input->post('class_id');
        $subjects       =   $this->db->get_where('subject' , array('class_id' => $class_id))->result_array();

        foreach ($subjects as $row) {
            $data['subject_id']         =   $row['subject_id'];
            $data['name']               =   $row['name'];

            $teacher_query              =   $this->db->get_where('teacher' , array('teacher_id' =>  $row['teacher_id']));
            if ( $teacher_query->num_rows() > 0) {
                $teacher_query_row      =   $teacher_query->row();
                $data['teacher_name']   =   $teacher_query_row->name;
            }
            else {
                $data['teacher_name']   =   '';
            }


            array_push($response , $data);
        }
        echo json_encode($response);
    }

    // student mark list, subject, class, exam wise
    function get_marks() {

        $response       =   array();
        $exam_id        =   $this->input->post('exam_id');
        $class_id       =   $this->input->post('class_id');
        $subject_id     =   $this->input->post('subject_id');

        $marks          =   $this->db->get_where('mark' , array('exam_id' => $exam_id , 
                                                                     'class_id' => $class_id ,
                                                                         'subject_id' => $subject_id))->result_array();
        foreach ( $marks as $row ) {
            $data['class_id']       =   $row['class_id'];
            $data['student_id']     =   $row['student_id'];
            $data['student_name']   =   $this->db->get_where('student',array('student_id' => $row['student_id']))->row()->name;
            $data['student_roll']   =   $this->db->get_where('student',array('student_id' => $row['student_id']))->row()->roll;
            $data['exam_id']        =   $row['exam_id'];
            $data['mark_obtained']  =   $row['mark_obtained'];
            
            array_push($response , $data);
        }

        echo json_encode($response);
    }

    function get_loggedin_user_profile() {

        $response       =   array();
        $login_type     =   $this->input->post('login_type');
        $login_user_id  =   $this->input->post('login_user_id');
        $user_profile   =   $this->db->get_where( $login_type , array( $login_type.'_id' => $login_user_id ))->result_array();

        foreach ($user_profile as $row) {
            $data['name']       =   $row['name'];
            $data['email']      =   $row['email'];
            $data['image_url']  =   $this->crud_model->get_image_url( $login_type , $login_user_id );
            break;
        }
        array_push($response , $data);

        echo json_encode($response);

    }


    function update_user_image() {
        $response       =   array();
        $user_type      =   $this->input->post('login_type');
        $user_id        =   $this->input->post('login_user_id');

        $directory      =   'uploads/' . $user_type .  '_image/' . $user_id . '.jpg';
        move_uploaded_file($_FILES['user_image']['tmp_name'], $directory);

        $response       =   array('update_status' => 'success');
        echo json_encode($response);
    }


    function update_user_info() {
        $response       =   array();
        $user_type      =   $this->input->post('login_type');
        $user_id        =   $this->input->post('login_user_id');

        $data['name']   =   $this->input->post('name');
        $data['email']  =   $this->input->post('email');
        $this->db->where( $user_type . '_id' , $user_id);
        $this->db->update( $user_type , $data);


        $response       =   array('update_status' => 'success');
        echo json_encode($response);
    }


    function update_user_password() {
        $response       =   array();
        $user_type      =   $this->input->post('login_type');
        $user_id        =   $this->input->post('login_user_id');

        $old_password   =   $this->input->post('old_password');
        $data['password']   =   $this->input->post('new_password');

        // verify if old password matches
        $this->db->where( $user_type . '_id' , $user_id);
        $this->db->where( 'password' , $old_password);
        $verify_query   =   $this->db->get( $user_type );

        if ( $verify_query->num_rows() > 0 ) {
            $this->db->where( $user_type . '_id' , $user_id);
            $this->db->update( $user_type , $data);

            $response       =   array('update_status' => 'success');
        }
        else {
            $response       =   array('update_status' => 'failed');
        }
        
        echo json_encode($response);
    }

    // total number of students
    function get_total_summary() {

        $response       =   array();
        $response['total_student']      = $this->db->count_all('student');
        $response['total_teacher']      = $this->db->count_all('teacher');
        $response['total_parent']       = $this->db->count_all('parent');

        // student present today
        $check          =   array(  'date'      => date('Y-m-d') , 'status' => '1' );
        $query          =   $this->db->get_where('attendance' , $check);
        $present_today  =   $query->num_rows();

        $response['total_present_today'] = $present_today;
        echo json_encode($response);
    }

    // dummy function 
    function getdata() {

        $response       =   array();
        $postvar        =   $this->input->post('postvar');
        $response       =   $this->db->get_where('table' , array('postvar' => $postvar))->result_array();
        echo json_encode($response);
    }


    // Parents functions : own child list, class routine, exam marks of child, invoice of child, event schedule
    function get_children_of_parent() {

        $response       =   array();
        $parent_id      =   $this->input->post('parent_id');
        $response['children']       =   $this->db->get_where('student' , array('parent_id' => $parent_id))->result_array();
        echo json_encode($response);
    }

    function get_child_class_routine() {

    }

    function get_child_exam_marks() {

    }

    function get_child_accounting() {

    }

    


    // Students functions : own child list, class routine, exam marks of child, invoice of child, event schedule
    function get_own_subjects() {

    }

    function get_own_class_routine() {

    }

    function get_own_marks() {

    }

    function get_single_student_accounting() {

        $response       =   array();
        $student_id     =   $this->input->post("student_id");
        $this->db->where("student_id"         , $student_id);
        $response       =   $this->db->get('invoice')->result_array();
        echo json_encode($response);
    }


    // user login matching with db
    function login() {
        $response       = array();
        $email          = $this->input->post("email");
        $password       = $this->input->post("password");

        // Checking login credential for admin
        $query = $this->db->get_where('admin', array('email' => $email , 'password' => $password));
        if ($query->num_rows() > 0) {
            $row = $query->row();

            $authentication_key         =   md5( rand(10000, 1000000));
            $response['status']         =   'success';
            $response['login_type']     =   'admin';
            $response['login_user_id']  =   $row->admin_id;
            $response['name']           =   $row->name;
            $response['authentication_key']=$authentication_key;

            // update the new authentication key into user table
            $this->db->where('admin_id' , $row->admin_id);
            $this->db->update('admin' , array('authentication_key' => $authentication_key));

            echo json_encode($response);
            return;

        }

        // Checking login credential for teacher
        $query = $this->db->get_where('teacher', array('email' => $email , 'password' => $password));
        if ($query->num_rows() > 0) {
            $row = $query->row();

            $authentication_key         =   md5( rand(10000, 1000000));
            $response['status']         =   'success';
            $response['login_type']     =   'teacher';
            $response['login_user_id']  =   $row->teacher_id;
            $response['name']           =   $row->name;
            $response['authentication_key']=$authentication_key;

            // update the new authentication key into user table
            $this->db->where('teacher_id' , $row->teacher_id);
            $this->db->update('teacher' , array('authentication_key' => $authentication_key));
            echo json_encode($response);
            return;

        }

        // Checking login credential for student
        $query = $this->db->get_where('student', array('email' => $email , 'password' => $password));
        if ($query->num_rows() > 0) {
            $row = $query->row();

            $authentication_key         =   md5( rand(10000, 1000000));
            $response['status']         =   'success';
            $response['login_type']     =   'student';
            $response['login_user_id']  =   $row->student_id;
            $response['name']           =   $row->name;
            $response['authentication_key']=$authentication_key;

            $response['class_id']       =   $row->class_id;

            // update the new authentication key into user table
            $this->db->where('student_id' , $row->student_id);
            $this->db->update('student' , array('authentication_key' => $authentication_key));
            echo json_encode($response);
            return;

        }

        // Checking login credential for parent
        $query = $this->db->get_where('parent', array('email' => $email , 'password' => $password));
        if ($query->num_rows() > 0) {
            $row = $query->row();

            $authentication_key         =   md5( rand(10000, 1000000));
            $response['status']         =   'success';
            $response['login_type']     =   'parent';
            $response['login_user_id']  =   $row->parent_id;
            $response['name']           =   $row->name;
            $response['authentication_key']=$authentication_key;

            $response['children']       =   $this->db->get_where('student' , array('parent_id' => $row->parent_id))->result_array();

            // update the new authentication key into user table
            $this->db->where('parent_id' , $row->parent_id);
            $this->db->update('parent' , array('authentication_key' => $authentication_key));
            echo json_encode($response);
            return;

        }

        else {
            $response['status']         =   'failed';
        }

        echo json_encode($response);
    }

    // forgot password link
    function reset_password() {
        $response               = array();
        $response['status']     = 'false';
        $email                  = $_POST["email"];
        $reset_account_type     = '';

        //resetting user password here
        $new_password           =   substr( rand(100000000,20000000000) , 0,7);

        // Checking credential for admin
        $query = $this->db->get_where('admin' , array('email' => $email));
        if ($query->num_rows() > 0) 
        {
            $reset_account_type     =   'admin';
            $this->db->where('email' , $email);
            $this->db->update('admin' , array('password' => $new_password));
            $response['status']         = 'true';
        }
        // Checking credential for student
        $query = $this->db->get_where('student' , array('email' => $email));
        if ($query->num_rows() > 0) 
        {
            $reset_account_type     =   'student';
            $this->db->where('email' , $email);
            $this->db->update('student' , array('password' => $new_password));
            $response['status']         = 'true';
        }
        // Checking credential for teacher
        $query = $this->db->get_where('teacher' , array('email' => $email));
        if ($query->num_rows() > 0) 
        {
            $reset_account_type     =   'teacher';
            $this->db->where('email' , $email);
            $this->db->update('teacher' , array('password' => $new_password));
            $response['status']         = 'true';
        }
        // Checking credential for parent
        $query = $this->db->get_where('parent' , array('email' => $email));
        if ($query->num_rows() > 0) 
        {
            $reset_account_type     =   'parent';
            $this->db->where('email' , $email);
            $this->db->update('parent' , array('password' => $new_password));
            $response['status']         = 'true';
        }

        // send new password to user email  
        $this->email_model->password_reset_email($new_password , $reset_account_type , $email);


        echo json_encode($response);
    }

    // authentication_key validation
    function validate_auth_key() {

        /*
        * Ignore the authentication and returns success by default to constructor 
        * For pubic calls: login, forget password.
        * Pass post parameter 'authenticate' = 'false' to ignore the user level authentication
        */
        if ($this->input->post('authenticate') == 'false')
            return 'success';

        $response                       = array();
        $authentication_key             = $this->input->post("authentication_key");
        $user_type                      = $this->input->post("user_type");

        $query = $this->db->get_where($user_type, array('authentication_key' => $authentication_key));
        if ($query->num_rows() > 0) {
            $row = $query->row();

            $response['status']         =   'success';
            $response['login_type']     =   'admin';

            if ( $user_type == 'admin' )
                $response['login_user_id']  =   $row->admin_id;
            if ( $user_type == 'teacher' )
                $response['login_user_id']  =   $row->teacher_id;
            if ( $user_type == 'student' )
                $response['login_user_id']  =   $row->student_id;
            if ( $user_type == 'parent' )
                $response['login_user_id']  =   $row->parent_id;
            $response['authentication_key']=$authentication_key;


        }

        else {
            $response['status']         =   'failed';
        }

        //return json_encode($response);
        return $response['status'];
    }
    
}




