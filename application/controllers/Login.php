<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');



class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('crud_model');
        $this->load->database();
        $this->load->library('session');
        /* cache control */
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 2010 05:00:00 GMT");
    }

    //Default function, redirects to logged in user area
    public function index() {
	$results = $this->unlinkInstaller();

        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'index.php?admin/dashboard', 'refresh');

        if ($this->session->userdata('teacher_login') == 1)
            redirect(base_url() . 'index.php?teacher/dashboard', 'refresh');
			
		if ($this->session->userdata('librarian_login') == 1)
            redirect(base_url() . 'index.php?librarian/dashboard', 'refresh');
			
			if ($this->session->userdata('accountant_login') == 1)
            redirect(base_url() . 'index.php?accountant/dashboard', 'refresh');
			
			if ($this->session->userdata('hostel_login') == 1)
            redirect(base_url() . 'index.php?hostel/dashboard', 'refresh');

        if ($this->session->userdata('student_login') == 1)
            redirect(base_url() . 'index.php?student/dashboard', 'refresh');

        if ($this->session->userdata('parent_login') == 1)
            redirect(base_url() . 'index.php?parents/dashboard', 'refresh');

        if ($results['RESULT'] == 'INVALID' || $results['RESULT'] == 'EMPTY' || $results['RESULT'] == 'INVALID_DOMAIN') {
            $this->load->view('backend/error');
        } else {
            $this->load->view('backend/login');
        }
    }
	
	
	function unlinkInstaller() {
        $file = APPPATH . 'controllers/Install.php';
        if (is_file($file)) {
            unlink($file);
            $file = APPPATH . 'models/install_model.php';
            unlink($file);
            $file = APPPATH . 'models/install.sql';
            unlink($file);

            $files = glob(APPPATH . 'views/install/*');
            foreach ($files as $file) {
                if (is_file($file))
                    unlink($file);
            }
            rmdir(APPPATH . 'views/install');

            $path = APPPATH . 'config/routes.php';
//        exit($path);
            unlink($path);

            $old_routes_filename = APPPATH . 'config/routes_1.php';
            $new_routes_filename = APPPATH . 'config/routes.php';
            rename($old_routes_filename, $new_routes_filename);
        }

        $padl = new License(false, false, true, false);
        $server_array = $_SERVER;
        $padl->setServerVars($server_array);
        $config = $this->config;
        $license = $config->config['license'];
        $results = $padl->validate($license);
        return $results;
    }


    //Ajax login function 
    function ajax_login() {
        $response = array();

        //Recieving post input of email, password from ajax request
        $email = $_POST["email"];
        $password = $_POST["password"];
        $response['submitted_data'] = $_POST;

        //Validating login
        $login_status = $this->validate_login($email, $password);
        $response['login_status'] = $login_status;
        if ($login_status == 'success') {
            $response['redirect_url'] = '';
        }

        //Replying ajax request with validation response
        echo json_encode($response);
    }

    //Validating login from ajax request
    function validate_login($email = '', $password = '') {
        $credential = array('email' => $email, 'password' => $password);


        // Checking login credential for admin
        $query = $this->db->get_where('admin', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('admin_login', '1');
            $this->session->set_userdata('admin_id', $row->admin_id);
            $this->session->set_userdata('login_user_id', $row->admin_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'admin');
            return 'success';
        }

        // Checking login credential for teacher
        $query = $this->db->get_where('teacher', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('teacher_login', '1');
            $this->session->set_userdata('teacher_id', $row->teacher_id);
            $this->session->set_userdata('login_user_id', $row->teacher_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'teacher');
            return 'success';
        }
		
        // Checking login credential for student
        $query = $this->db->get_where('student', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('student_login', '1');
            $this->session->set_userdata('student_id', $row->student_id);
            $this->session->set_userdata('login_user_id', $row->student_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'student');
            return 'success';
        }

        // Checking login credential for parent
        $query = $this->db->get_where('parent', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('parent_login', '1');
            $this->session->set_userdata('parent_id', $row->parent_id);
            $this->session->set_userdata('login_user_id', $row->parent_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'parent');
            return 'success';
        }
		
		
		// Checking login credential for librarian
        $query = $this->db->get_where('librarian', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('librarian_login', '1');
            $this->session->set_userdata('librarian_id', $row->librarian_id);
            $this->session->set_userdata('login_user_id', $row->librarian_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'librarian');
            return 'success';
        }
		
		
		// Checking login credential for accountant
        $query = $this->db->get_where('accountant', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('accountant_login', '1');
            $this->session->set_userdata('accountant_id', $row->accountant_id);
            $this->session->set_userdata('login_user_id', $row->accountant_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'accountant');
            return 'success';
        }
		
		
		// Checking login credential for hostel
        $query = $this->db->get_where('hostel', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('hostel_login', '1');
            $this->session->set_userdata('hostel_id', $row->accountant_id);
            $this->session->set_userdata('login_user_id', $row->accountant_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'hostel');
            return 'success';
        }

        return 'invalid';
    }

    /*     * *DEFAULT NOR FOUND PAGE**** */

    function four_zero_four() {
        $this->load->view('four_zero_four');
    }

    // PASSWORD RESET BY EMAIL
    function forgot_password()
    {
        $this->load->view('backend/forgot_password');
    }

    function ajax_forgot_password()
    {
        $resp                   = array();
        $resp['status']         = 'false';
        $email                  = $_POST["email"];
        $reset_account_type     = '';
        //resetting user password here
        $new_password           =   substr( md5( rand(100000000,20000000000) ) , 0,7);

        // Checking credential for admin
        $query = $this->db->get_where('admin' , array('email' => $email));
        if ($query->num_rows() > 0) 
        {
            $reset_account_type     =   'admin';
            $this->db->where('email' , $email);
            $this->db->update('admin' , array('password' => $new_password));
            $resp['status']         = 'true';
        }
        // Checking credential for student
        $query = $this->db->get_where('student' , array('email' => $email));
        if ($query->num_rows() > 0) 
        {
            $reset_account_type     =   'student';
            $this->db->where('email' , $email);
            $this->db->update('student' , array('password' => $new_password));
            $resp['status']         = 'true';
        }
        // Checking credential for teacher
        $query = $this->db->get_where('teacher' , array('email' => $email));
        if ($query->num_rows() > 0) 
        {
            $reset_account_type     =   'teacher';
            $this->db->where('email' , $email);
            $this->db->update('teacher' , array('password' => $new_password));
            $resp['status']         = 'true';
        }
        // Checking credential for parent
        $query = $this->db->get_where('parent' , array('email' => $email));
        if ($query->num_rows() > 0) 
        {
            $reset_account_type     =   'parent';
            $this->db->where('email' , $email);
            $this->db->update('parent' , array('password' => $new_password));
            $resp['status']         = 'true';
        }
		
		 // Checking credential for librarian
        $query = $this->db->get_where('librarian' , array('email' => $email));
        if ($query->num_rows() > 0) 
        {
            $reset_account_type     =   'librarian';
            $this->db->where('email' , $email);
            $this->db->update('librarian' , array('password' => $new_password));
            $resp['status']         = 'true';
        }
		
		 // Checking credential for accountant
        $query = $this->db->get_where('accountant' , array('email' => $email));
        if ($query->num_rows() > 0) 
        {
            $reset_account_type     =   'accountant';
            $this->db->where('email' , $email);
            $this->db->update('accountant' , array('password' => $new_password));
            $resp['status']         = 'true';
        }
		
		 // Checking credential for hostel manager
        $query = $this->db->get_where('hostel' , array('email' => $email));
        if ($query->num_rows() > 0) 
        {
            $reset_account_type     =   'hostel';
            $this->db->where('email' , $email);
            $this->db->update('hostel' , array('password' => $new_password));
            $resp['status']         = 'true';
        }

        // send new password to user email  
        $this->email_model->password_reset_email($new_password , $reset_account_type , $email);

        $resp['submitted_data'] = $_POST;

        echo json_encode($resp);
    }

    /*     * *****LOGOUT FUNCTION ****** */

    function logout() {
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(base_url(), 'refresh');
    }

}

