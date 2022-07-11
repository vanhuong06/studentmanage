<?php

namespace Modules\Timetable\Repositories\Cache;

use Modules\Timetable\Repositories\TimeTableRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheTimeTableDecorator extends BaseCacheDecorator implements TimeTableRepository
{
    public function __construct(TimeTableRepository $timetable)
    {
        parent::__construct();
        $this->entityName = 'timetable.timetables';
        $this->repository = $timetable;
    }
}
