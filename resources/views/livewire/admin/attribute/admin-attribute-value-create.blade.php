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
                                <label for="priority" class="form-label">{{ __('messages.priority') }}</label>
                                <input type="number" min="1" max="999" class="form-control" id="priority" wire:model.defer="priority">
                                @error('priority')
                                <div class="alert alert-danger mt-3">
                                    {{ $message }}
                                </div>
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

                    </div>
                </div>
                <div class="mb-3 mt-3">
                    <button type="submit" id="add_attribute" class="btn btn-success ">{{ __('messages.save') }}</button>
                    <a href="{{ route('admin.attribute.value.index') }}"
                       class="btn btn-secondary">{{ __('messages.return') }}</a>
                </div>
            </form>
        </div>

        <div class="row mt-4 category-list bg-white overflow-auto">
            <div class="accordion my-4" id="accordionExample">
                @foreach($attributes as $attribute)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                           {{ $attribute->name }}
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>

    </div>
</div>
