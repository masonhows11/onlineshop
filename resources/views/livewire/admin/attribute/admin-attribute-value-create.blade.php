<div>
    @section('dash_page_title')
        {{ __('messages.product_specifications_values') }}
    @endsection
    @section('breadcrumb')
         {{ Breadcrumbs::render('admin.create.specification.values',$category_name) }}
    @endsection
    <div class="container-fluid">

        <div class="row d-flex justify-content-start my-4 bg-white">
            <div class="col-lg-4 col-md-4 col  my-5  border-bottom title-add-to-stock">
                <div class="alert my-4">
                    <h3> {{ __('messages.product_specifications') }} - {{ $category_name }}
                        - {{ __('messages.add_new_specification_value') }}</h3>
                </div>
            </div>
        </div>

        <div class="row bg-white rounded create-color-form">
            <form wire:submit.prevent="save">
                <div class="col">
                    <div class="row">

                        <div class="col-sm-4">
                            <div class="mt-3 mb-3">
                                <label for="name" class="form-label">{{ __('messages.name') }}</label>
                                <select class="form-control" wire:model.lazy="name" id="name">
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
                                <label for="value" class="form-label">{{ __('messages.value') }}</label>
                                <input type="text" class="form-control" id="value" wire:model.defer="value">
                                @error('value')
                                <div class="alert alert-danger mt-3">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-4">
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



                    </div>
                </div>
                <div class="mb-3 mt-3">
                    <button type="submit" id="add_attribute" class="btn btn-success ">{{ __('messages.save') }}</button>
                    <button type="reset" wire:click.reset="resetInput()" id="reset_attribute" class="btn btn-primary">{{ __('messages.reset_input') }}</button>
                    <a href="{{ route('admin.attribute.value.index') }}" class="btn btn-secondary">{{ __('messages.return') }}</a>
                </div>
            </form>
        </div>

        <div class="row mt-4 category-list bg-white overflow-auto">
            <div class="accordion my-4" id="accordionExample">
                @foreach($attributes as $attribute)
                    <div class="accordion-item mt-5 border border-2">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne-{{ $attribute->id }}" aria-expanded="true"
                                    aria-controls="collapseOne">
                                {{ $attribute->name }}
                            </button>
                        </h2>
                        <div id="collapseOne-{{ $attribute->id }}" class="accordion-collapse collapse show"
                             aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <table class="table table-striped table-responsive">
                                    <thead class="border-bottom-3 border-top-3">
                                    <tr class="text-center">
                                        <th>{{ __('messages.id') }} </th>
                                        <th>{{ __('messages.value')}}</th>
                                        <th>{{ __('messages.priority') }}</th>
                                        <th>{{ __('messages.edit_model')}}</th>
                                        <th>{{ __('messages.delete_model')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($attribute->values as $attribute)
                                        <tr class="text-center">
                                            <td>{{ $attribute->id }}</td>
                                            <td>{{ $attribute->value }}</td>
                                            <td>{{ $attribute->priority }}</td>
                                            <td><a class="mt-3" href="javascript:void(0)"
                                                   wire:click.edit="edit({{$attribute->id}})">
                                                    <i class="mt-3 fa fa-edit"></i>
                                                </a>
                                            </td>
                                            <td><a class="mt-3" href="javascript:void(0)"
                                                   wire:click.prevent="deleteConfirmation({{ $attribute->id }})">
                                                    <i class="mt-3 fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty

                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
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
