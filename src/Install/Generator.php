<?php

declare(strict_types=1);

namespace UpgradeWithDecimalField\Install;

use Doctrine\ORM\EntityManagerInterface;
use UpgradeWithDecimalField\Entity\PaTest;
use UpgradeWithDecimalField\Repository\PaTestRepository;

class Generator
{
    /**
     * @var PaTestRepository
     */
    private $testRepository;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @param PaTestRepository $testRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        PaTestRepository $testRepository,
        EntityManagerInterface $entityManager
    ) {
        $this->testRepository = $testRepository;
        $this->entityManager = $entityManager;
    }

    public function generateTests()
    {
        $this->removeAllTests();
        $this->insertTests();
    }

    private function removeAllTests()
    {
        $tests = $this->testRepository->findAll();
        foreach ($tests as $test) {
            $this->entityManager->remove($test);
        }
        $this->entityManager->flush();
    }

    private function insertTests()
    {
        $testsDataFile = __DIR__ . '/../../resources/data/quotes.json';
        $testsData = json_decode(file_get_contents($testsDataFile), true);
        foreach ($testsData as $testData) {
            $test = new PaTest();
            $test->setName($testData['name']);
            $test->setPrice((float)$testData['price']);
            $this->entityManager->persist($test);
        }

        $this->entityManager->flush();
    }
}