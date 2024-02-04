@extends('admin_end.include.master_dash')
@section('dash_page_title')
    {{ __('messages.warranty_management') }}
@endsection
@section('dash_main_content')
    <div class="container-fluid">

        <livewire:admin.create-product.create-product-warranty :product="$product"/>

    </div>
@endsection
