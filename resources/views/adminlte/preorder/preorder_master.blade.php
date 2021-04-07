@extends('adminlte.master')

@section('content')
    @include('adminlte.preorder.preorder_top')
    <div class="row">
        @include('adminlte.preorder.preorder_menu')
        @include('adminlte.preorder.preorder_cart')
    </div>
@endsection

@section('style')
@endsection

@section('script')
@endsection
