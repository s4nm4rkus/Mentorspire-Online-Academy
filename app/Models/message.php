<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailLog extends Model
{
    protected $fillable = ['sender_email', 'recipient_email', 'subject', 'body'];

    /**
     * Send and log email.
     *
     * @param string $senderEmail
     * @param string $recipientEmail
     * @param string $subject
     * @param string $body
     * @return bool|string
     */
    public static function sendAndLogEmail($senderEmail, $recipientEmail, $subject, $body)
    {
        // Create a new instance of PHPMailer
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'jennelortizpasoot@gmail.com'; // Your Gmail address
            $mail->Password = 'jennelortizpasoot21'; // Your Gmail password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            //Recipients
            $mail->setFrom($senderEmail);
            $mail->addAddress($recipientEmail);

            //Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;

            // Send the email
            $mail->send();

            // Log the sent email
            self::create([
                'sender_email' => $senderEmail,
                'recipient_email' => $recipientEmail,
                'subject' => $subject,
                'body' => $body,
            ]);

            return true;
        } catch (Exception $e) {
            return $mail->ErrorInfo;
        }
    }
}
