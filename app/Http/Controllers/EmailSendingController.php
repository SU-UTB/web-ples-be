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


    public static function sendEmail($data)
    {
        $apiInstance = EmailSendingController::initialize();
        $sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail();
        $sendSmtpEmail['subject'] = 'Reprezentační ples UTB 2023 - Potvrzení rezervace';
        $sendSmtpEmail['sender'] = array('name' => 'Ples UTB', 'email' => 'ples@sutb.cz');
        $sendSmtpEmail['to'] = array(
            array('email' => $data['reservation']->email, 'name' => $data['reservation']->name)
        );

        $prepareContent = file_get_contents(dirname(__DIR__, 2) . '/View/Email/ReservationTemplate.htm');
        $prepareContent = str_replace("{{count}}", count($data['seats']), $prepareContent);
        //TODO
        $prepareContent = str_replace("{{table}}", "x", $prepareContent);
        $prepareContent = str_replace("{{endDate}}", $data['reservation']->created_at->addWeekDays(3)->format('d.m H:i'), $prepareContent);
        $sendSmtpEmail['htmlContent'] = $prepareContent;
        
        try {
            $result = $apiInstance->sendTransacEmail($sendSmtpEmail);
            print_r($result);
        } catch (Exception $e) {
            echo 'Exception when calling TransactionalEmailsApi->sendTransacEmail: ', $e->getMessage(), PHP_EOL;
        }
    }
}
