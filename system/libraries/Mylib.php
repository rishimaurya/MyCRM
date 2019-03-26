<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CI_Mylib {

  public function __construct($params = array())
  {
    $this->CI =& get_instance();
    //$this->CI->load->language('pagination');
    //$this->initialize($params);
    //log_message('info', 'MyLib Class Initialized');
  }
  
  public function pagination($baseUrl,$Model,$columns,$table,$where,$rows=20,$Function,$resultData)
    {
    /*  Pagination Technique. */
    
    $data   = array();
    $this->CI->load->model($Model);
    $this->CI->load->library('pagination');
    $this->CI->load->helper('url');
    
    $config['base_url'] = base_url().'/'.$baseUrl.'/';
        $config['total_rows'] = $this->CI->$Model->count($columns,$table,$where);
        $config['per_page'] = $rows;
        $config['uri_segment'] = 3;
        $config['reuse_query_string'] = TRUE;
        
    //Styling Link for Pagination. 
        
        $config['full_tag_open']    = "<ul class='pagination'>";
        $config['full_tag_close']   = "</ul>";
        $config['num_tag_open']     = "<li>";
        $config['num_tag_close']    = "</li>";
        $config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close']    = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open']    = "<li>";
        $config['next_tag_close']  = "</li>";
        $config['prev_tag_open']    = "<li>";
        $config['prev_tag_close']  = "</li>";
        $config['first_tag_open']   = "<li>";
        $config['first_tag_close'] = "</li>";
        $config['last_tag_open']    = "<li>";
        $config['last_tag_close']  = "</li>";
        $this->CI->pagination->initialize($config); 
        
        $page = ($this->CI->uri->segment(3)) ? $this->CI->uri->segment(3) : 0;
        $data['count']=$page;
    
    $data[$resultData] = $this->CI->$Model->$Function($columns,$table,$where,$config['per_page'],$page);
    $data['links']  = $this->CI->pagination->create_links();
    //print_r($data['links']);
    return $data;
      
    }
    
    public function sendSMS($Mobile,$msg)
    {
     $msg = $msg." IES IPS ACADEMY INDORE (M.P.)";
     $msg = rawurlencode($msg);
     $url="http://login.smsgatewayhub.com/smsapi/pushsms.aspx?user=ipsacademy&pwd=ipsacademy@2015&to=".$Mobile."&sid=IESIPS&msg=".$msg."&fl=0&gwid=2"; 
     //file_get_contents($url);
        
  }
  
  public function sendMail($subject,$msg,$from="",$to)
  {
    $this->CI->load->library('email');
    $this->CI->email->initialize();
    
    $this->CI->email->from($from);
    $this->CI->email->to($to);
    $this->CI->email->subject($subject);
    $this->CI->email->message($message.$time); 
    $this->CI->email->attach('');
    
     if ( ! $this->CI->email->send()) 
     {
      show_error($this->CI->email->print_debugger());
     }
  } 

  public function encryptIt1($value) {
      // The encodeKey MUST match the decodeKey
      $encodeKey = 'DvHtl3CGp4QLuuOEtBQ2AS';
      $encoded = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($encodeKey), $value, MCRYPT_MODE_CBC, md5(md5($encodeKey))));

      return($encoded);
    }

    public function decryptIt1($value) {
      
      $decodeKey = 'DvHtl3CGp4QLuuOEtBQ2AS';
      $decoded = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($decodeKey), base64_decode($value), MCRYPT_MODE_CBC, md5(md5($decodeKey))), "\0");
      return($decoded);
    }

    var $skey   = "SuPerEncKey20101"; // you can change it
  
    public  function safe_b64encode($string) {
  
        $data = base64_encode($string);
        $data = str_replace(array('+','/','='),array('-','_',''),$data);
        return $data;
    }
 
  public function safe_b64decode($string) {
        $data = str_replace(array('-','_'),array('+','/'),$string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }
  
    public  function encryptIt2($value){ 
    
      if(!$value){return false;}
        $text = $value;
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->skey, $text, MCRYPT_MODE_ECB, $iv);
        return trim($this->safe_b64encode($crypttext)); 
    }
    
    public function decryptIt2($value){
    
        if(!$value){return false;}
        $crypttext = $this->safe_b64decode($value); 
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->skey, $crypttext, MCRYPT_MODE_ECB, $iv);
        return trim($decrypttext);
    }

    public  function encryptIt($value){ 
    
      $this->CI->load->library('encryption');
        $key = "f3ba9c39525c69de604f3d0d079b2b290d8909e3";
      $config['encryption_key'] = hex2bin($key);
      $config['driver'] = "openssl";
      $config['cipher'] = "des";
      $config['mode'] = "cbc";
      $config['key'] = $key;
      $this->CI->encryption->initialize($config);

      return $this->CI->encryption->encrypt($value);
    }
    
    public function decryptIt($value){
    
        
      $this->CI->load->library('encryption');
        $key = "f3ba9c39525c69de604f3d0d079b2b290d8909e3";
      $config['encryption_key'] = hex2bin($key);
      $config['driver'] = "openssl";
      $config['cipher'] = "des";
      $config['mode'] = "cbc";
      $config['key'] = $key;
      $this->CI->encryption->initialize($config);

      return $this->CI->encryption->decrypt($value);
    }

    
    public function pageNotFound()
    {
      $this->CI->load->view('new_template/faculty_common');
      $this->CI->load->view('error_404');
      $this->CI->load->view('new_template/new_footer');
    }

   public function hash_password($password)
   {
      return password_hash($password, PASSWORD_BCRYPT);
   }
}
