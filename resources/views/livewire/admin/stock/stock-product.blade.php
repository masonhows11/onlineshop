<div>
    @section('dash_page_title')
        {{ __('messages.stock_management') }}
    @endsection
    @section('breadcrumb')
            {{ Breadcrumbs::render('admin.product.stock.list') }}
    @endsection
        <div class="container-fluid">

            <div class="row d-flex justify-content-start my-4 bg-white">
                <div class="col-lg-4 col-md-4 col  my-5  border-bottom title-add-to-stock">
                    <div class="alert my-4">
                        <h3> {{ __('messages.stock') }}</h3>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center search-category-section">
                <div class="col">
                    <div class="mb-3 mt-3">
                        <input wire:model.debounce.500ms="search" placeholder="{{ __('messages.search') }}" type="text"
                               class="form-control" id="search">
                    </div>
                </div>
            </div>
            <div class="row product-stock-list bg-white">
                <div class=" my-5">
                    <table class="table">
                        <thead>
                        <tr class="text-center">
                            <th>{{ __('messages.id') }}</th>
                            <th>{{ __('messages.name_persian') }}</th>
                            <th>{{ __('messages.thumbnail_image') }}</th>
                            <th>{{ __('messages.available_in_stock') }}</th>
                            <th>{{ __('messages.number_sold') }}</th>
                            <th>{{ __('messages.frozen_number') }}</th>
                            <th>{{ __('messages.salable_quantity') }}</th>
                            <th>{{ __('messages.operation') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr class="text-center">
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->title_persian }}</td>
                                <td>
                                    @if( $product->thumbnail_image && \Illuminate\Support\Facades\Storage::disk('public')->exists($product->thumbnail_image ) )
                                        <img class="img-thumbnail" width="100" height="100" src="{{ asset('storage/'.$product->thumbnail_image) }}" alt="product_image">
                                    @else
                                        <img class="img-thumbnail" width="100" height="100" src="{{ asset('admin_assets/images/no-image-icon-23494.png') }}" alt="product_image">
                                    @endif
                                </td>
                                <td>{{ $product->available_in_stock }}</td>
                                <td>{{ $product->number_sold }}</td>
                                <td>{{ $product->frozen_number }}</td>
                                <td>{{ $product->salable_quantity }}</td>
                                <td>
                                    <a href="{{ route('admin.add_to_stock.form',['product'=>$product->id]) }}" class="btn btn-sm btn-success">افزایش موجودی</a>
                                    <a href="{{ route('admin.modify_stock.form',['product'=>$product->id]) }}" class="btn btn-sm btn-info me-2">اصلاح موجودی</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row d-flex justify-content-center list-stock-paginate">
                <div class="col-lg-2 col-md-2 ">
                    {{ $products->links() }}
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
