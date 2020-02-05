<?php


namespace App\MessageHandler;


use App\Message\AddPonkaToimage;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class AddPonkaToImageHandler implements MessageHandlerInterface
{
    public function __invoke(AddPonkaToimage $addPonkaToimage)
    {
        dump($addPonkaToimage);
    }
}