class License {

    protected $hashKey1 = 'YmUzYWM2sNGU24NbA363zA7IDSDFGDFGB5aVi35BDFGQ3YNO36ycDFGAATq4sYmSFVDFGDFGps7XDYEzGDDw96OnMW3kjCFJ7M+UV2kHe1WTTEcM09UMHHT';
    protected $hashKey2 = '80dSbqylf4Cu5e5OYdAoAVkzpRDWAt7J1Vp27sYDU52ZBJprdRL1KE0il8KQXuKCK3sdA51P9w8U60wohX2gdmBu7uVhjxbS8g4y874Ht8L12W54Q6T4R4a';
    protected $hashKey3 = 'ant9pbc3OK28Li36Mi4d3fsWJ4tQSN4a9Z2qa8W66qR7ctFbljsOc9J4wa2Bh6j8KB3vbEXB18i6gfbE0yHS0ZXQCceIlG7jwzDmN7YT06mVwcM9z0vy62T';
    protected $useMcrypt = true;
    protected $algorithm = 'blowfish';
    protected $useTime;
    protected $startDif = 129600;
    protected $id1 = 'nSpkAHRiFfM2hE588eB';
    protected $id2 = 'NWCy0s0JpGubCVKlkkK';
    protected $id3 = 'G95ZP2uS782cFey9x5A';
    protected $begin1 = 'BEGIN LICENSE KEY';
    protected $end1 = 'END LICENSE KEY';
    protected $wrapto = 80;
    protected $pad = "-";
    protected $begin2 = '_DATA{';
    protected $end2 = '}DATA_';
    protected $data = array();
    protected $useServer;
    protected $serv;
    protected $mac;
    protected $allowLocal;
    protected $serverInfo = array();
    protected $serverVars = array();
    protected $ips = array();
    protected $requiredUris = 2;
    protected $dateString = 'M/d/Y H:i:s';
    protected $allowedServerDifs = 0;
    protected $allowedIpDifs = 0;

