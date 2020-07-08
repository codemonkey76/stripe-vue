<?php

namespace App\Http\Controllers;

use App\PaymentType;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create()
    {
        $data['types'] = [
            new PaymentType('CA', 'CASH'),
            new PaymentType('DB', 'Direct Debit'),
            new PaymentType('CC', 'Credit Card'),
            new PaymentType('DT', 'Direct Transfer')
            ];

        return view('admin.payments.create', $data);
    }

    public function store()
    {

        return dd(request()->all());

    }
}
