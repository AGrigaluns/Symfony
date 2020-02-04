<?php


namespace App\Form\Model;


use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @UniqueEntity(fields={"email"}, message="This email already exists!")
 */

class UserRegistrationFormModel
{
    /**
     * @Assert\NotBlank(message="Enter an email!")
     * @Assert\Email()
     */
    public $email;
    /**
     * @Assert\NotBlank(message="Choose a password")
     * @Assert\Length(min="5", minMessage="Password is too short!")
     */
    public $plainPassword;
    /**
     * @Assert\IsTrue(message="Agree to our terms!")
     */
    public $agreeTerms;
}