    public function __construct($useMcrypt = true, $useTime = true, $useServer = true, $allowLocal = false) {
        $this->init($useMcrypt, $useTime, $useServer, $allowLocal);
        if ($this->useServer) {
            $this->mac = $this->getMacAddress();
        }
    }

    public function init($useMcrypt = true, $useTime = true, $useServer = true, $allowLocal = false) {
        $this->useMcrypt = ($useMcrypt && function_exists('mcrypt_generic'));
        $this->useTime = $useTime;
        $this->allowLocal = $allowLocal;
        $this->useServer = $useServer;
    }

    public function setServerVars($array) {
        $this->serverVars = $array;
        // some of the ip data is dependant on the $server vars, so update them
        // after the vars have been set
        $this->ips = $this->getIpAddress();
        // update the server info
        $this->serverInfo = $this->getServerInfo();
    }

    public function validate($license) {
        return $this->doValidate($license);
    }

    public function validateRemote($license, $dialhost, $dialpath, $dialport = "80") {
        return $this->doValidate($license, true, $dialhost, $dialpath, $dialport);
    }

    public function setDateFormat($dateFormat) {
        $this->dateString = $dateFormat;
    }

    public function writeKey($key, $filePath) {
        // open the key file for writeing and truncate
        $h = fopen($filePath, 'w');
        // if write fails return error
        if (fwrite($h, $key) === false) {
            return false;
        }
        // close file
        fclose($h);
        // return key
        return true;
    }

    public function registerInstall($domain, $start, $expireIn, $data, $dialhost, $dialpath, $dialport = '80') {
        // check to see if the class has been secured
        $this->check_secure();

        // check if key is alread generated
        // TODO
        if (@filesize($this->licensePath) > 4) {
            return array('RESULT' => 'KEY_EXISTS');
        }

        $data = array('DATA' => $data);

        // if the server matching is required then get the info
        if ($this->useServer) {
            // evaluate the supplied domain against the collected ips
            if (!$this->compareDomainIp($domain, $this->ips)) {
                return array('RESULT' => 'DOMAIN_IP_FAIL');
            }
            // check server uris
            if (count($this->serverInfo) < $this->requiredUris) {
                return array('RESULT' => 'SERVER_FAIL');
            }
            $data['SERVER']['MAC'] = $this->mac;
            $data['SERVER']['PATH'] = $this->serverInfo;
            $data['SERVER']['IP'] = $this->ips;
            $data['SERVER']['DOMAIN'] = $domain;
        }

        // if use time restrictions
        if ($this->useTime) {
            $current = time();
            $start = ($current < $start) ? $start : $current + $start;
            // set the dates
            $data['DATE']['START'] = $start;
            if ($expireIn === 'NEVER') {
                $data['DATE']['SPAN'] = '~';
                $data['DATE']['END'] = 'NEVER';
            } else {
                $data['DATE']['SPAN'] = $expireIn;
                $data['DATE']['END'] = $start + $expireIn;
            }
        }
        // includethe id for requests
        $data['ID'] = md5($this->id2);
        // post the data home
        $data = $this->postData($dialhost, $dialpath, $data, $dialport);
        // return the result and key if approved
        return (empty($data['RESULT'])) ? array('RESULT' => 'SOCKET_FAILED') : $data;
    }

