<?php

namespace Modules\Major\Repositories\Cache;

use Modules\Major\Repositories\MajorRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheMajorDecorator extends BaseCacheDecorator implements MajorRepository
{
    public function __construct(MajorRepository $major)
    {
        parent::__construct();
        $this->entityName = 'major.majors';
        $this->repository = $major;
    }
}
