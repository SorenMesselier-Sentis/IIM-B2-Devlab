<?php

namespace App\DataFixtures;

use App\Entity\News;
use App\Entity\User;
use App\Entity\Comment;
use App\Entity\Project;
use App\Entity\Technos;
use App\Entity\Comments;
use App\Entity\Skill;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher)
    {
    }
    
    public function load(ObjectManager $manager): void
    {


        // skills fixtures
        $Skill = [
            // skills natif 
            'HTML',
            'CSS',
            'JavaScript',
            'PHP',
            'python',
            'C',
            'C++',
            'C#',
            'Java',
            'Ruby',

            // skills framowrk 
            'laravel',
            'Symfony',
            'Vue',
            'React',
            'Three.js',
            'Node.js',
            'Express',
            'Angular',
            'Django',
            'Flask',
            'Drupal',
            'Wordpress',
            'Ruby on Rails',
            'CodeIgniter',
            'Nuxt.js',
            'Lumen',

            // Skills db 
            'MongoDB',
            'MySQL',
            'SQLite',
            'PostgreSQL',
            'SQL',
            'MariaDB',
            'Firebase',
            'Firestore',
            'Firebase Auth',
            'Firebase Storage',
            'Firebase Realtime Database',
            'Firebase Cloud Functions',
            'Firebase Hosting',

            // web 3.0
            'Solidity',
            'Ethereum',
            'Truffle',

            // Skills git
            'Git',
            'Linux',
            'Docker',
            'GitHub',
            'GitLab',
            'GitLab CI',
            'GitLab Runner',
        ];

        foreach ($Skill as $label) {
            $skill = new Skill();
            $skill->setLabel($label);
            $manager->persist($skill);
        }
        $manager->flush();

        $userSkills = $manager->getRepository(Skill::class)->findAll();

        // users fixtures
        // Create users

        for ($i = 1; $i <= 10; $i++) {
            $user = new User();

            // add skills 
            $user->addSkill($userSkills[rand(0, count($userSkills) - 1)]);
            $user->addSkill($userSkills[rand(0, count($userSkills) - 1)]);
            $user->addSkill($userSkills[rand(0, count($userSkills) - 1)]);

            $user->setEmail('admin'. $i .'@gmail.com');
            $user->setRoles(['ROLE_ADMIN']);
            $user->setPassword($this->hasher->hashPassword($user, '12345678'));
            $user->setName('name');
            $user->setSurname('admin');
            $user->setGrade(2);
            $user->setGit('AdminGit');
            $user->setIsAsso(false);
            $user->setPicture('https://imgs.search.brave.com/EIdR8VhIG5QkCDwoJ6lkYLXtebBigMcrhvc0OXh7Ze0/rs:fit:800:800:1/g:ce/aHR0cHM6Ly9tYXBo/b3RvcG9ydHJhaXQu/ZnIvOTE5LXRoaWNr/Ym94X2RlZmF1bHQv/cGhvdG8tcmV1c3Np/ZS1kZS1wcm9maWwt/bGlua2VkaW4uanBn');

            $manager->persist($user);
        }
        $manager->flush();
        
        $technos = [
            // skills natif 
            'HTML',
            'CSS',
            'JavaScript',
            'PHP',
            'python',
            'C',
            'C++',
            'C#',
            'Java',
            'Ruby',

            // skills framowrk 
            'laravel',
            'Symfony',
            'Vue',
            'React',
            'Three.js',
            'Node.js',
            'Express',
            'Angular',
            'Django',
            'Flask',
            'Drupal',
            'Wordpress',
            'Ruby on Rails',
            'CodeIgniter',
            'Nuxt.js',
            'Lumen',

            // Skills db 
            'MongoDB',
            'MySQL',
            'SQLite',
            'PostgreSQL',
            'SQL',
            'MariaDB',
            'Firebase',
            'Firestore',
            'Firebase Auth',
            'Firebase Storage',
            'Firebase Realtime Database',
            'Firebase Cloud Functions',
            'Firebase Hosting',

            // web 3.0
            'Solidity',
            'Ethereum',
            'Truffle',

            // Skills git
            'Git',
            'Linux',
            'Docker',
            'GitHub',
            'GitLab',
            'GitLab CI',
            'GitLab Runner',
        ];

        foreach ($technos as $techno) {
            $tech = new Technos();
            $tech->setLabel($techno);
            $manager->persist($tech);
        }
        $manager->flush();

        $techp = $manager->getRepository(Technos::class)->findAll();
        $users = $manager->getRepository(User::class)->findAll();
        
        for ($i = 1; $i <= 10; $i++) {
            $project = new Project();
            $project->setTitle('Project n\'' . $i);
            $project->setPicture('https://via.placeholder.com/350x150');
            $project->addTechno($techp[rand(0, count($techp) - 1)]);
            $project->setUrlGit(rand(0, 1) == 0 ? 'https://github.com/GrandEmpereur/ArchiveDW' : null);
            $project->setUrlVideo(rand(0, 1) == 0 ? 'https://youtu.be/AEqX50wJjYg' : null);
            $project->setDescription('Description n\'' . $i);
            $project->setUserId($users[rand(0, count($users) - 1)]);
            $manager->persist($project);
        }
        $manager->flush();
        
        for ($i = 1; $i <= 10; $i++) {
            $news = new News();
            $news->setTitle('News n\''. $i);
            $news->setDescription('NewsDescription n\''. $i);
            $news->setPicture(rand(0, 1) == 0 ? 'https://via.placeholder.com/350x150' : null);
            $news->setUrl(rand(0, 1) == 0 ? 'https://www.google.fr/' : null);
            $manager->persist($news);
        }
        $manager->flush();
        
        $project = $manager->getRepository(Project::class)->findAll();
        
        for ($i = 1; $i <= 10; $i++) {
            $comment = new Comments();
            $comment->setDescription('Description n\'' . $i);
            $comment->setName('Name n\'' . $i);
            $comment->setProjectId($project[rand(0, count($project) - 1)]);
            $manager->persist($comment);
        }

        $manager->flush();
    }
}
