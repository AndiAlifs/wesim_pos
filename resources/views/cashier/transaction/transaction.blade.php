@extends('cashier.master')

@section('content')

    {{-- include transaction list --}}
    @include('cashier.transaction.list')

    {{-- include detail transaction --}}
    @include('cashier.transaction.detail')

@endsection

@section('style')

    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('assets/cashier/css/transactiondetail.css') }}">

@endsection

@section('script')

    <!-- script -->
    <script src="{{ asset('/assets/cashier/js/helper.js') }}"></script>
    <script src="{{ asset('/assets/cashier/js/transactiondetail.js') }}"></script>

@endsection
