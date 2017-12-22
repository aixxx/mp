<?php

namespace App\Observers;

use App\Services\Event as EventService;
use App\Models\Event;

/**
 * Event模型观察者.
 *
 * @author rongyouyuan <rongyouyuan@163.com>
 */
class EventObserver
{
    /**
     * eventService.
     *
     * @var App\Services\Event
     */
    private $eventService;

    /**
     * construct.
     *
     * @param EventService $eventService EventService
     */
    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function creating()
    {
        # code...
    }

    public function saving(Event $event)
    {
        if (!$event->key) {
            $event->key = $this->eventService->makeEventKey();
        }
    }

    public function created()
    {
        # code...
    }
}
