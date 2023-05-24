<div class="col-12 col-md-6 col-lg-4 p-3 mb-3 mx-auto">
    <div class="col-12 p-0">
        @if ($photo)
            <img src="{{ $photo->temporaryUrl() }}" alt="" class="border border-5 rounded-circle"
                style="width:180px;margin-top:20px;height: 180px">
        @elseif($user)
            <img src="{{ $user->photo }}" alt="" class="border border-5 rounded-circle"
                style="width:180px;margin-top:20px;height: 180px">
        @else
            <img src="{{ env('DEFAULT_IMAGE') }}" alt="" class="border border-5 rounded-circle"
                style="width:180px;margin-top:20px;height: 180px">
        @endif
        {{-- <img src="{{ $user->photo }}" style="width:100px;margin-top:20px"> --}}
    </div>
    <div class="col-12">
        الصورة
    </div>
    <div class="col-12 pt-3">
        <input type="file" name="photo" wire:model="photo" class="form-control" accept="image/*">
    </div>
    @error('photo')
        <span class="error">{{ $message }}</span>
    @enderror
</div>
