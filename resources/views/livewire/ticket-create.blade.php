<div class="px-4 py-8 mx-auto max-w-7xl">
    {{-- header --}}
    <header class="flex items-center w-full gap-2 mb-12 lg:gap-4">
        <a href="{{ route('ticket.index') }}" class="hover:text-primary-500">
            <x-icon.arrow-left class="w-6 h-6" />
        </a>
        <h1 class="text-xl font-medium lg:text-3xl">Novo ticket</h1>
    </header>

    <div class="p-4 bg-white shadow sm:rounded-lg sm:p-8">
        <form wire:submit.prevent='save()' method="post" class="space-y-6">
            <div>
                <x-input-label for="name" value="Nome" />
                <x-text-input wire:model.defer='name' id="name" name="name" type="text" class="block w-full mt-1" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="name" value="Agentes" class="mb-2" />
                <div class="grid flex-wrap w-full grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($all_agents as $agent)
                        <div class="relative flex w-full cursor-pointer flex-row-reverse items-center justify-end gap-4 p-4 peer-checked:!bg-black">
                            <input wire:model='agents' value="{{ $agent->id }}" id="agent-{{ $agent->id }}" type="checkbox" class="w-4 h-4 bg-gray-100 border-gray-300 rounded-full peer/agent text-primary-600 focus:ring-primary-500">
                            <label for="agent-{{ $agent->id }}" class="absolute top-0 left-0 w-full h-full border border-gray-200 rounded-lg peer-checked/agent:border-primary-500 peer-checked/agent:bg-primary-500/10"></label>
                            <div class="flex-grow">
                                <p class="font-medium text-gray-900 whitespace-nowrap">{{ $agent->name }}</p>
                                <p class="text-sm text-gray-500 whitespace-nowrap">{{ $agent->email }}</p>
                            </div>
                            <div class="w-10 h-10">
                                @if ($agent->avatar)
                                    <img src="{{ asset($agent->avatar) }}" class="flex-grow-0 w-10 h-10 rounded" />
                                @else
                                    <img src="{{ asset('avatars/default.png') }}" class="flex-grow-0 w-10 h-10 rounded" />
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
