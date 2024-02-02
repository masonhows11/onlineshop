<div>
    @section('dash_page_title')
        {{ __('messages.product_specifications_values') }}
    @endsection
    @section('breadcrumb')
        {{-- {{ Breadcrumbs::render('admin.delivery.index') }}--}}
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

                        <div class="col-sm-6">
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

                        <div class="col-sm-6">
                            <div class="mt-3 mb-3">
                                <label for="value" class="form-label">{{ __('messages.name') }}</label>
                                <input type="text" class="form-control" id="value" wire:model.defer="value">
                                @error('value')
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
                    <a href="{{ route('admin.attribute.index') }}"
                       class="btn btn-secondary">{{ __('messages.return') }}</a>
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
                        <th>{{ __('messages.operation')}}</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
