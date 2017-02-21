<?php

namespace Tenolo\Bundle\EntityBundle\Command;

use Doctrine\ORM\Mapping\ClassMetadata;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Tenolo\Bundle\CoreBundle\Component\DependencyInjection\Container\ContainerShortcuts;
use Tenolo\Bundle\EntityBundle\Entity\Interfaces\DNAInterface;

/**
 * Class ResetDnaCommand
 *
 * @package Tenolo\Bundle\EntityBundle\Command
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class ResetDnaCommand extends ContainerAwareCommand
{

    use ContainerShortcuts;

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
        /** @var ClassMetadata[] $metadatas */
        $metadatas = $this->getEntityManager()->getMetadataFactory()->getAllMetadata();
        foreach ($metadatas as $metadata) {
            $ref = $metadata->getReflectionClass();

            if ($ref->implementsInterface(DNAInterface::class) && !$ref->isAbstract()) {
                $repo = $this->getEntityManager()->getRepository($ref->getName());

                /** @var DNAInterface[] $entities */
                $entities = $repo->findAll();

                foreach ($entities as $entity) {
                    $entity->createDna();
                    $this->getEntityManager()->persist($entity);
                }

                $this->getEntityManager()->flush();
            }
        }

    }

}
