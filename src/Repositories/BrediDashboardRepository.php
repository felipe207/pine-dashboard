<?php
namespace Brediweb\BrediDashboard8\Repositories;

use Brediweb\BrediDashboard8\Repositories\BaseRepository;

class BrediDashboardRepository extends BaseRepository
{
    protected $modelClass = \Brediweb\BrediDashboard8\Models\Config::class;

    public function getConfig()
    {
        return $this->modelClass::first();

    }

}