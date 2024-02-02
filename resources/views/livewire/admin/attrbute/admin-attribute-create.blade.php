<div>
    @section('dash_page_title')
        {{ __('messages.add_new_specification') }}
    @endsection
    @section('breadcrumb')
        {{-- {{ Breadcrumbs::render('admin.delivery.index') }}--}}
    @endsection
    <div class="container-fluid">

        <div class="row d-flex justify-content-start my-4 bg-white">
            <div class="col-lg-4 col-md-4 col  my-5  border-bottom title-add-to-stock">
                <div class="alert my-4">
                    <h3> {{ __('messages.add_new_specification') }}</h3>
                </div>
            </div>
        </div>

        <div class="row  category-list bg-white overflow-auto">
            <div class="my-5">
                <table class="table table-striped table-responsive">
                    <thead class="border-bottom-3 border-top-3">
                    <tr class="text-center">
                        <th>{{ __('messages.id') }} </th>
                        <th>{{ __('messages.name')}}</th>
                        <th>{{ __('messages.type') }}</th>
                        <th>{{ __('messages.add_new_value') }}</th>
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
                            <td>{{ $attribute->has_default_value }}</td>
                            <td>
                                <a href="" class="mx-4 btn btn-sm btn-success ">

                                </a>
                            </td>
                            <td></td>
                            <td></td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        <div class="row d-flex justify-content-center bg-white my-4 ">
            <div class="col-lg-2 col-md-2 my-2 pt-2 pb-2 ">
                {{ $categories->links() }}
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
