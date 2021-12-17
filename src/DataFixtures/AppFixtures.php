<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i < 10; $i++) {
            $contact = new Contact();
            $contact->setEmail('user' . $i . '@test.fr');
            $contact->setNom('user' . $i);
            $contact->setMessage('ok');
            $contact->setNewsletter('non');
            $contact->setPrenom('ok');
            $contact->setSujet('sujet');
            $manager->persist($contact);
        }
        $manager->flush();
    }
}