    protected function doValidate($license, $dialhome = false, $dialhost = "", $dialpath = "", $dialport = "80") {
        //// check to see if the class has been secured
        //$this->check_secure();

        if (strlen($license) > 0) {
            // decrypt the data
            $data = $this->unwrapLicense($license);
            if (is_array($data)) {
                // missing / incorrect id therefore it has been tampered with
                if ($data['ID'] != md5($this->id1)) {
                    $data['RESULT'] = 'CORRUPT';
                }
                if ($this->useTime) {
                    // the license is being used before it's official start
                    if ($data['DATE']['START'] > time() + $this->startDif) {
                        $data['RESULT'] = 'TMINUS';
                    }
                    // the license has expired
                    if ($data['DATE']['END'] - time() < 0 && $data['DATE']['SPAN'] != 'NEVER') {
                        $data['RESULT'] = 'EXPIRED';
                    }
                    $data['DATE']['HUMAN']['START'] = date($this->dateString, $data['DATE']['START']);
                    $data['DATE']['HUMAN']['END'] = date($this->dateString, $data['DATE']['END']);
                }
                if ($this->useServer) {
                    $mac = $data['SERVER']['MAC'] === $this->mac;
                    $path = count(array_diff($this->serverInfo, $data['SERVER']['PATH'])) <= $this->allowedServerDifs;
                    $domain = $this->compareDomainIp($data['SERVER']['DOMAIN'], $this->ips);
                    $ip = count(array_diff($this->ips, $data['SERVER']['IP'])) <= $this->allowedIpDifs;

                    // the server details
//                    if (!$mac || !$path || !$domain || !$ip) {
//                        $data['RESULT'] = 'ILLEGAL';
//                    }
//
//                    // check if local
//                    if (in_array('127.0.0.1', $data['SERVER']['IP']) || $data['PATH']['SERVER_ADDR'] === '127.0.0.1' || $data['PATH']['HTTP_HOST'] === '127.0.0.1') {
//                        if (!$this->allowLocal) {
//                            $data['RESULT'] = 'ILLEGAL_LOCAL';
//                        }
//                    }
                }
                // passed all current test so license is ok
                if (!isset($data['RESULT'])) {
                    $domain = $this->compareDomainIp($data['SERVER']['DOMAIN'], $this->ips);
                    if (!$domain) {
                        $data['RESULT'] = 'INVALID_DOMAIN';
                    }
                    // dial to home server if required
                    else if ($dialhome) {
                        // create the details to send to the home server
                        $stuffToSend = array();
                        $stuffToSend['LICENSE_DATA'] = $data;
                        $stuffToSend['LICENSE_DATA']['KEY'] = md5($license);
                        // dial home
                        $data['RESULT'] = $this->callHome($stuffToSend, $dialhost, $dialpath, $dialport);
                    } else {
                        // result is ok all test passed, license is legal
                        $data['RESULT'] = 'OK';
                    }
                }
                // data is returned for use
                return $data;
            } else {
                // the are two reason that mean a invalid return
                // 1 - the other hash key is different
                // 2 - the key has been tampered with
                return array('RESULT' => 'INVALID');
            }
        }
        // returns empty because there is nothing in the dat_string
        return array('RESULT' => 'EMPTY');
    }

