<?php

declare(strict_types=1);

namespace App\Listener;

use App\Entity\Book;
use App\Entity\PriceHistory;
use Doctrine\ORM\Event\PreFlushEventArgs;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;

class BookListener implements EntityListenerInterface, LoggerAwareInterface
{
    use LoggerAwareTrait;

    public function prePersist(Book $book, LifecycleEventArgs $event)
    {
    }

    public function postPersist(Book $book, LifecycleEventArgs $event)
    {
    }

    public function preUpdate(Book $book, PreUpdateEventArgs $event) 
    {
    }

    public function postUpdate(Book $book, LifecycleEventArgs $event) 
    {
        if (is_null($book->getOldPrice())) {
            return;
        }

        $this->logger->debug(sprintf("Price changed from [%s] to [%s]", $book->getOldPrice(), $book->getPrice()));
    }

    public function postRemove(Book $book, LifecycleEventArgs $event) 
    {
    }

    public function preRemove(Book $book, LifecycleEventArgs $event) 
    {
    }

    public function preFlush(Book $book, PreFlushEventArgs $event) 
    {
    }

    public function postLoad(Book $book, LifecycleEventArgs $event) 
    {
    }
}
