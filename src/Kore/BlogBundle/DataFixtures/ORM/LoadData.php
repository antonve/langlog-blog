<?php

namespace Kore\ReaderBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Kore\BlogBundle\Entity\Post;

class LoadMangaData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $post = new Post();
        $post->setTitle('Intro');
        $post->setContent("Lorum lipsum");
        $post->setExcerpt("Lorum");
        $post->setComments(true);
        $post->setSticky(false);
        $post->setPublished(true);
        $post->setCreated(new \DateTime('2013-07-02 00:00:00'));
        $post->setUser($this->getReference('user'));
        $manager->persist($post);


        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
