<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Models\message; // Import the EmailLog model

class MessageController extends Controller
{
    /**
     * Send email using Gmail SMTP.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendEmail(Request $request)
    {
        $message = $request->input('message');
        
        // Get the authenticated user's email
        $userEmail = auth()->user()->email;

        // Use the user's email as the sender
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
            $mail->setFrom($userEmail, 'User Name'); // Sender's name
            $mail->addAddress('jennelortizpasoot@gmail.com', 'Jennel Ortiz Pasoot'); // Recipient email and name

            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Message from your website';
            $mail->Body    = $message;

            $mail->send();

            // Log the sent email
            EmailLog::create([
                'sender_email' => $userEmail,
                'recipient_email' => 'recipient@example.com',
                'subject' => 'Message from your website',
                'body' => $message,
                'sent_at' => now(),
            ]);

            session()->flash('success', 'Email sent successfully');
        } catch (Exception $e) {
            session()->flash('error', 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo);
        }

        return redirect()->route('about');
    }
}
