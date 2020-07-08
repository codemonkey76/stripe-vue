<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create()
    {
        $data['types'] = ['CA' => 'Cash', 'DB' => 'Direct Debit', 'CC' => 'Credit Card', 'DT' => 'Direct Transfer'];

        return view('admin.payments.create', $data);
    }

    public function store()
    {

        return dd(request()->all());

    }
}
