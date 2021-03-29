@extends('cashier.master')

@section('content')

    {{-- include hold window --}}
    @include('cashier.cashier.hold')

    {{-- include chart --}}
    @include('cashier.cashier.partials')

    {{-- include menu --}}
    @include('cashier.cashier.menu')

    {{-- include chart --}}
    @include('cashier.cashier.cart')

@endsection

@section('script')

    <!-- My Script -->
    <script src="{{ asset('/assets/cashier/js/helper.js') }}"></script>
    <script src="{{ asset('/assets/cashier/js/myjs.js') }}"></script>

@endsection
