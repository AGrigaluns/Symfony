<?php
namespace App\DataFixtures;
use App\Entity\ApiToken;
use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends BaseFixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(10, 'main_users', function($i) use ($manager) {
                $user = new User();
                $user->setEmail(sprintf('user%d@space.com', $i));
                $user->setFirstName($this->faker->firstName);
                $user->agreeTerms();
                if ($this->faker->boolean) {
                    $user->setTwitterUsername($this->faker->userName);
                }

                $user->setPassword($this->passwordEncoder->encodePassword(
                   $user,
                   'user123'
                ));

                $apiToken1 = new ApiToken($user);
                $apiToken2 = new ApiToken($user);
                $manager->persist($apiToken1);
                $manager->persist($apiToken2);

                return $user;
        });

        $this->createMany(2, 'admin_users', function($i) {
            $user = new User();
            $user->setEmail(sprintf('admin%d@space.com', $i));
            $user->setFirstName($this->faker->firstName);
            $user->setRoles(['ROLE_ADMIN']);
            $user->agreeTerms();

            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'admin123'
            ));

            return $user;
        });

        $manager->flush();
    }
}
