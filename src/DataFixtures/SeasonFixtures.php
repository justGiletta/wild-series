<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    const SEASONS = [
        '1',
        '2',
        '3',
        '4',
        '5',
        '6',
        '7',
        '8',
        '9',
        '10',
    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::SEASONS as $key => $number){
            $season = new Season();
            $season->setNumber($number);
            $season->setDescription('Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores itaque molestiae debitis neque ipsa, accusantium quod. Ab inventore molestiae distinctio dolorum repellat perspiciatis harum ratione porro? Sunt praesentium corporis nam!');

            for ($i=0; $i < count(ProgramFixtures::PROGRAMS); $i++) {
                $season->setProgram($this->getReference('program_' . $i));
            }
            for ($i=2012; $i < 2022; $i++) {
                $season->setYear($i);
            }
            $manager->persist($season);
            $this->addReference('season_' . $key, $season);

            $manager->flush();
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
          ProgramFixtures::class,
        ];
    }
}
