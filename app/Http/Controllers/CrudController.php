<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\QueryString;

class CrudController extends AppController
{
    protected $repository;
    protected $with = null;

    protected function getQueryParams(Request $request)
    {
        extract(
            $request->only(
                ['search', 'direction', 'active', 'pageIndex', 'pageSize']
            )
        );
        return new QueryString(
            $search ?? null,
            $direction ?? null,
            $active ?? null,
            $pageIndex ?? null,
            $pageSize ?? null
        );
    }

    public function index(Request $request)
    {
        $params = $this->getQueryParams($request);
        $items = $this->repository->findAll($params, $this->with);
        return response()->json($items);
    }

    public function view($id)
    {
        $item = $this->repository->get($id);
        return response()->json($item);
    }

    public function add(Request $request)
    {
        $item = $this->repository->create($request->all());
        return response()->json($item);
    }

    public function edit(Request $request, $id)
    {
        $item = $this->repository->update($id, $request->all());
        return response()->json($item);
    }

    public function delete($id)
    {
        $success = $this->repository->delete($id);
        return response()->json($success);
    }
}
