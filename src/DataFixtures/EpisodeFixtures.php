<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    const EPISODES = [
        '1' => 'Il se passe des trucs 1',
        '2' => 'Il se passe des trucs 2',
        '3' => 'Il se passe des trucs 3',
        '4' => 'Il se passe des trucs 4',
        '5' => 'Il se passe des trucs 5',
        '6' => 'Il se passe des trucs 6',
        '7' => 'Il se passe des trucs 7',
        '8' => 'Il se passe des trucs 8',
        '9' => 'Il se passe des trucs 9',
        '10' => 'Il se passe des trucs 10',
    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::EPISODES as $number => $title){
            $episode = new Episode();
            $episode->setNumber($number);
            $episode->setTitle($title);
            $episode->setSynopsis('Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores itaque molestiae debitis neque ipsa, accusantium quod. Ab inventore molestiae distinctio dolorum repellat perspiciatis harum ratione porro? Sunt praesentium corporis nam!');

            for ($i=1; $i < count(SeasonFixtures::SEASONS); $i++) {
                $episode->setSeason($this->getReference('season_' . $i));
            }
            $manager->persist($episode);

        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
          SeasonFixtures::class,
        ];
    }

}