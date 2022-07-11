<?php

namespace Modules\Management\Repositories\Cache;

use Modules\Management\Repositories\ManagementRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheManagementDecorator extends BaseCacheDecorator implements ManagementRepository
{
    public function __construct(ManagementRepository $management)
    {
        parent::__construct();
        $this->entityName = 'management.management';
        $this->repository = $management;
    }
}
