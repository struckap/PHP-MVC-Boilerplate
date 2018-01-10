<?php
/**
* 
*/
class Mail 
{
    public static function login($account = null)
    {
        if ($account) 
        {
            if (isset($GLOBALS['mails']['accounts'][$account])) 
            {
                $login = $GLOBALS['mails']['accounts'][$account]['login'];
            }
            else
            {   
                $login = '';
                echo 'Nesprávna $hodnota v mails::login($hodnota), neznámy účet';
            }

            return $login;
        }
    }

    public static function password($account = null)
    {
        if ($account) 
        {
            if (isset($GLOBALS['mails']['accounts'][$account])) 
            {
                $password = $GLOBALS['mails']['accounts'][$account]['password'];
            }
            else
            {   
                $password = '';
                echo 'Nesprávna $hodnota v mails::password($hodnota), neznámy účet';
            }

            return $password;
        }
    }

    public static function singleMail($emailData = [], $multi = false)
    {
        $mail = new PHPMailer();

        $mail->isSMTP();
        $mail->Username = $emailData['username'];
        $mail->Password = $emailData['password'];
        $mail->From = $emailData['from'];
        $mail->FromName = $emailData['fromName'];
        $mail->addReplyTo($emailData['from']);
        $mail->addAddress($emailData['to']);
        $mail->Subject = $emailData['subject'];

        ob_start(); 
        $data = $emailData['emailData'];
            require '../app/views/' . $emailData['view'] . '.php';                       
        $HTML = ob_get_clean();

        $mail->setFrom($emailData['from']);

        $mail->msgHTML($HTML);
        $mail->AltBody = $emailData['noHTML'];

        if (isset($emailData['attachment'])) 
        {
            $mail->AddAttachment($emailData['attachment']);
        }

        if (!$mail->send()) 
        {
            Redirect::to('err/mailNotSent');
        } 
    }
}