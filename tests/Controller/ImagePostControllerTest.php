<?php


namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Messenger\Transport\InMemoryTransport;

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

        /** @var InMemoryTransport $transport */
        $transport = self::$container->get('messenger.transport.async_priority_high');
        $this->assertCount(1, $transport->get());

    }
}