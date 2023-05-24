<div class="row p-0">
    <div class="col-12 col-lg-6 my-2">
        <div class="col-12">
            {{ __('lang.Select Category') }} <a href="{{ route('admin.categories.create') }}"
            class="btn btn-primary btn-sm"><span class="la la-plus"></span></a>
        </div>
        <div class="col-12 pt-2">
            <select class="form-control rounded-3" wire:change="subCategory()" wire:model="category_id" name="category_id"
                required>
                <option value="" selected>{{ __('lang.Select Category') }}</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if (old('category_id') == $category->id) selected @endif>
                        {{ $category->title }}</option>
                @endforeach
            </select>
        </div>
    </div>
    @if ($subcategories)
        <div class="col-12 col-lg-6 my-2">
            <div class="col-12">
                {{ __('lang.Select Category') }} <a href="{{ route('admin.categories.create') }}"
                class="btn btn-primary btn-sm"><span class="la la-plus"></span></a>
            </div>
            <div class="col-12 pt-2">
                <select class="form-control rounded-3" wire:model="subcategory_id" name="Category" required>
                    <option value="" selected>{{ __('lang.Select Category') }}</option>
                    @foreach ($subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}" @if (old('Category') == $subcategory->id) selected @endif>
                            {{ $subcategory->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    @endif
</div>
