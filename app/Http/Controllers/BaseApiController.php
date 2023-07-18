<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class BaseApiController extends Controller
{
    protected $model;
    

    public function index(Request $request)
    {
        $model = $this->getModelInstance();
        $query = $this->model::query();

        

        // Sorting
        if ($request->has('$sort')) {
            $sortParams = $request->input('$sort');
            foreach ($sortParams as $field => $order) {
                if ($order == 1) {
                    $query->orderBy($field, 'asc');
                } elseif ($order == -1) {
                    $query->orderBy($field, 'desc');
                }
            }
        }


        $queryString = $request->getQueryString();
        $queryParams = explode('&', $queryString);
         
        foreach ($queryParams as $param) {
            // Separate field and value
            $paramParts = explode('=', $param);
            if (count($paramParts) >= 2) {
            $field = urldecode($paramParts[0]);
            $value = urldecode($paramParts[1]);

            // Check if the field contains an operator
            if (strpos($field, '[') !== false) {
                $fieldParts = explode('[', $field);
                $field = $fieldParts[0];
                $operator = rtrim($fieldParts[1], ']');

                // Apply the operator to the query
                switch ($operator) {
                    case '$like':
                        $value = '%' . $value . '%';
                        $query->where($field, 'LIKE', $value);
                        break;
                    case '$lt':
                        $query->where($field, '<', $value);
                        break;
                    case '$lte':
                        $query->where($field, '<=', $value);
                        break;
                    case '$gt':
                        $query->where($field, '>', $value);
                        break;
                    case '$gte':
                        $query->where($field, '>=', $value);
                        break;
                    case '$in':
                        $values = explode(',', $value);
                        $query->whereIn($field, $values);
                        break;
                    case '$nin':
                        $values = explode(',', $value);
                        $query->whereNotIn($field, $values);
                        break;
                    default:
                        // Handle other operators or invalid operators
                        break;
                }
            } else {
                // Filter by equality
                if(!in_array($field, ['$limit','$skip','$sort'] )){
                    $query->where($field, $value);
                    }
            }
            }
        }

        $limit = $request->input('$limit', 10);
        $skip = $request->input('$skip', 0);

        $total = $query->count();
        $data =  $query->offset($skip)->limit($limit)->get();

        return response()->json([
            'total' => $total,
            'limit' => $limit,
            'skip' => $skip,
            'data' => $data,
        ]);
    }

    public function create()
    {
        // Not applicable for API, return appropriate response or error code
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->getValidationRules());

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $record = $this->model::create($request->all());
        return response()->json($record, 201);
    }

    public function show($id)
    {
        $data = $this->model::findOrFail($id);
        return response()->json($data);
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), $this->getValidationRules($id));

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $record = $this->model::findOrFail($id);
        $record->update($request->all());

        return response()->json($record);
    }

    public function destroy($id)
    {
        $record = $this->model::findOrFail($id);
        $record->delete();

        return response()->json(null, 204);
    }


     protected function getModelInstance()
    {
        if (!empty($this->modelName)) {
            return app($this->modelName);
        }
        
        // Handle the case when the model name is not set or is empty
        // You can return an appropriate response or throw an exception
    }

    protected function getValidationRules($id = null)
    {
        return [];
    }
}
