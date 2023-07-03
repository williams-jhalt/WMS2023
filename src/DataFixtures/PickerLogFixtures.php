<?php

namespace App\DataFixtures;

use App\Entity\PickerLog;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PickerLogFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $logEntry = new PickerLog();
        $logEntry->setUsername("TEST");
        $logEntry->setOrderNumber("TEST0001");
        $logEntry->setTimestamp(new DateTime());
        $logEntry->setLineCount(10);
        $logEntry->setPageCount(2);

        $manager->persist($logEntry);
        $manager->flush();
    }
}
