@extends('adminlte.master')

@section('content')

    {{ csrf_field() }}

    @include('adminlte.preorder.po_top')

    <div class="row">

        @include('adminlte.preorder.po_partials')
        @include('adminlte.preorder.po_menu')
        @include('adminlte.preorder.po_cart')

    </div>

@endsection

@section('style')

@endsection

@section('script')

    <script script src="{{ asset('/assets/preorder/js/helper-po.js') }}"></script>
    <script script src="{{ asset('/assets/preorder/js/myjs-po.js') }}"></script>

@endsection
