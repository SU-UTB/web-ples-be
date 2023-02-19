<?php

namespace App\Http\Controllers;

use App\Models\Maker;
use Exception;
use GuzzleHttp;
use SendinBlue\Client\Api\TransactionalEmailsApi;
use SendinBlue\Client\Configuration;


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


    public static function sendEmail(EmailContent $type, $data)
    {
        $apiInstance = EmailSendingController::initialize();
        $sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail();
        $sendSmtpEmail['subject'] = EmailSendingController::getEmailSubject($type);
        $sendSmtpEmail['sender'] = array('name' => 'Ples UTB', 'email' => 'ples@sutb.cz');
        $sendSmtpEmail['to'] = array(
            array('email' => $data['reservation']->email, 'name' => $data['reservation']->name)
        );

        $content = EmailSendingController::getEmailContent($type, $data);

        $sendSmtpEmail['htmlContent'] = $content;

        try {
            $result = $apiInstance->sendTransacEmail($sendSmtpEmail);
        } catch (Exception $e) {
            echo 'Exception when calling TransactionalEmailsApi->sendTransacEmail: ', $e->getMessage(), PHP_EOL;
        }
    }

    private static function getEmailContent(EmailContent $type, $data)
    {
        switch ($type) {
            case EmailContent::Reserve:
                $prepareContent = file_get_contents(dirname(__DIR__, 2) . '/View/Email/ReservationTemplate.htm');
                $prepareContent = str_replace("{{count}}", count($data['seats']), $prepareContent);
                //TODO
                $prepareContent = str_replace("{{table}}", "x", $prepareContent);
                $prepareContent = str_replace("{{endDate}}", $data['reservation']->created_at->addWeekDays(3)->format('d.m H:i'), $prepareContent);
                return $prepareContent;
            case EmailContent::ReserveMaker:
                $makerName = Maker::find($data['reservation']->maker)->name;
                $prepareContent = file_get_contents(dirname(__DIR__, 2) . '/View/Email/MakerReservationTemplate.htm');
                $prepareContent = str_replace("{{maker}}", $makerName, $prepareContent);
                $prepareContent = str_replace("{{time}}", $data['reservation']->time, $prepareContent);
                $prepareContent = str_replace("{{service}}", $data['reservation']->service, $prepareContent);
                return $prepareContent;
            case EmailContent::Cancel:
                return file_get_contents(dirname(__DIR__, 2) . '/View/Email/CancelTemplate.htm');
        }
    }

    private static function getEmailSubject(EmailContent $type)
    {
        switch ($type) {
            case EmailContent::ReserveMaker:
            case EmailContent::Reserve:
                return 'Reprezentační ples UTB 2023 - Potvrzení rezervace';
            case EmailContent::Cancel:
                return 'Reprezentační ples UTB 2023 - Zrušení rezervace';
        }
    }
}

enum EmailContent
{
    case Reserve;
    case Cancel;
    case ReserveMaker;
}
