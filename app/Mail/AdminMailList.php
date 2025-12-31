<?php

namespace App\Mail;

use App\Data\EmailTemplates;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminMailList extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public array $data, public $type = null) {}

    public function build()
    {
        $getData = $this->getMailData();

        if (empty($getData['msg'])) {
            return ['error' => 'Email template not found'];
        }


        return $this->subject($getData['subject'] ?? '')
            ->html($getData['msg'] ?? '');
    }

    public function getMailData()
    {
        $mailType = $this->data['type'] ?? null;
        $email = $this->data['email'] ?? null;
        $type = $this->type ?? $mailType;

        if ($type == 'testmail') {
            $getData = $this->testmailTemplate($this->data);
        } else {
            $getData = $this->send_global_mail($this->data, $email, $type);
        }
        return $getData;
    }



    public function send_global_mail($data = [], $mail_to = '', $type = '', $vendor_id = 0)
    {

        $mailContent = isJson(__settings('email_template_config'))
            ? json_decode(__settings('email_template_config'), true)
            : [];
        $language = isset($data['lang']) ? $data['lang'] : __site_language();

        $getMsg = isset($mailContent[$type])
            ? $mailContent[$type]
            : '';


        $getData = EmailTemplates::mailType($type);



        $getDataKeys = array_keys(array_change_key_case($data, CASE_UPPER));
        $getDataValues = array_values($data);
        $data = array_combine($getDataKeys, $getDataValues);

        $getDbValues = array_values($getData); // comes from Database




        $getMatchedData = [];
        foreach ($getDbValues as $key => $arr) {
            if (isset($data[$arr])) {
                $getMatchedData[$arr] = $data[$arr];
            }
        }



        $message = isset($getMsg['message'][$language]) ? $getMsg['message'][$language] : (isset($getMsg['message']['en']) ? $getMsg['message']['en'] : '');

        $msg = $this->create_email_msg($getMatchedData, $message);


        $subject = isset($getMsg['subject'][$language]) ? $getMsg['subject'][$language] : (isset($getMsg['subject']['en']) ? $getMsg['subject']['en'] : '');

        $mail_to_type = ['contact_mail'];
        if (in_array($type, $mail_to_type)) {
            $send_to = __settings('smtp_mail');
        } else {
            $send_to = $mail_to;
        }


        $message = '
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>' . $subject . '</title>
            </head>
            <body style="font-family: Arial, sans-serif; margin: 0; padding: 5px; background-color: #f4f4f4;">
                ' . $msg . '
              
            </body>
            </html>';

        $mailData = [
            'site_name' => $data['site_name'] ?? __settings('app_name'),
            'msg' => $message,
            'subject' => $subject,
            'mail_to' => $send_to,
        ];

        return $mailData;
    }


    private function create_email_msg($data, $msg)
    {
        $find       = array_keys($data);
        $replace    = array_values($data);
        $new_msg = str_replace($find, $replace, $msg);
        if (!empty($new_msg)) {
            return str_replace(array('{', '}'), ' ', ($new_msg));
        } else {
            return '';
        }
    }


    protected function testmailTemplate($data)
    {
        $msg = "
            <h1>Mail Testing...</h1>
            <p>Mail testing.... Mail working fine</p>
        ";

        return ['subject' => 'Test mail', 'msg' => $msg];
    }



    protected function defaultTemplate($data)
    {
        return "
            <h1>Hello!</h1>
            <p>This is a default notification email.</p>
        ";
    }
}
