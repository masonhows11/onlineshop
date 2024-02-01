<div>
    @section('dash_page_title')
        {{ __('messages.category_attribute_value') }}
    @endsection
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.create.category.attribute.value',$categoryAttribute->title) }}
    @endsection
    <div class="container-fluid category-attribute-section">

        <div class="row">
            <div class="col">
                <div class="alert bg-white text-center">
                  <h3>  {{ __('messages.attribute') }}‌ : {{ $categoryAttribute->title }}</h3>
                </div>
            </div>
        </div>

        <div class="row bg-white rounded create-category-attribute-value-form ">
                <form wire:submit.prevent="save">

                    <div class="col">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="mt-3 mb-3">
                                    <label for="product_id" class="form-label">{{ __('messages.select_product') }}</label>
                                    <select class="form-select" id="product_id" wire:model.defer="product_id">
                                        <option selected>{{ __('messages.choose') }}</option>
                                        @foreach($categoryAttribute->category->products as $product)
                                            <option value="{{ $product->id }}">{{ $product->title_persian }}</option>
                                        @endforeach
                                    </select>
                                    @error('product_id')
                                    <div class="alert alert-danger mt-3">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="mt-3 mb-3">
                                    <label for="value" class="form-label">{{ __('messages.value') }}</label>
                                    <input type="text" class="form-control" id="value" wire:model.defer="value">
                                    @error('value')
                                    <div class="alert alert-danger mt-3">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="mt-3 mb-3">
                                    <label for="price_increase" class="form-label">{{ __('messages.price_increase') }}</label>
                                    <input type="text" class="form-control" value="0" id="price_increase" wire:model.defer="price_increase">
                                    @error('price_increase')
                                    <div class="alert alert-danger mt-3">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="mt-3 mb-3">
                                    <label for="type" class="form-label">{{ __('messages.type') }}</label>
                                    <select class="form-select" id="type" wire:model.defer="type">
                                        <option>{{ __('messages.choose') }}</option>
                                        <option value="0">ساده</option>
                                        <option value="1">انتخابی</option>
                                    </select>
                                    @error('type')
                                    <div class="alert alert-danger mt-3">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3 mt-3 d-flex justify-content-between">
                                    <button type="submit" id="add_attribute"
                                            class="btn btn-success btn-sm">{{ __('messages.save') }}</button>
                                    <a class="btn btn-secondary btn-sm" href="{{ route('admin.category.attribute.index') }}">لیست
                                        ویژگی ها</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
        </div>


        <div class="row category-attribute-value-list mt-5 bg-white overflow-auto">
            <div class="my-5">
                <table class="table table-striped">
                    <thead class="border-bottom-3 border-top-3">
                    <tr class="text-center">
                        <th class="model-field">{{ __('messages.id') }}</th>
                        <th>نام ویژگی</th>
                        <th>نام محصول</th>
                        <th>مقدار</th>
                        <th class="model-field">افزایش قیمت</th>
                        <th class="model-field">نوع</th>
                        <th>{{ __('messages.operation') }}</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categoryAttribute->values as $value)
                        <tr class="text-center">
                            <td class="model-field">{{ $value->id }}</td>
                            <td>{{ $categoryAttribute->title }}</td>
                            <td>{{ $value->product->title_persian }}</td>
                            <td>{{ $value->value }}</td>
                            <td class="model-field">{{ number_format(floatval($value->price_increase)) }}</td>
                            <td class="model-field">{{ $value->type == 0 ? __('messages.simple') : __('messages.select') }}</td>
                            <td>
                                <a class="mt-3" href="javascript:void(0)" wire:click.edit="edit({{$value->id}})"><i class="mt-3 fa fa-edit"></i></a>
                                <a class="mt-3" href="javascript:void(0)" wire:click.prevent="deleteConfirmation({{ $value->id }})"><i class="mt-3 fa fa-trash"></i></a>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
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
