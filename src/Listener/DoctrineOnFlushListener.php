<?php

declare(strict_types=1);

namespace App\Listener;

use App\Entity\Book;
use App\Entity\PriceHistory;
use Doctrine\ORM\Event\OnFlushEventArgs;
use function is_null;

class DoctrineOnFlushListener implements OnFlushLifecycleListenerInterface
{
    public function onFlush(OnFlushEventArgs $event)
    {
        $entityManager = $event->getEntityManager();
        $unitOfWork    = $entityManager->getUnitOfWork();

        foreach ($unitOfWork->getScheduledEntityUpdates() as $entity) {
            if ($entity instanceof Book && !is_null($entity->getOldPrice())) {
                $entry = new PriceHistory();
                $entry
                    ->setPrice($entity->getOldPrice())
                    ->setBookIdentifier($entity->getId());

                $event->getEntityManager()->persist($entry);
                $unitOfWork->computeChangeSet($entityManager->getClassMetadata(PriceHistory::class), $entry);
            }
        }
    }
}
