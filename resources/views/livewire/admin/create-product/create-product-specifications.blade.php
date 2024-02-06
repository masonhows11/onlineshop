<div>
    @section('breadcrumb')
       {{ Breadcrumbs::render('admin.create.specifications.product',$product->title_persian) }}
    @endsection
        <div class="container-fluid product-meta-section">

            <div class="row ms-2 my-3">
                <div class="col-sm-3  title-product">
                    <div class="alert bg-white text-center">
                        {{ __('messages.product_manage_specifications') }}
                    </div>
                </div>
                <div class="col-sm-3  title-product">
                    <div class="alert bg-white text-center">
                        {{ $product->title_persian }}
                    </div>
                </div>
            </div>

            <div class="row mx-2 my-3 d-flex flex-column ">

                <div class="col  bg-white">

                    <form wire:submit.prevent="save">

                        <div class="row product-meta-form">

                            <div class="col-sm-4">
                                <div class="mt-3 mb-3">
                                    <label for="name" class="form-label">{{ __('messages.name') }}</label>
                                    <select class="form-control" wire:change="changeAttribute" wire:model.defer="name" id="name">
                                        <option>انتخاب کنید</option>
                                        @foreach($attributes as $attribute)
                                            <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('name')
                                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="mt-3 mb-3">
                                    <label for="type" class="form-label">{{ __('messages.attribute_type') }}</label>
                                    <select class="form-control" wire:model.lazy="type" id="type" disabled>
                                        <option>انتخاب کنید</option>
                                        <option value="select">Select</option>
                                        <option value="multi_select">Multi_select</option>
                                        <option value="radio">Radio_button</option>
                                        <option value="text_box">Text</option>
                                        <option value="text_area">Text_area</option>
                                    </select>
                                    @error('type')
                                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="mt-3 mb-3">
                                    <label for="value" class="form-label">{{ __('messages.product_property_value') }}</label>
                                    @switch($selectedAttributeType)
                                        @case('select')
                                        <select class="form-control" wire:model.defer="value" id="type">
                                            <option>انتخاب کنید</option>
                                            <option value="select"></option>

                                        </select>
                                        @break
                                        @case('multi_select')
                                        <select class="form-control" wire:model.defer="value" id="type" multiple>
                                            <option>انتخاب کنید</option>
                                            <option value="select"></option>

                                        </select>
                                        @break
                                        @case('text_box')
                                        <input type="text" class="form-control" id="value" wire:model.defer="value">
                                        @break
                                        @case('text_area')
                                        <textarea class="form-control" wire:model.defer="value" id="value" rows="5" cols="10"></textarea>
                                        @break
                                        @default
                                        <input type="text" class="form-control" id="value" wire:model.defer="value">
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
                                <a href="{{ route('admin.product.create.images',['product'=>$product->id]) }}" class="btn btn-primary btn-sm">{{ __('messages.product_images') }}</a>
                            </div>
                            <div class="col-sm-6 d-flex justify-content-end">
                                <a href="{{ route('admin.product.index') }}" class="btn btn-secondary btn-sm">{{ __('messages.product_list') }}</a>
                            </div>
                        </div>

                    </form>

                </div>
            </div>


            <div class="row mx-2 my-3 product-meta-list bg-white">
                <div class="col">

                 {{--   <table class="table">
                        <thead>
                        <tr class="text-center">
                            <th>{{ __('messages.id') }}</th>
                            <th>{{ __('messages.product_meta_key') }}</th>
                            <th>{{ __('messages.product_meta_value') }}</th>
                            <th>{{ __('messages.edit_model') }}</th>
                            <th>{{ __('messages.delete_model') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($metas as $meta)
                            <tr class="text-center">
                                <td>{{ $meta->id }}</td>
                                <td>{{ $meta->meta_key }}</td>
                                <td>{{ $meta->meta_value }}</td>
                                <td><a class="mt-3" href="javascript:void(0)" wire:click.edit="edit({{$meta->id}})"><i class="mt-3 fa fa-edit"></i></a></td>
                                <td><a class="mt-3" href="javascript:void(0)" wire:click.prevent="deleteConfirmation({{ $meta->id }})"><i class="mt-3 fa fa-trash"></i></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>--}}

                </div>
            </div>




        </div>
</div>
@push('dash_custom_script')
    <script type="text/javascript">
        window.addEventListener('show-delete-confirmation', event => {
            Swal.fire({
                title: 'آیا مطمئن هستید این ایتم حذف شود؟',
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله حذف کن!',
                cancelButtonText: 'خیر',
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteConfirmed')
                }
            });
        })
    </script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            showCloseButton: true,
            timer: 5000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
        window.addEventListener('show-result', ({detail: {type, message}}) => {
            Toast.fire({
                icon: type,
                title: message
            })
        })
        @if(session()->has('warning'))
        Toast.fire({
            icon: 'warning',
            title: '{{ session()->get('warning') }}'
        })
        @elseif(session()->has('success'))
        Toast.fire({
            icon: 'success',
            title: '{{ session()->get('success') }}'
        })
        @endif
    </script>
@endpush
