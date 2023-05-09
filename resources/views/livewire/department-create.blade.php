<div class="mx-auto max-w-7xl py-8 px-4">
    {{-- header --}}
    <header class="mb-12 flex w-full items-center gap-2 lg:gap-4">
        <a href="{{ route('department.index') }}" class="hover:text-primary-500">
            <x-icon.arrow-left class="h-6 w-6" />
        </a>
        <h1 class="text-xl font-medium lg:text-3xl">Novo departamento</h1>
    </header>

    <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
        <form wire:submit.prevent='save()' method="post" class="space-y-6">
            <div>
                <x-input-label for="name" value="Nome" />
                <x-text-input wire:model.defer='name' id="name" name="name" type="text" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="name" value="Agentes" class="mb-2" />
                <div class="grid w-full grid-cols-1 flex-wrap gap-4 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($all_agents as $agent)
                        <div class="relative flex w-full cursor-pointer flex-row-reverse items-center justify-end gap-4 p-4 peer-checked:!bg-black">
                            <input wire:model='agents' value="{{ $agent->id }}" id="agent-{{ $agent->id }}" type="checkbox" class="peer/agent h-4 w-4 rounded-full border-gray-300 bg-gray-100 text-primary-600 focus:ring-primary-500">
                            <label for="agent-{{ $agent->id }}" class="absolute top-0 left-0 h-full w-full rounded-lg border border-gray-200 peer-checked/agent:border-primary-500 peer-checked/agent:bg-primary-500/10"></label>
                            <div class="flex-grow">
                                <p class="whitespace-nowrap font-medium text-gray-900">{{ $agent->name }}</p>
                                <p class="whitespace-nowrap text-sm text-gray-500">{{ $agent->email }}</p>
                            </div>
                            <div class="h-10 w-10">
                                @if ($agent->avatar)
                                    <img src="{{ asset($agent->avatar) }}" class="h-10 w-10 flex-grow-0 rounded" />
                                @else
                                    <img src="{{ asset('avatars/default.png') }}" class="h-10 w-10 flex-grow-0 rounded" />
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                <x-input-error :messages="$errors->get('agents')" class="mt-2" />
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
            </div>
        </form>
    </div>
</div>
