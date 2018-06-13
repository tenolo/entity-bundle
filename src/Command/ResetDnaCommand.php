<?php

namespace Tenolo\Bundle\EntityBundle\Command;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Mapping\ClassMetadata;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Tenolo\Bundle\EntityBundle\Entity\Interfaces\DNAInterface;

/**
 * Class ResetDnaCommand
 *
 * @package Tenolo\Bundle\EntityBundle\Command
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class ResetDnaCommand extends Command
{

    /** @var ManagerRegistry */
    protected $registry;

    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct();

        $this->registry = $registry;
    }

    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->setName('tenolo:entity:reset-dna');
    }

    /**
     * @inheritDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->registry->getManager();

        /** @var ClassMetadata[] $metadatas */
        $metadatas = $em->getMetadataFactory()->getAllMetadata();
        foreach ($metadatas as $metadata) {
            $ref = $metadata->getReflectionClass();

            if ($ref->implementsInterface(DNAInterface::class) && !$ref->isAbstract()) {
                $repo = $em->getRepository($ref->getName());

                /** @var DNAInterface[] $entities */
                $entities = $repo->findAll();

                foreach ($entities as $entity) {
                    $entity->createDna();
                    $em->persist($entity);
                }

                $em->flush();
            }
        }

    }

}
