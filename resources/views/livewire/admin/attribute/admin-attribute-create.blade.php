<div>
    @section('dash_page_title')
        {{ __('messages.add_new_specification') }}
    @endsection
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.create.specifications',$category_name) }}
    @endsection
    <div class="container-fluid">

        <div class="row d-flex justify-content-start my-4 bg-white">
            <div class="col-lg-4 col-md-4 col  my-5  border-bottom title-add-to-stock">
                <div class="alert my-4">
                    <h3> {{ __('messages.add_new_specification') }} - {{ $category_name }}</h3>
                </div>
            </div>
        </div>

        <div class="row bg-white rounded create-color-form">
            <form wire:submit.prevent="save">
                <div class="col">
                    <div class="row">

                        <div class="col-sm-6">
                            <div class="mt-3 mb-3">
                                <label for="name" class="form-label">{{ __('messages.name') }}</label>
                                <input type="text" class="form-control" id="name"
                                       wire:model.defer="name">
                                @error('name')
                                <div class="alert alert-danger mt-3">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mt-3 mb-3">
                                <label for="priority" class="form-label">{{ __('messages.priority') }}</label>
                                <input type="number" min="1" max="999" class="form-control" id="priority" wire:model.defer="priority">
                                @error('priority')
                                <div class="alert alert-danger mt-3">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mt-3 mb-3">
                                <label for="type" class="form-label">{{ __('messages.attribute_type') }}</label>
                                <select class="form-control" wire:model.lazy="type" id="type">
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

                        <div class="col-sm-6">
                            <div class="mt-3 mb-3">
                                <label for="has_default_value"
                                       class="form-label">{{ __('messages.has_default_value') }}</label>
                                <select class="form-control" wire:model.lazy="has_default_value" id="has_default_value">
                                    <option>انتخاب کنید</option>
                                    <option value="1">{{ __('messages.has_default_value') }}</option>
                                    <option value="0">{{ __('messages.no_default_value') }}</option>
                                </select>
                                @error('has_default_value')
                                <div class="alert alert-danger mt-3">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                    </div>
                </div>
                <div class="mb-3 mt-3">
                    <button type="submit" id="add_attribute" class="btn btn-success ">{{ __('messages.save') }}</button>
                    <button type="reset" wire:click.reset="resetInput()" id="reset_attribute" class="btn btn-primary">{{ __('messages.reset_input') }}</button>
                    <a href="{{ route('admin.attribute.index') }}" class="btn btn-secondary">{{ __('messages.return') }}</a>
                </div>
            </form>
        </div>


        <div class="row  category-list bg-white overflow-auto">
            <div class="my-5">
                <table class="table table-striped table-responsive">
                    <thead class="border-bottom-3 border-top-3">
                    <tr class="text-center">
                        <th>{{ __('messages.id') }} </th>
                        <th>{{ __('messages.name')}}</th>
                        <th>{{ __('messages.type') }}</th>
                        <th>{{ __('messages.priority') }}</th>
                        <th>{{ __('messages.has_default_value') }}</th>
                        <th>{{ __('messages.edit_model')}}</th>
                        <th>{{ __('messages.delete_model')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($attributes as $attribute)
                        <tr class="text-center">
                            <td>{{ $attribute->id }}</td>
                            <td>{{ $attribute->name }}</td>
                            <td>{{ $attribute->type_value }}</td>
                            <td>{{ $attribute->priority }}</td>
                            <td>{{ $attribute->has_default_value == 1 ? __('messages.has_default_value') : __('messages.no_default_value') }}</td>
                            <td>
                                <a class="mt-3" href="javascript:void(0)" wire:click.edit="edit({{$attribute->id}})">
                                    <i class="mt-3 fa fa-edit"></i>
                                </a>
                            </td>
                            <td>
                                <a class="mt-3" href="javascript:void(0)"
                                   wire:click.prevent="deleteConfirmation({{ $attribute->id }})">
                                    <i class="mt-3 fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        {{--<div class="row d-flex justify-content-center bg-white my-4 ">
            <div class="col-lg-2 col-md-2 my-2 pt-2 pb-2 ">
                {{ $attributes->links() }}
            </div>
        </div>--}}

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
