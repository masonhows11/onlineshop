<div>
    @section('breadcrumb')
        {{--        {{ Breadcrumbs::render('admin.create.specifications.product',$product->title_persian) }}--}}
    @endsection
    <div class="container-fluid product-meta-section">

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
                    {{ $attr_name->name }}
                </div>
            </div>
        </div>

        <div class="row  my-3 d-flex flex-column ">

            <div class="col  bg-white">

                <form wire:submit.prevent="save">

                    <div class="row mb-2 product-attribute-product-form">


                        <div class="col-sm-4">
                            <div class="mt-3 mb-3">
                                <label for="priority" class="form-label">{{ __('messages.priority') }}</label>
                                <input type="number" min="1" max="999" class="form-control" id="priority"
                                       wire:model.defer="priority">
                                @error('priority')
                                <div class="alert alert-danger mt-3">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="mt-3 mb-3" wire:ignore>
                                <label for="value" class="form-label">{{ __('messages.product_property_value') }}</label>
                                @switch($selectedAttributeType)
                                    @case('select')
                                    <select class="form-control" wire:model.defer="value" id="value">
                                        <option>انتخاب کنید...</option>
                                        @foreach($attributeDefaultValues as $value)
                                            <option value="{{ $value->id }}">{{ $value->value }}</option>
                                        @endforeach
                                    </select>
                                    @break
                                    @case('multi_select')
                                    <select class="form-control form-select" id="attrIds" wire:model.defer="value" multiple>
                                        @foreach($attributeDefaultValues as $value)
                                            <option value="{{ $value->id }}">{{ $value->value }}</option>
                                        @endforeach
                                    </select>
                                    @break
                                    @case('text_box')
                                    <input type="text" class="form-control" id="value" wire:model.defer="value">
                                    @break
                                    @case('text_area')
                                    <textarea class="form-control" wire:model.defer="value" id="value" rows="5"
                                              cols="10">
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
                            <button type="submit" id="add_attribute" class="btn btn-success btn-sm">{{ __('messages.save') }}</button>
                            <a href="{{ route('admin.product.create.images',['product'=> $product->id]) }}"
                               class="btn btn-primary btn-sm">{{ __('messages.product_images') }}</a>
                            <a href="{{ route('admin.product.specifications.index',['product' => $product->id]) }}"
                               class="btn btn-primary btn-sm">{{ __('messages.return_product_specification_list') }}</a>
                        </div>
                        <div class="col-sm-6 d-flex justify-content-end">
                            <a href="{{ route('admin.product.index') }}" class="btn btn-secondary btn-sm">{{ __('messages.product_list') }}</a>
                        </div>
                    </div>

                </form>

            </div>

        </div>

    </div>
</div>
@push('dash_custom_script')
    <script>
        $(document).ready(() => {
            $('.form-select').select2({
                dir: "rtl"
            })
            $('.form-select').on('change', function (e) {
                //// store id in data with
                let data = $(this).val();
                //// set data int to attr_ids public property
                @this.set('value', data);
                console.log(data);
            });
        });
    </script>
@endpush
