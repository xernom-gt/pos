@extends('templates.layout')

@section('content')
<form id="order-form" method="POST" action="{{ url('order') }}">
    @csrf
    <div class="row">
        <div class="col-md-8">
            @include('order.form')
        </div>
        <div class="col-md-4">
            @include('order.cart')
        </div>
    </div>
</form>
@endsection

@push('scripts')
    @include('order.script')
@endpush