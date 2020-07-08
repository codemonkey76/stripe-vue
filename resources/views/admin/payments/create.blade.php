@extends('layouts.app')
@section('content')
{{--    <b-form-datepicker id="date" v-model="date" class="mb-2"></b-form-datepicker>--}}
    <div class="row justify-content-center">
        <div class="col-10">
            <payment-form :types="{{ json_encode($types) }}" :stripe-key="{{ json_encode(env('STRIPE_PUB_KEY')) }}"></payment-form>
        </div>
    </div>
@endsection
