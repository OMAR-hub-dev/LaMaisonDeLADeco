<?php
namespace App\Classe;

use Mailjet\Client;
use Mailjet\Resources;

class Mail
{
    private $api_key = 'febf9b44906c08a00c2c7f7a147efc41';
    private $api_key_secret ='77443b5ce8f334d4938f31b0a8dc4ee0';


    public function send($to_mail, $to_name, $subject, $text)
    {
        $mj = new Client($this->api_key, $this->api_key_secret, true, ['version' => 'v3.1']);
      
        $body = [
    'Messages' => [
        [
            'From' => [
                'Email' => "omar.oulaya@gmail.com",
                'Name' => "noter site"
            ],
            'To' => [
                [
                    'Email' => $to_mail,
                    'Name' => $to_name
                ]
            ],
            'TemplateID'    =>3344125,
            'TemplateLanguage' => true,
            'Subject' => $subject,
            'Variables' => [
                'text' => $text,
            ]
    ]]
    ] ;
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success() ;
    }
}







// require 'vendor/autoload.php';
// use \Mailjet\Resources;

// // Use your saved credentials, specify that you are using Send API v3.1

// $mj = new \Mailjet\Client(getenv('MJ_APIKEY_PUBLIC'), getenv('MJ_APIKEY_PRIVATE'),true,['version' => 'v3.1']);

// // Define your request body

// $body = [
//     'Messages' => [
//         [
//             'From' => [
//                 'Email' => "$SENDER_EMAIL",
//                 'Name' => "Me"
//             ],
//             'To' => [
//                 [
//                     'Email' => "$RECIPIENT_EMAIL",
//                     'Name' => "You"
//                 ]
//             ],
//             'Subject' => "My first Mailjet Email!",
//             'TextPart' => "Greetings from Mailjet!",
//             'HTMLPart' => "<h3>Dear passenger 1, welcome to <a href=\"https://www.mailjet.com/\">Mailjet</a>!</h3>
//             <br />May the delivery force be with you!"
//         ]
//     ]
// ];

// // All resources are located in the Resources class

// $response = $mj->post(Resources::$Email, ['body' => $body]);

// // Read the response

// $response->success() && var_dump($response->getData());