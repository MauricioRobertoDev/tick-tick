<div class="mx-auto max-w-7xl py-8 px-4">
    {{-- header --}}
    <header class="mb-12 flex w-full items-center gap-2 lg:gap-4">
        <a href="{{ route('user.index') }}" class="hover:text-primary-500">
            <x-icon.arrow-left class="h-6 w-6" />
        </a>
        <h1 class="text-xl font-medium lg:text-3xl">Novo usuário</h1>
    </header>

    <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
        <form wire:submit.prevent='save()' method="post" class="space-y-6">
            <div>
                <x-input-label for="name" value="Nome" />
                <x-text-input wire:model='name' id="name" name="name" type="text" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="email" value="Email" />
                <x-text-input wire:model='email' id="email" name="email" type="email" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password" value="Senha" />
                <x-text-input wire:model.defer='password' id="password" name="password" type="text" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex items-center gap-2">
                <input wire:model='is_agent' value="" id="is_agent" type="checkbox" class="h-4 w-4 rounded-full border-gray-300 bg-gray-100 text-primary-600 focus:ring-primary-500">
                <x-input-label for="is_agent" value="É um funcionário ?" />
                <x-input-error :messages="$errors->get('is_agent')" class="mt-2" />
            </div>

            @if ($is_agent)
                <div class="grid w-full grid-cols-1 flex-wrap gap-4 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($all_departments as $department)
                        <div class="relative flex w-full cursor-pointer flex-row-reverse items-center justify-end gap-4 p-4 peer-checked:!bg-black">
                            <input wire:model='departments' value="{{ $department->id }}" id="department-{{ $department->id }}" type="checkbox" class="peer/department h-4 w-4 rounded-full border-gray-300 bg-gray-100 text-primary-600 focus:ring-primary-500">
                            <label for="department-{{ $department->id }}" class="absolute top-0 left-0 h-full w-full rounded-lg border border-gray-200 peer-checked/department:border-primary-500 peer-checked/department:bg-primary-500/10"></label>
                            <div class="flex-grow">
                                <p class="whitespace-nowrap font-medium text-gray-900">{{ $department->name }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="flex items-center gap-2">
                <input wire:model.defer='is_verified' value="" id="is_verified" type="checkbox" class="h-4 w-4 rounded-full border-gray-300 bg-gray-100 text-primary-600 focus:ring-primary-500">
                <x-input-label for="is_verified" value="Marcar email como verificado ?" />
                <x-input-error :messages="$errors->get('is_verified')" class="mt-2" />
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                @if (session()->has('status'))
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-500">
                        {{ session('status') }}
                    </p>
                @endif
            </div>
        </form>
    </div>
</div>
