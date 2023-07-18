<?php
namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends BaseApiController


{
    protected $model = Transaction::class;

    protected function getValidationRules($id = null)
    {
        return [
                                                                                                                                                                                                                                                                                                                                            
            //'description' => 'required|email|unique:transaction',
           // 'email' => ['required', 'email', Rule::unique('transaction')->ignore($id)],
        ];
    }

    public function index(Request $request)
    {
        return parent::index($request);
    }

    public function store(Request $request)
    {
        return parent::store($request);
    }

    public function show($id)
    {
        return parent::show($id);
    }

    public function update(Request $request, $id)
    {
        return parent::update($request, $id);
    }

    public function destroy($id)
    {
        return parent::destroy($id);
    }

    public function edit($id)
    {
        return parent::destroy($id);
    }
}