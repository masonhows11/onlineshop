@extends('admin_end.include.master_dash')
@section('dash_page_title')
    {{ __('messages.product_manage_specifications') }}
@endsection
@section('breadcrumb')
    {{--        {{ Breadcrumbs::render('admin.create.specifications.product',$product->title_persian) }}--}}
@endsection
@section('dash_main_content')
    <div class="container-fluid">

        <div class="row  my-3">
            <div class="col  title-product">
                <div class="alert bg-white text-center">
                    {{ __('messages.product_manage_specifications_edit') }}
                </div>
            </div>
            <div class="col title-product">
                <div class="alert bg-white text-center">
                    {{ $product->title_persian }}
                </div>
            </div>
            <div class="col  title-product">
                <div class="alert bg-white text-center">
                    {{ $attribute_name->name }}
                </div>
            </div>
        </div>

        <livewire:admin.create-product.edit-product-specifications :product_id="$product_id" :attribute_product_id="$attribute_product_id" />

    </div>
@endsection
