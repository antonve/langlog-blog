<?php

namespace Kore\UserBundle\DataFixtures\ORM;

use Kore\UserBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('test');
        $user->setEmail('test@example.com');
        $user->setPlainPassword('qwerty');
        $user->setEnabled(true);
        $user->setSuperAdmin(true);
        $manager->persist($user);

        $manager->flush();

        $this->addReference('user', $user);
    }

    public function getOrder()
    {
        return 1;
    }
}