    protected function postData($host, $path, $queryArray, $port = 80) {
        // generate the post query info
        $query = 'POSTDATA=' . $this->encrypt($queryArray, 'HOMEKEY');
        $query .= '&MCRYPT=' . $this->useMcrypt;
        // init the return string
        $return = '';

        // generate the post headers
        $post = "POST $path HTTP/1.1\r\n";
        $post .= "Host: $host\r\n";
        $post .= "Content-type: application/x-www-form-urlencoded\r\n";
        $post .= "Content-length: " . strlen($query) . "\r\n";
        $post .= "Connection: close\r\n";
        $post .= "\r\n";
        $post .= $query;

        // open a socket
        $header = @fsockopen($host, $port);
        if (!$header) {
            // if the socket fails return failed
            return array('RESULT' => 'SOCKET_FAILED');
        }
        @fputs($header, $post);
        // read the returned data
        while (!@feof($header)) {
            $return .= @fgets($header, 1024);
        }
        fclose($header);

        // seperate out the data using the delims
        $leftpos = strpos($return, $this->begin2) + strlen($this->begin2);
        $rightpos = strpos($return, $this->end2) - $leftpos;

        // decrypt and return the data
        return $this->decrypt(substr($return, $leftpos, $rightpos), 'HOMEKEY');
    }

    protected function compareDomainIp($domain, $ips = false) {
        // if no ips are supplied get the ip addresses for the server
        if (!$ips) {
            $ips = $this->getIpAddress();
        }
        // get the domain ip list
        $domainIps = gethostbynamel($domain);
        // loop through the collected ip's searching for matches against the domain ips
        if (is_array($domainIps) && count($domainIps) > 0) {
            foreach ($domainIps as $ip) {
                if (in_array($ip, $ips)) {
                    return true;
                }
            }
        }

        return false;
    }

    protected function pad($str) {
        $strLen = strlen($str);
        $spaces = ($this->wrapto - $strLen) / 2;
        $str1 = '';
        for ($i = 0; $i < $spaces; $i++) {
            $str1 = $str1 . $this->pad;
        }
        if ($spaces / 2 != round($spaces / 2)) {
            $str = substr($str1, 0, strlen($str1) - 1) . $str;
        } else {
            $str = $str1 . $str;
        }
        $str = $str . $str1;

        return $str;
    }

    protected function getKey($keyType) {
        switch ($keyType) {
            case 'KEY':
                return $this->hashKey1;
            case 'REQUESTKEY':
                return $this->hashKey2;
            case 'HOMEKEY':
                return $this->hashKey3;
            default:
            // TODO missing default return!!
        }
    }

    protected function getBegin($keyType) {
        switch ($keyType) {
            case 'KEY':
                return $this->begin1;
            case 'REQUESTKEY':
                return $this->begin2;
            case 'HOMEKEY':
                return '';
        }
    }

    protected function getEnd($keyType) {
        switch ($keyType) {
            case 'KEY':
                return $this->end1;
            case 'REQUESTKEY':
                return $this->end2;
            case 'HOMEKEY':
                return '';
        }
    }

    protected function decrypt($str, $keyType = 'KEY') {
        $randAddOn = substr($str, 0, 3);
        $str = base64_decode(base64_decode(substr($str, 3)));
        // get the key
        $key = $randAddOn . $this->getKey($keyType);

        // check to see if mycrypt exists
        if ($this->useMcrypt) {
            // openup mcrypt
            $td = mcrypt_module_open($this->algorithm, '', 'ecb', '');
            $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
            // process the key
            $key = substr($key, 0, mcrypt_enc_getKey_size($td));
            // init mcrypt
            mcrypt_generic_init($td, $key, $iv);

            // decrypt the data and return
            $decrypt = @mdecrypt_generic($td, $str);

            // shutdown mcrypt
            mcrypt_generic_deinit($td);
            mcrypt_module_close($td);
        } else {
            // if mcrypt doesn't exist use regular decryption method
            // init the decrypt vars
            $decrypt = '';

            // loop through the text and decode the string
            for ($i = 1; $i <= strlen($str); $i++) {
                $char = substr($str, $i - 1, 1);
                $keychar = substr($key, ($i % strlen($key)) - 1, 1);
                $char = chr(ord($char) - ord($keychar));
                $decrypt .= $char;
            }
        }
        // return the key
        return @unserialize($decrypt);
    }

    protected function unwrapLicense($encStr, $keyType = 'KEY') {
        // sort the variables
        $begin = $this->pad($this->getBegin($keyType));
        $end = $this->pad($this->getEnd($keyType));

        // get string without seperators
        $str = trim(str_replace(array($begin, $end, "\r", "\n", "\t"), '', $encStr));

        // decrypt and return the key
        return $this->decrypt($str, $keyType);
    }

