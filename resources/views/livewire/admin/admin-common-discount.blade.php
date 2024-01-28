<div>
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.common.discount.index') }}
    @endsection

        {{--  this is standard view for index models  --}}
        <div class="row d-flex justify-content-start my-4 bg-white">
            <div class="col-lg-4 col-md-4 col  my-5  border-bottom title-add-to-stock">
                <div class="alert my-4">
                    <h3> {{ __('messages.common_discount') }}</h3>
                </div>
            </div>
        </div>
        <div class="row my-4 bg-white">
            <div class="col-lg-4 col-md-4 col my-2">
                <a href="{{ route('admin.common.discount.create') }}" class="btn btn-sm btn-primary">{{ __('messages.new_common_discount') }}</a>
            </div>
        </div>
        <div class="row  common-discount-list bg-white">
            <div class=" my-5">
                <table class="table table-striped">
                    <thead class="border-bottom-3 border-top-3">
                    <tr class="text-center">
                        <th>{{ __('messages.id') }}</th>
                        <th>{{ __('messages.percentage_discount') }}</th>
                        <th>{{ __('messages.discount_ceiling') }}</th>
                        <th>{{ __('messages.title_discount') }}</th>
                        <th>{{ __('messages.minimal_order_amount') }}</th>
                        <th>{{ __('messages.status') }}</th>
                        <th>{{ __('messages.start_date') }}</th>
                        <th>{{ __('messages.end_date') }}</th>
                        <th>{{ __('messages.operation') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($discounts as $discount)
                        <tr class="text-center">
                            <td>{{ $discount->id }}</td>
                            <td>{{ $discount->percentage }} %</td>
                            <td>{{ number_format( $discount->discount_ceiling)  }}</td>
                            <td>{{ $discount->title }}</td>
                            <td>{{ number_format($discount->minimal_order_amount) }}</td>
                            <td><a href="javascript:void(0)"  wire:click.prevent="changeStatus({{ $discount->id }})" class="btn btn-sm {{ $discount->status  == 1 ? 'btn-success' : 'btn-danger' }}">
                                    {{ $discount->status ==  1 ? __('messages.active') : __('messages.deactivate') }}</a></td>
                            <td>{{  jdate($discount->start_date)->format('%B %d، %Y')  }}</td>
                            <td>{{ jdate($discount->end_date)->format('%B %d، %Y') }}</td>
                            <td>
                                <a href="javascript:void(0)" wire:click.prevent="deleteConfirmation({{ $discount->id }})" class="" ><i class="fa fa-trash"></i></a>
                                <a href="{{ route('admin.common.discount.edit',$discount->id) }}" class="ms-2"><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row d-flex justify-content-center list-stock-paginate">
            <div class="col-lg-2 col-md-2 ">
                {{ $discounts->links() }}
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
        window.addEventListener('show-result', ({ detail: {type, message } }) => {
            Toast.fire({
                icon: type,
                title: message
            })
        })
        @if( session()->has('warning') )
        Toast.fire({
            icon: 'warning',
            title: '{{ session()->get('warning') }}'
        })
        @elseif( session()->has('success'))
        Toast.fire({
            icon: 'success',
            title: '{{ session()->get('success') }}'
        })
        @endif
    </script>
@endpush
