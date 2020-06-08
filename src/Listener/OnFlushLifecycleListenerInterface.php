<?php

declare(strict_types=1);

namespace App\Listener;

use Doctrine\ORM\Event\OnFlushEventArgs;

interface OnFlushLifecycleListenerInterface
{
    public function onFlush(OnFlushEventArgs  $event);
}
