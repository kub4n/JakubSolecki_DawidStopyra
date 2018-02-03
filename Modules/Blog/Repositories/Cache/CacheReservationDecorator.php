<?php

namespace Modules\Blog\Repositories\Cache;

use Modules\Blog\Repositories\ReservationRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheReservationDecorator extends BaseCacheDecorator implements ReservationRepository
{
    public function __construct(ReservationRepository $reservation)
    {
        parent::__construct();
        $this->entityName = 'blog.reservations';
        $this->repository = $reservation;
    }
}