    protected function getOsVar($varName, $os) {
        $varName = strtolower($varName);
        // switch between the os's
        switch ($os) {
            // not sure if the string is correct for FreeBSD
            // not tested
            case 'freebsd':
            // not sure if the string is correct for NetBSD
            // not tested
            case 'netbsd':
            // not sure if the string is correct for Solaris
            // not tested
            case 'solaris':
            // not sure if the string is correct for SunOS
            // not tested
            case 'sunos':
            // darwin is mac os x
            // tested only on the client os
            case 'darwin':
                // switch the var name
                switch ($varName) {
                    case 'conf':
                        $var = '/sbin/ifconfig';
                        break;
                    case 'mac':
                        $var = 'ether';
                        break;
                    case 'ip':
                        $var = 'inet ';
                        break;
                }
                break;
            // linux variation
            // tested on server
            case 'linux':
                // switch the var name
                switch ($varName) {
                    case 'conf':
                        $var = '/sbin/ifconfig';
                        break;
                    case 'mac':
                        $var = 'HWaddr';
                        break;
                    case 'ip':
                        $var = 'inet addr:';
                        break;
                }
                break;
        }

        return $var;
    }

    protected function getConfig() {
        if (ini_get('safe_mode')) {
            // returns invalid because server is in safe mode thus not allowing
            // sbin reads but will still allow it to open. a bit weird that one.
            return 'SAFE_MODE';
        }
        // if anyone has any clues for windows environments
        // or other server types let me know
        $os = strtolower(PHP_OS);
        if (substr($os, 0, 3) === 'win') {
            // this windows version works on xp running apache
            // based server. it has not been tested with anything
            // else, however it should work with NT, and 2000 also
            // execute the ipconfig
            @exec('ipconfig/all', $lines);
            // count number of lines, if none returned return MAC_404
            // thanks go to Gert-Rainer Bitterlich <bitterlich -at- ima-dresden -dot- de>
            if (count($lines) === 0) {
                return 'ERROR_OPEN';
            }
            // $path the lines together
            $conf = implode(PHP_EOL, $lines);
        } else {
            // get the conf file name
            $osFile = $this->getOsVar('conf', $os);
            // open the ipconfig
            $fp = @popen($osFile, "rb");
            // returns invalid, cannot open ifconfig
            if (!$fp) {
                return 'ERROR_OPEN';
            }
            // read the config
            $conf = @fread($fp, 4096);
            @pclose($fp);
        }

        return $conf;
    }

    protected function getIpAddress() {
        $ips = array();
        // get the cofig file
        $conf = $this->getConfig();
        // if the conf has returned and error return it
        if ($conf != 'SAFE_MODE' && $conf != 'ERROR_OPEN') {
            // if anyone has any clues for windows environments
            // or other server types let me know
            $os = strtolower(PHP_OS);
            if (substr($os, 0, 3) !== 'win') {
                // explode the conf into seperate lines for searching
                $lines = explode(PHP_EOL, $conf);
                // get the ip delim
                $ipDelim = $this->getOsVar('ip', $os);

                // ip pregmatch
                $num = "(\\d|[1-9]\\d|1\\d\\d|2[0-4]\\d|25[0-5])";
                // seperate the lines
                foreach ($lines as $key => $line) {
                    // check for the ip signature in the line
                    if (!preg_match("/^$num\\.$num\\.$num\\.$num$/", $line) && strpos($line, $ipDelim)) {
                        // seperate out the ip
                        $ip = substr($line, strpos($line, $ipDelim) + strlen($ipDelim));
                        $ip = trim(substr($ip, 0, strpos($ip, " ")));
                        // add the ip to the collection
                        if (!isset($ips[$ip])) {
                            $ips[$ip] = $ip;
                        }
                    }
                }
            }
        }

        // if the conf has returned nothing
        // attempt to use the $server data
        if (isset($this->serverVars['SERVER_NAME'])) {
            $ip = gethostbyname($this->serverVars['SERVER_NAME']);
            if (!isset($ips[$ip])) {
                $ips[$ip] = $ip;
            }
        }
        if (isset($this->serverVars['SERVER_ADDR'])) {
            $name = gethostbyaddr($this->serverVars['SERVER_ADDR']);
            $ip = gethostbyname($name);
            if (!isset($ips[$ip])) {
                $ips[$ip] = $ip;
            }
            // if the $server addr is not the same as the returned ip include it aswell
            if (isset($addr) && $addr != $this->serverVars['SERVER_ADDR']) {
                if (!isset($ips[$this->serverVars['SERVER_ADDR']])) {
                    $ips[$this->serverVars['SERVER_ADDR']] = $this->serverVars['SERVER_ADDR'];
                }
            }
        }
        // count return ips and return if found
        if (count($ips) > 0) {
            return $ips;
        }
        // failed to find an ip check for conf error or return 404
        if ($conf === 'SAFE_MODE' || $conf === 'ERROR_OPEN') {
            return $conf;
        }

        return 'IP_404';
    }

