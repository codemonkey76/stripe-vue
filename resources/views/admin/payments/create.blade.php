@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-10">
            <payment-form :types="{{ json_encode($types) }}" :stripe-key="{{ json_encode(env('STRIPE_PUB_KEY')) }}"></payment-form>
        </div>
    </div>
@endsection
