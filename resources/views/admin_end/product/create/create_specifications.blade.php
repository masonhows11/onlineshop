@extends('admin_end.include.master_dash')
@section('dash_page_title')
    {{ __('messages.product_manage_specifications') }}
@endsection
@section('dash_main_content')
    <div class="container-fluid">

        <livewire:admin.create-product.create-product-specifications :product="$product"/>

    </div>
@endsection
