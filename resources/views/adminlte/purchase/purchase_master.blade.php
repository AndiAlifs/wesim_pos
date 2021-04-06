@extends('adminlte.master')

@section('content')
    @include('adminlte.purchase.purchase_top')
    <div class="row">
        @include('adminlte.purchase.purchase_menu')
        @include('adminlte.purchase.purchase_cart')
    </div>
@endsection

@section('style')
@endsection

@section('script')
@endsection
