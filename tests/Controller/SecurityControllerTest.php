<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function testRegister()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/register');

        $this->assertResponseIsSuccessful();

        $button = $crawler->selectButton('Register');
        $form = $button->form();
        $form['user_registration_form[firstName]']->setValue('Ryan');
        $form['user_registration_form[email]']->setValue(sprintf('foo@example.com', rand()));
        $form['user_registration_form[plainPassword]']->setValue('space_rocks');
        $form['user_registration_form[agreeTerms]']->tick();
        $client->submit($form);

        $this->assertResponseRedirects();

    }
}
