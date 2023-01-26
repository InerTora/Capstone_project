<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#Should Import this, after installing a 'composer require twilio/sdk' in the composer to directed folder (iDriveDrivingTutorial.com)
use Twilio\Rest\Client;

class SMSCtrl extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');

	}
    public function index(){
        $this->load->view('Send');#Change
    }
    public function send_sms(){
        $message = $this->input->post('message');  #Message Content base on input
        $sid = 'ACdd3db6622200b4d101a13199585f6447';
        $token = '833af001b9bf6e6e08f16e5036086121';
        $twilio_client = new Client($sid,$token);
        $phone = '+13253996501'; #Twilio Default No.

        #This section creates the message body
        try{                                   #change reciever no.
            $twilio_client->messages->create( '+639464003615', [
                'body'=>$message,
                'from'=>$phone
            ]);
            echo 'sms has been sent!';#Change to Notification instead of message
        }catch(Exception $ex){
            echo 'SMS failed due to '.$ex->getMessage(); #Change to Notification instead of message
        }
    }
}