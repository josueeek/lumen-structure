<?php

namespace App\Http\Controllers;

use App\Repositories\ClientRepository;

class ClientsController extends CrudController
{

    public function __construct()
    {
        $this->repository = new ClientRepository();
    }
}
