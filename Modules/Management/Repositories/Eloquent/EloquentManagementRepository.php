<?php

namespace Modules\Management\Repositories\Eloquent;

use Modules\Management\Repositories\ManagementRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentManagementRepository extends EloquentBaseRepository implements ManagementRepository
{
    public function all()
    {
        return parent::all(); // TODO: Change the autogenerated stub
    }

    public function find($id)
    {
        return parent::find($id); // TODO: Change the autogenerated stub
    }
}
