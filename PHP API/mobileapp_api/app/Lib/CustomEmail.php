<?php

class CustomEmail
{

    public static function sendMail($data)
    {
        $response = null;
        $http_code = null;

        $to_email = $data['to'];


        $email_form['From'] = SUPPORT_EMAIL;

        $email_form['To'] = $to_email;
        $email_form['Subject'] = $data['subject'];
        $email_form['HtmlBody'] = $data['message'];
        $email_form['TextBody'] = $data['message'];
        $email_form['ReplyTo'] = SUPPORT_EMAIL;

        /*$json = json_encode(array(
            'From' => SUPPORT_EMAIL,
            'To' => $data['to'],

            'TemplateAlias' => "password-reset",
            'TemplateModel' => $data['message'],
            //'HtmlBody' => '<html><body>But <em>this</em> will be shown to HTML mail clients</body></html>'
            'HtmlBody' => $data['message']

        ));*/

        $json = json_encode($email_form);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.postmarkapp.com/email');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Accept: application/json',
            'Content-Type: application/json',
            'X-Postmark-Server-Token: ' . POSTMARK_SERVER_API_TOKEN
        ));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        $response = json_decode(curl_exec($ch), true);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $response;
    }
}





?>