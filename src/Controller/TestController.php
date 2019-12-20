<?php
/**
 * Created by : alex
 * Date: 26.08.2019
 * Time: 19:40
 */

namespace App\Controller;



use Psr\Log\LoggerInterface;
use Swift_Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class TestController extends AbstractController
{

    public function index( Swift_Mailer $mailer,LoggerInterface $logger, $name='sasa'): Response
    {
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('asmolin51@gmail.com')
            ->setTo('asmolin51@gmail.com')
            ->setBody("Symfony Mail $name"
            );
        $mailer->send($message);

        $logger->log('info', 'I send message');

        return new Response('Mail Send!');
    }

}