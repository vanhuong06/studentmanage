<?php

namespace Modules\Task\Repositories\Cache;

use Modules\Task\Repositories\TaskRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheTaskDecorator extends BaseCacheDecorator implements TaskRepository
{
    public function __construct(TaskRepository $task)
    {
        parent::__construct();
        $this->entityName = 'task.tasks';
        $this->repository = $task;
    }
}
