<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Contact
        // for ($i = 0; $i < 5; $i++) {
        //     $contact = new Contact();
        //     $contact->setFullName($this->faker->name());
        //     $contact->setEmail($this->faker->email());
        //     $contact->setSubject('Demande n°' . ($i + 1));
        //     $contact->setMessage($this->faker->text());
        //     $manager->persist($contact);
        // }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
