<div>
    @section('dash_page_title')
        {{ __('messages.all_orders') }}
    @endsection
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.orders.index') }}
    @endsection
    <div class="container-fluid">

        <div class="row d-flex justify-content-start my-4 bg-white">
            <div class="col-lg-4 col-md-4 col  my-5  border-bottom title-add-to-stock">
                <div class="alert my-4">
                    <h3> {{ __('messages.all_orders') }}</h3>
                </div>
            </div>
        </div>

        <div class="row  order-list bg-white overflow-auto">
            <div class=" my-5">
                <table class="table table-striped">
                    <thead class="border-bottom-3 border-top-3">
                    <tr class="text-center">
                        <th class="model-field">{{ __('messages.id') }}</th>
                        <th>{{ __('messages.order_number') }}</th>
                        <th>{{ __('messages.order_final_amount') }}</th>

                        <th>{{ __('messages.order_discount_amount') }}</th>
                        <th>{{ __('messages.order_total_products_discount_amount') }}</th>

                        <td>{{ __('messages.final_amount') }}</td>
                        <th>{{ __('messages.payment_status') }}</th>
                        <th>{{ __('messages.payment_type') }}</th>
                        <th>{{ __('messages.payment_gateway') }}</th>
                        <th>{{ __('messages.delivery_status') }}</th>
                        <th>{{ __('messages.shipment_type') }}</th>
                        <th>{{ __('messages.order_status') }}</th>
                        <th>{{ __('messages.operation') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $orders as $order)
                        <tr class="text-center">
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ number_format(floatval($order->order_final_amount)) }} تومان </td>

                            <td>{{ number_format(floatval($order->order_discount_amount)) }} تومان </td>

                            <td>{{ number_format(floatval($order->order_total_products_discount_amount)) }} نومان </td>

                            <td>{{ number_format(floatval($order->order_final_amount - $order->order_discount_amount)) }} تومان </td>

                            <td>{{ $order->payment_status_value }}</td>

                            <td>{{ $order->payment_type_value }}</td>

                            <td>{{ $order->payment->paymentable->gateway ?? '-' }}</td>

                            <td>{{ $order->delivery_status_value }}</td>

                            <td>{{ $order->delivery->title }}</td>

                            <td>{{ $order->order_status_value }}</td>

                            <td class="">
                                <div class="btn-group dropstart">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownOperation" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ __('messages.operation') }}
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownOperation">
                                        <li><a href="{{ route('admin.order.show',$order->id) }}"  class="btn btn-sm btn-success mt-2 w-100">{{ __('messages.display_factor')  }}</a></li>
                                        <li><a href="javascript:void(0)"  wire:click="changeDeliveryStatus({{ $order->id }})" class="btn btn-sm btn-info mt-2 w-100">{{ __('messages.change_shipment_status') }}</a></li>
                                        <li><a href="javascript:void(0)"  wire:click="changeOrderStatus({{ $order->id }})" class="btn btn-sm btn-info mt-2 w-100">{{ __('messages.change_order_status') }}</a></li>
                                        <li><a href="javascript:void(0)"  wire:click="cancelOrder({{ $order->id }})" class="btn btn-sm btn-danger mt-2 w-100">{{ __('messages.cancel_order') }}</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row d-flex justify-content-center list-stock-paginate">
            <div class="col-lg-2 col-md-2 ">
                {{ $orders->links() }}
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
