<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const PROGRAMS = [
        'Walking Dead',
        'The Handmaid\'s Tale',
        'The Big Bang Theory',
        'Scrubs',
        'American Horror Story',
    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::PROGRAMS as $key => $programName){
            $program = new Program();
            $program->setTitle($programName);
            $program->setPoster('http://placekitten.com/200/300?image=' .rand (0, 16));
            $program->setSummary('Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores itaque molestiae debitis neque ipsa, accusantium quod. Ab inventore molestiae distinctio dolorum repellat perspiciatis harum ratione porro? Sunt praesentium corporis nam!');

            for ($id=0; $id < 5; $id++) {
                $program->setCategory($this->getReference('category_' . $id));
            }
            for ($i=0; $i < count(ActorFixtures::ACTORS); $i++) {
                $program->addActor($this->getReference('actor_' . $i));
            }
            $manager->persist($program);
            $this->addReference('program_' . $key, $program);

        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
          ActorFixtures::class,
          CategoryFixtures::class,
        ];
    }

}
