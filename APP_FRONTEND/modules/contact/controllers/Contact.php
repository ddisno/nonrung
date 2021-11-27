<?php

class Contact extends MY_Controller
{
	public function __construct(){
		parent::__construct();
		$this->lang->load('contact',$this->language);
		$this->load->library('email');  // เรียกใช้ email class
		$this->load->model('model_contact');
	}

	public function index(){
		$this->data['title'] = lang('lang_title');

		$this->data['gmap'] = $this->model_contact->gmap();
		$this->middle = 'contact';
		$this->layout();
	}

	public function sendmail(){
		// Form Processing Messages
		$message_success = 'We have <strong>successfully</strong> received your Message and will get Back to you as soon as possible.';
		$recaptcha_secret = '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe'; // Your reCaptcha Secret

		// check bot
		$botcheck = $this->input->post('template-contactform-botcheck'); // check bot
		if( $botcheck != '' ) {
			echo '{ "alert": "error", "message": "Bot <strong>Detected</strong>.! Clean yourself Botster.!" }';
			exit;
		}

		// Runs only when reCaptcha is present in the Contact Form
		$recaptcha_data = array(
			'secret' => $recaptcha_secret,
			'response' => $this->input->post('g-recaptcha-response')
		);
		$recap_verify = curl_init();
		curl_setopt( $recap_verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify" );
		curl_setopt( $recap_verify, CURLOPT_POST, true );
		curl_setopt( $recap_verify, CURLOPT_POSTFIELDS, http_build_query( $recaptcha_data ) );
		curl_setopt( $recap_verify, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $recap_verify, CURLOPT_RETURNTRANSFER, true );
		$recap_response = curl_exec( $recap_verify );
		$g_response = json_decode( $recap_response );

		if ( $g_response->success !== true ) {
			echo '{ "alert": "error", "message": "Captcha not Validated! Please Try Again." }';
			die;
		}
		// !----g captcha

		// input form
		$name = htmlspecialchars($this->input->post('name'));
		$email = $this->input->post('email');
		$subject = $this->input->post('subject');
		$message = $this->input->post('message');

		// config
		$config = Array(
	        'protocol' => 'smtp',
	        'smtp_host' => 'mail.pexno.com',
	        'smtp_port' => 25, //465,
	        'smtp_user' => 'sbdragon@pexno.com',
	        'smtp_pass' => 'tookmo0730',
	        'smtp_crypto' => 'STARTTLS',
	        'smtp_timeout' => '20',
	        'mailtype'  => 'html', 
	        'charset'   => 'utf8'
	    );
	    $config['newline'] = "\r\n";
	    $config['crlf'] = "\r\n";

		$this->email->initialize($config);
		$this->email->from('sbdragon@pexno.com',$name);
		$this->email->to('weeradach.ch@gmail.com');
		$this->email->reply_to($email, $name);
		$this->email->subject($subject);
		$this->email->message($message);
        if($this->email->send()){   // คืนค่าการทำงานว่าเป็น true หรือ false  
        	echo '{ "alert": "success", "message": "' . $message_success . '" }';
        	
		}else{
			echo '{ "alert": "error", "message": "Email <strong>could not</strong> be sent due to some Unexpected Error. Please Try Again later.<br /><br /><strong>Reason:</strong><br />" }';
			
		}
	}
}