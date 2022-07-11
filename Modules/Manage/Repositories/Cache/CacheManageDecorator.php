<?php

namespace Modules\Manage\Repositories\Cache;

use Modules\Manage\Repositories\ManageRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheManageDecorator extends BaseCacheDecorator implements ManageRepository
{
    public function __construct(ManageRepository $manage)
    {
        parent::__construct();
        $this->entityName = 'manage.manages';
        $this->repository = $manage;
    }
}
