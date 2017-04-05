<?php
  
namespace app\Mailer;

require_once realpath($_SERVER["DOCUMENT_ROOT"]) . '/writer/vendor/swift-mailer/lib/swift_required.php';

/**
 * Class Mailer
 * Classe qui gère la génération et l'envoi d'email
 */
class Mailer
{
    private $mailer_transport;
    private $mailer_host;
    private $mailer_user;
    private $mailer_password;
    
    public function __construct($mailer_transport = '', 
                                $mailer_host = '', 
                                $mailer_user = '', 
                                $mailer_password = '')
    {
        $this->mailer_transport = $mailer_transport;
        $this->mailer_host      = $mailer_host;
        $this->mailer_user      = $mailer_user;
        $this->mailer_password  = $mailer_password;
    }
    
    /**
     * Génère et envoi les emails avec swiftmailer
     */
    function sendMail($type, $code = null, $email, $username = null, $message = null)
    {
        if ($type == 'activation') {
            $subject = 'Activez votre compte';
            $from    = array('jean-forteroche@activation.com' => 'Jean Forteroche');
            $to      = array($email => $username);
            $body    =  '<html>' .
                            ' <head>Bonjour '. $username .'!</head>' .
                            ' <body>' .
                                '<br><br>' .
                                'Merci de vous être inscrit<br><br>' .
                                'Pour activer votre compte, veuillez <a href="http://localhost/writer/web/activate/' . $code . '"/>Cliquer ici</a>.' .
                            ' </body>' .
                        '</html>';
            $emailFormat = 'text/html';
        } else if ($type == 'forgot') {
            $subject = 'Récupération de mot de passe';
            $from    = array('jean-forteroche@recuperation.com' => 'Jean Forteroche');
            $to      = array($email => $username);
            $body    =  '<html>' .
                            ' <head>Bonjour '. $username .'!</head>' .
                            ' <body>' .
                                '<br><br>' .
                                'Pour réinitialiser votre mot de passe, veuillez <a href="http://localhost/writer/web/oublie/' . $code . '"/>Cliquer ici</a>.' .
                            ' </body>' .
                        '</html>';
            $emailFormat = 'text/html';
        } else if ($type == 'contact') {
            $subject = 'Contact';
            $from    = array(htmlspecialchars($email));
            $to      = array('romeo.gre.site@gmail.com');
            $body    =  '<html>' .
                            ' <head>'. htmlspecialchars($email) .' vous a contacté avec le message suivant :</head>' .
                            ' <body>' .
                                '<br><br>' .
                                '' . htmlspecialchars($message) . '' .
                                '<br><br>' .
                                '<a href="mailto:' . htmlspecialchars($email) . '">Répondre</a>' .
                            ' </body>' .
                        '</html>';
            $emailFormat = 'text/html';
        }
        
        $transport = \Swift_SmtpTransport::newInstance($this->mailer_host, 465, 'ssl')
            ->setUsername($this->mailer_user)
            ->setPassword($this->mailer_password)
        ;
        
        $mailer = \Swift_Mailer::newInstance($transport);
        
        $message = \Swift_Message::newInstance($subject)
            ->setFrom($from)
            ->setTo($to)
            ->setBody($body, $emailFormat)
        ;
        
        $result = $mailer->send($message);
    }
}
