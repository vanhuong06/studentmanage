<?php

namespace Modules\Management\Repositories\Cache;

use Modules\Management\Repositories\CategoryRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheCategoryDecorator extends BaseCacheDecorator implements CategoryRepository
{
    public function __construct(CategoryRepository $category)
    {
        parent::__construct();
        $this->entityName = 'management.categories';
        $this->repository = $category;
    }
}
