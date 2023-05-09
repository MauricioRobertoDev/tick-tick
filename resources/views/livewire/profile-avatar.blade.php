<div class="w-full items-start gap-4 bg-white p-4 shadow sm:rounded-lg sm:p-8">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Atualizar avatar
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            A imagem deve ser um quadrado com no mínimo 80x80px.
        </p>
    </header>

    <div class="max-w-xl space-y-6 pt-8">
        <div class="h-20 w-20 flex-grow-0 overflow-hidden rounded-md">
            @if ($avatar && $avatar instanceof \Livewire\TemporaryUploadedFile && !$errors->has('avatar'))
                <img src="{{ $avatar->temporaryUrl() }}" />
            @elseif ($user->avatar)
                <img src="{{ asset($user->avatar) }}" />
            @else
                <img src="{{ asset('avatars/default.png') }}" />
            @endif
        </div>

        <form x-data="" class="mb-3" method="POST" enctype="multpart/form-data" wire:submit.prevent="save()">
            <label for="formFile" class="mb-2 inline-block text-neutral-700">Selecione uma imagem</label>
            <input accept="image/png, image/jpeg, image/webp" wire:model="avatar" type="file" name="avatar" value="{{ old('avatar') }}" id="avatar" class="focus:border-primary focus:shadow-te-primary relative m-0 block w-full min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:text-neutral-700 focus:outline-none" type="file" id="formFile" />
            @error('avatar')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
            @if ($status)
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-500">
                    {{ $status }}
                </p>
            @endif
            <x-primary-button type="submit" class="mt-6">{{ __('Save') }}</x-primary-button>
        </form>
    </div>
</div>