    protected function getMacAddress() {
        // open the config file
        $conf = $this->getConfig();

        // if anyone has any clues for windows environments
        // or other server types let me know
        $os = strtolower(PHP_OS);
        if (substr($os, 0, 3) === 'win') {
            // explode the conf into lines to search for the mac
            $lines = explode(PHP_EOL, $conf);
            // seperate the lines for analysis
            foreach ($lines as $key => $line) {
                // check for the mac signature in the line
                // originally the check was checking for the existence of string 'physical address'
                // however Gert-Rainer Bitterlich pointed out this was for english language
                // based servers only. preg_match updated by Gert-Rainer Bitterlich. Thanks
                if (preg_match("/([0-9a-f][0-9a-f][-:]){5}([0-9a-f][0-9a-f])/i", $line)) {
                    $trimmedLine = trim($line);
                    // take of the mac addres and return
                    return trim(substr($trimmedLine, strrpos($trimmedLine, " ")));
                }
            }
        } else {
            // get the mac delim
            $macDelim = $this->getOsVar('mac', $os);

            // get the pos of the os_var to look for
            $pos = strpos($conf, $macDelim);
            if ($pos) {
                // seperate out the mac address
                $str1 = trim(substr($conf, ($pos + strlen($macDelim))));

                return trim(substr($str1, 0, strpos($str1, "\n")));
            }
        }
        // failed to find the mac address
        return 'MAC_404';
    }

    protected function getServerInfo() {
        if (empty($this->serverVars)) {
            $this->setServerVars($_SERVER);
        }
        // get the server specific uris
        $a = array();
        if (isset($this->serverVars['SERVER_ADDR']) && (!strrpos($this->serverVars['SERVER_ADDR'], '127.0.0.1') || $this->allowLocal)) {
            $a['SERVER_ADDR'] = $this->serverVars['SERVER_ADDR'];
        }
        // corrected by Gert-Rainer Bitterlich <bitterlich -at- ima-dresden -dot- de>, Thanks
        if (isset($this->serverVars['HTTP_HOST']) && (!strrpos($this->serverVars['HTTP_HOST'], '127.0.0.1') || $this->allowLocal)) {
            $a['HTTP_HOST'] = $this->serverVars['HTTP_HOST'];
        }
        if (isset($this->serverVars['SERVER_NAME'])) {
            $a['SERVER_NAME'] = $this->serverVars['SERVER_NAME'];
        }
        if (isset($this->serverVars['PATH_TRANSLATED'])) {
            $a['PATH_TRANSLATED'] = substr($this->serverVars['PATH_TRANSLATED'], 0, strrpos($this->serverVars['PATH_TRANSLATED'], '/'));
        } elseif (isset($this->serverVars['SCRIPT_FILENAME'])) {
            $a['SCRIPT_FILENAME'] = substr($this->serverVars['SCRIPT_FILENAME'], 0, strrpos($this->serverVars['SCRIPT_FILENAME'], '/'));
        }
        if (isset($this->serverVars['SCRIPT_URI'])) {
            $a['SCRIPT_URI'] = substr($this->serverVars['SCRIPT_URI'], 0, strrpos($this->serverVars['SCRIPT_URI'], '/'));
        }

        // if the number of different uris is less than the required amount,
        // fail the request
        if (count($a) < $this->requiredUris) {
            return 'SERVER_FAILED';
        }

        return $a;
    }

    protected function callHome($data, $dialhost, $dialpath, $dialport) {
        // post the data home
        $data = $this->postData($dialhost, $dialpath, $data, $dialport);

        return (empty($data['RESULT'])) ? 'SOCKET_FAILED' : $data['RESULT'];
    }

}

