@extends('admin_end.include.master_dash')
@section('dash_page_title')
    {{ __('messages.product_manage_specifications') }}
@endsection
@section('dash_main_content')
    <div class="container-fluid">

        <livewire:admin.create-product.edit-product-specifications :product_id="$product_id" :attribute_product_id="$attribute_product_id" />

    </div>
@endsection
