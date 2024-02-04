<div>
    @section('dash_page_title')
        {{ __('messages.product_specifications_values') }}
    @endsection
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.create.specification.values.category') }}
    @endsection
        <div class="container-fluid">
            <div class="row d-flex justify-content-start my-4 bg-white">
                <div class="col-lg-4 col-md-4 col  my-5  border-bottom title-add-to-stock">
                    <div class="alert my-4">
                        <h3> {{ __('messages.product_specifications') }} - {{ __('messages.add_new_specification_value') }}</h3>
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
                            <th>{{ __('messages.operation')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr class="text-center">
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->title_persian }}</td>
                                <td>
                                    <a href="{{ route('admin.attribute.value.create',['id'=>$category->id]) }}" class="mx-4 btn btn-sm btn-success ">
                                        {{ __('messages.add_new_specification_value') }}
                                    </a>
                                </td>
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
