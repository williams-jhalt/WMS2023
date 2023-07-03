<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\DocumentLog;
use DateTime;

class DocumentLogFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $logEntry = new DocumentLog();
        $logEntry->setUsername("TEST");
        $logEntry->setOrderNumber("TEST0001");
        $logEntry->setTimestamp(new DateTime());
        $logEntry->setDocumentAction("TEST");

        $manager->persist($logEntry);
        $manager->flush();
    }
}
