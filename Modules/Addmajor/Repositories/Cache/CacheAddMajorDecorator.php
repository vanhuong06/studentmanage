<?php

namespace Modules\Addmajor\Repositories\Cache;

use Modules\Addmajor\Repositories\AddMajorRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheAddMajorDecorator extends BaseCacheDecorator implements AddMajorRepository
{
    public function __construct(AddMajorRepository $addmajor)
    {
        parent::__construct();
        $this->entityName = 'addmajor.addmajors';
        $this->repository = $addmajor;
    }
}
