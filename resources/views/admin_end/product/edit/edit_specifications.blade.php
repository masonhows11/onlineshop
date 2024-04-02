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
            <div class="col-sm-4  title-product">
                <div class="alert bg-white text-center">
                    {{ __('messages.product_manage_specifications_edit') }}
                </div>
            </div>
            <div class="col-sm-4 title-product">
                <div class="alert bg-white text-center">
                    {{ $product->title_persian }}
                </div>
            </div>
            <div class="col-sm-4  title-product">
                <div class="alert bg-white text-center">
                    {{ $attribute_name->name }}
                </div>
            </div>
        </div>

        <div class="row  my-3 d-flex">

            <div class="col  bg-white">

                <form action="{{ route('admin.product.update.specifications',['product_id' => $product_id,'attribute_product_id' => $attribute_product_id]) }}" method="post">
                    @csrf
                    <div class="row mb-2 product-attribute-product-form">

                        <input type="hidden" name="attribute_id" value="{{ $attribute_id }}">

                        <div class="col-sm-4">
                            <div class="mt-3 mb-3">
                                <label for="priority" class="form-label">{{ __('messages.priority') }}</label>
                                <input type="number" value="{{ $priority }}" min="1" max="999" class="form-control" id="priority" name="priority">
                                @error('priority')
                                <div class="alert alert-danger mt-3">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="mt-3 mb-3">
                                <label for="value" class="form-label">{{ __('messages.product_property_value') }}</label>
                                @switch($selectedAttributeType)
                                    @case('select')
                                    <input type="hidden" class="form-control" id="value" name="type" value="select">
                                    <select class="form-control" name="value" id="value">
                                        <option value="">انتخاب کنید...</option>
                                        @foreach($attributeDefaultValues as $item)
                                            <option {{ in_array($item->id,array($value)) ? 'selected' :'' }} value="{{ $item->id }}">{{ $item->value }}</option>
                                        @endforeach
                                    </select>
                                    @break
                                    @case('multi_select')
                                    <input type="hidden" class="form-control" id="value" name="type" value="multi_select">
                                    <select class="form-control form-select" id="attrIds" name="value[]" multiple>
                                        @foreach($attributeDefaultValues as $item)
                                            <option {{ in_array($item->id,array_values($value)) ? 'selected' :'' }} value="{{ $item->id }}">{{ $item->value }}</option>
                                        @endforeach
                                    </select>
                                    @break
                                    @case('text_box')
                                    <input type="hidden" class="form-control" id="value" name="type" value="text_box">
                                    <input type="text" class="form-control" id="value" name="value" value="{{ $value }}">
                                    @break
                                    @case('text_area')
                                    <input type="hidden" class="form-control" id="value" name="type" value="text_area">
                                    <textarea class="form-control" name="value" id="value" rows="5" cols="10">
                                        {{ $value }}
                                    </textarea>
                                    @break
                                @endswitch
                                @error('value')
                                <div class="alert alert-danger mt-3">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="row my-4">
                        <div class="col-sm-6">
                            <button type="submit" id="add_attribute"
                                    class="btn btn-success btn-sm">{{ __('messages.save') }}</button>
                            <a href="{{ route('admin.product.create.images',['product'=> $product_id]) }}"
                               class="btn btn-primary btn-sm">{{ __('messages.product_images') }}</a>
                            <a href="{{ route('admin.product.specifications.index',['product' => $product_id]) }}"
                               class="btn btn-primary btn-sm">{{ __('messages.return_product_specification_list') }}</a>
                        </div>
                        <div class="col-sm-6 d-flex justify-content-end">
                            <a href="{{ route('admin.product.index') }}"
                               class="btn btn-secondary btn-sm">{{ __('messages.product_list') }}</a>
                        </div>
                    </div>

                </form>

            </div>

        </div>


    </div>
@endsection
@push('dash_custom_script')
    <script>
        $(document).ready(() => {
            $('.form-select').select2({
                dir: 'ltr',
                tags: 'true',
            })
        });
    </script>
@endpush

