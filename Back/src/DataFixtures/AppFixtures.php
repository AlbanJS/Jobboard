<?php

namespace App\DataFixtures;
use App\Entity\Applicant;
use App\Entity\Company;
use App\Service\KnpUIpsum;
use App\Entity\Annonce;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public $knpUIpsum;
    public function __construct(KnpUIpsum $knpUIpsum)
    {
        $this->knpUIpsum = $knpUIpsum;
    }


    public function load(ObjectManager $manager): void
    {
        $text = $this->knpUIpsum->getParagraphs(1);




        // Applicant
        for ($i = 1; $i < 5; $i++) {
            $userApplicant = new User();
            $applicant = new Applicant();
            $userApplicant->setEmail('applicant'.$i.'@gmail.com');
            $userApplicant->setPassword('$2y$13$JAUIMxoTkxAL..uGqj7c1OWbzx0j6JoCvDuOba5LI9OhB2iIA7eYm'); // 'admin'
            $userApplicant->setRoles(['ROLE_APPLICANT']);
            $applicant->setName('Name'.$i);
            $applicant->setUser($userApplicant);
            $manager->persist($userApplicant);
            $manager->persist($applicant);

        }


        // UserAdmin
        {
            $userAdmin = new User();
            $userAdmin->setEmail('admin@gmail.com');
            $userAdmin->setPassword('$2y$13$JAUIMxoTkxAL..uGqj7c1OWbzx0j6JoCvDuOba5LI9OhB2iIA7eYm'); // 'admin'
            $userAdmin->setRoles(['ROLE_ADMIN']);
            $manager->persist($userAdmin);

        }

        // Ads and company
        for ($i = 1; $i < 5; $i++) {
            $annonce = new Annonce();
            $company = new Company();
            $userCompagny = new User();
            $createdAt  = new \DateTimeImmutable();
            $userCompagny->setEmail('compagny'.$i.'@gmail.com');
            $userCompagny->setPassword('$2y$13$JAUIMxoTkxAL..uGqj7c1OWbzx0j6JoCvDuOba5LI9OhB2iIA7eYm'); // 'admin'
            $userCompagny->setRoles(['ROLE_COMPAGNY']);
            $company->setAdress($i.' Avenue Epitech');
            $company->setUser($userCompagny);
            $annonce->setTitle('Title'.$i);
            $annonce->setDescription('Cool Description'.$i);
            $annonce->setCreatedAt($createdAt);
            $annonce->setSummary($text);
            $annonce->setCompany($company->setName('Name'.$i));
            $annonce->setWage(mt_rand(800, 1900));
            $annonce->setContrat('Cdi'.$i);
            $manager->persist($annonce);
            $manager->persist($company);
            $manager->persist($userCompagny);

        }

        $manager->flush();
    }
}
