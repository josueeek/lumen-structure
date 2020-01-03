<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;

use App\Models\QueryString;

class CrudRepository extends BaseRepository
{
    protected $model;
    protected $searchFields = [];

    public function findAll(QueryString $params = null, $with = null)
    {
        $query = $this->model
            ->where('saas_business_id', Auth::user()->saas_business_id);

        if ($params) {
            if ($params->search) {
                $fields = $this->searchFields;
                $search = '%' . $params->search . '%';
                $query->where(
                    function ($qry) use ($fields, $search) {
                        foreach ($fields as $field) {
                            if (strpos($field, '.') !== false) {
                                list($table, $field) = explode('.', $field, 2);
                                $qry->orWhereHas(
                                    $table,
                                    function ($q) use ($field, $search) {
                                        $q->where($field, 'like', $search);
                                    }
                                );
                            } else {
                                $qry->orWhere($field, 'like', $search);
                            }
                        }
                    }
                );
            }
            $params->active && $query->orderBy($params->active, $params->direction);
            $params->pageIndex && $query->offset($params->pageIndex);
            $params->pageSize && $query->limit($params->pageSize);
        }

        if ($with) {
            $query->with($with);
        }

        return $query->get();
    }

    public function get(int $id)
    {
        return $this->model
            ->where('saas_business_id', Auth::user()->saas_business_id)
            ->where('id', $id)
            ->firstOrFail();
    }

    public function create(array $data)
    {
        $this->sanitize($data);

        $entity = $this->model;
        $entity->fill($data);
        $entity->saas_business_id = Auth::user()->saas_business_id;
        return $entity->save() ? $entity : false;
    }

    public function update(int $id, array $data)
    {
        $this->sanitize($data);

        $entity = $this->get($id);
        return $entity
            ->update($data) ? $entity : false;
    }

    public function delete(int $id)
    {
        return $this->get($id)
            ->delete();
    }

    protected function sanitize(&$data)
    {
    }
}
