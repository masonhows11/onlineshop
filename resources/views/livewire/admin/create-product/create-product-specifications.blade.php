<div>
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.create.specifications.product',$product->title_persian) }}
    @endsection
    <div class="container-fluid product-meta-section">

        <div class="row  my-3">
            <div class="col-sm-6  title-product">
                <div class="alert bg-white text-center">
                    {{ __('messages.product_manage_specifications') }}
                </div>
            </div>
            <div class="col-sm-6  title-product">
                <div class="alert bg-white text-center">
                    {{ $product->title_persian }}
                </div>
            </div>
        </div>

        <div class="row  my-3 d-flex ">

            <div class="col  bg-white">

                <form wire:submit.prevent="save">

                    <div class="row product-attribute-product-form">

                        <div class="col-sm-4">
                            <div class="mt-3 mb-3">
                                <label for="name" class="form-label">{{ __('messages.name') }}</label>
                                <select class="form-control" wire:change="changeAttribute" wire:model.defer="name"
                                        id="name">
                                    <option value="0">انتخاب کنید</option>
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
                            <div class="mt-3 mb-3">
                                <label for="value"
                                       class="form-label">{{ __('messages.product_property_value') }}</label>
                                @if( $name != null)
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
                                        <select class="form-control" wire:model.defer="value" id="value" multiple>
                                            @foreach($attributeDefaultValues as $value)
                                                <option value="{{ $value->id }}">{{ $value->value }}</option>
                                            @endforeach
                                        </select>
                                        @break
                                        @case('text_box')
                                        <input type="text" class="form-control"
                                                  placeholder="متن خود را وارد کنید.."
                                                  wire:model.defer="value" id="value">
                                        @break
                                        @case('text_area')
                                        <textarea class="form-control"
                                                  placeholder="متن خود را وارد کنید.."
                                                   wire:model.defer="value"
                                                    rows="5" cols="10" id="value">

                                        </textarea>
                                        @break
                                    @endswitch
                                @else
                                    <input type="text" class="form-control" id="value" wire:model.defer="value">
                                @endif

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
                            <a href="{{ route('admin.product.create.images',['product'=>$product->id]) }}"
                               class="btn btn-primary btn-sm">{{ __('messages.product_images') }}</a>
                        </div>
                        <div class="col-sm-6 d-flex justify-content-end">
                            <a href="{{ route('admin.product.index') }}"
                               class="btn btn-secondary btn-sm">{{ __('messages.product_list') }}</a>
                        </div>
                    </div>

                </form>
            </div>

        </div>


        <div class="row  my-3 product-meta-list bg-white overflow-auto">
            <div class="col">

                <table class="table">
                    <thead>
                    <tr class="text-center">
                        <th>{{ __('messages.id') }}</th>
                        <th>{{ __('messages.product_name') }}</th>
                        <th>{{ __('messages.priority') }}</th>
                        <th>{{ __('messages.specification_name') }}</th>
                        <th>{{ __('messages.specification_value') }}</th>
                        <th>{{ __('messages.edit_model') }}</th>
                        <th>{{ __('messages.delete_model') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($attribute_product as $item)
                        <tr class="text-center">
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->product->title_persian }}</td>
                            <td>{{ $item->priority }}</td>
                            <td>{{ $item->attribute->name }}</td>
                            @switch($item->type)
                                @case('select')
                                <td>{{ json_decode($item->values)->value }}</td>
                                @break
                                @case('multi_select')
                                @foreach(json_decode($item->values,true) as $value)
                                    @php $result[] = $value['value'] @endphp
                                @endforeach
                                <td>{{ $result = implode(" - ",$result) }}</td>
                                @break
                                @case('text_box')
                                <td>{{ json_decode($item->values)->value }}</td>
                                @break
                                @case('text_area')
                                <td>{{ json_decode($item->values)->value}}</td>
                                @break
                            @endswitch
                            <td>
                                <a class="mt-3" href="{{ route('admin.product.edit.specifications',['attribute_product_id' => $item->id,'product_id'=>$item->product_id])}}">
                                    <i class="mt-3 fa fa-edit"></i>
                                </a>
                            </td>
                            <td>
                                <a class="mt-3" href="javascript:void(0)" wire:click.prevent="deleteConfirmation({{ $item->id }})">
                                    <i class="mt-3 fa fa-trash"></i>
                                </a>
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
    {{-- <script type="javascript" src="{{ asset('admin_assets/plugins/select2/js/select2.min.js') }}"></script>
     <script>
         $(document).ready(function () {
             $('#value_select').select2();
             $('#value_select').on('change', function (e) {
                 var data = $('#value_select').select2("val");
             @this.set('value', data);
             });
         });
     </script>--}}
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
