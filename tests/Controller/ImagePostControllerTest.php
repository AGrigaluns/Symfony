<?php


namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImagePostControllerTest extends WebTestCase
{
    public function testCreate()
    {
        $this->assertEquals(42, 42);

        $client = static::createClient();

        $uploadedFile = new UploadedFile(
            __DIR__.'/../fixtures/dog.jpg',
            'dog.jpg'
        );
        $client->request('POST', '/api/images', [], [
           'file' => $uploadedFile,
        ]);

        $this->assertResponseIsSuccessful();
    }
}