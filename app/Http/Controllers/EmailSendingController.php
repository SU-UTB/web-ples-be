<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

use SendinBlue\Client\Configuration;
use SendinBlue\Client\Api\TransactionalEmailsApi;
use GuzzleHttp;


class EmailSendingController extends Controller
{

    private static function initialize()
    {
        $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', env('SENDINBLUE_API_KEY'));

        $apiInstance = new TransactionalEmailsApi(
            // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
            // This is optional, `GuzzleHttp\Client` will be used as default.
            new GuzzleHttp\Client(),
            $config
        );

        try {
            $result = $apiInstance;
            return $result;
        } catch (Exception $e) {
            echo 'Exception when calling instance$apiInstanceApi->getinstance$apiInstance: ', $e->getMessage(), PHP_EOL;
        }
    }

    public static function sendEmail()
    {
        $apiInstance = EmailSendingController::initialize();
        $sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail();
        $sendSmtpEmail['subject'] = 'Reprezentacni ples UTB 2023';
        $sendSmtpEmail['sender'] = array('name' => 'Reprezentacni ples utb', 'email' => 'ples@sutb.cz');
        $sendSmtpEmail['to'] = array(
            array('email' => 'sedlar@sutb.cz', 'name' => 'Davca')
        );
        $sendSmtpEmail['textContent'] = 'cau cau';

        $sendSmtpEmail['headers'] = array('Some-Custom-Name' => 'unique-id-12s34');
        $sendSmtpEmail['params'] = array('parameter' => 'My param value', 'subject' => 'New Subject');

        try {
            $result = $apiInstance->sendTransacEmail($sendSmtpEmail);
            print_r($result);
        } catch (Exception $e) {
            echo 'Exception when calling TransactionalEmailsApi->sendTransacEmail: ', $e->getMessage(), PHP_EOL;
        }
    }
}
