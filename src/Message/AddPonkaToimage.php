<?php


namespace App\Message;


use App\Entity\ImagePost;

class AddPonkaToimage
{
    private $imagePost;

    public function __construct(ImagePost $imagePost)
    {
        $this->imagePost = $imagePost;
    }

    public function getImagePost(): ImagePost
    {
        return $this->imagePost;
    }
}