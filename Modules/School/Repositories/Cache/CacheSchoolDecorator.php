<?php

namespace Modules\School\Repositories\Cache;

use Modules\School\Repositories\SchoolRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheSchoolDecorator extends BaseCacheDecorator implements SchoolRepository
{
    public function __construct(SchoolRepository $school)
    {
        parent::__construct();
        $this->entityName = 'school.schools';
        $this->repository = $school;
    }
}
