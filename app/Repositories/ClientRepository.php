<?php

namespace App\Repositories;

use App\Models\Client;
use App\Models\Budget;
use Illuminate\Support\Facades\DB;

class ClientRepository extends CrudRepository
{
    protected $model;
    protected $searchFields = ['name', 'document', 'email', 'phone'];

    public function __construct()
    {
        $this->model = new Client();
    }

    protected function sanitize(&$data)
    {
        $data['document'] = preg_replace('/\D/', '', $data['document']);
        $data['phone'] = preg_replace('/\D/', '', $data['phone']);
    }
}
