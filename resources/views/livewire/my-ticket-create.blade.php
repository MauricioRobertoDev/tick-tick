<div class="px-4 py-8 mx-auto max-w-7xl">
    {{-- header --}}
    <header class="flex items-center w-full gap-2 mb-12 lg:gap-4">
        <a href="{{ route('myticket.index') }}" class="hover:text-primary-500">
            <x-icon.arrow-left class="w-6 h-6" />
        </a>
        <h1 class="text-xl font-medium lg:text-3xl">Novo ticket</h1>
    </header>

    <div class="p-4 bg-white shadow sm:rounded-lg sm:p-8">
        <form wire:submit.prevent='save()' method="post" class="space-y-6">
            <div>
                <x-input-label for="subject" value="Assunto" />
                <x-text-input wire:model.defer='subject' id="subject" name="subject" type="text" class="block w-full mt-1" />
                <x-input-error :messages="$errors->get('subject')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="description" value="Descrição do problema" class="mb-2" />
                <x-input-text-area rows="5" wire:model.defer='description' id="description" name="description" type="text-area" class="block w-full mt-1" />
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="department" value="Departamento" class="mb-2" />
                <div class="grid flex-wrap w-full grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($all_departments as $department)
                        <div class="relative flex w-full cursor-pointer flex-row-reverse items-center justify-end gap-4 p-4 peer-checked:!bg-black">
                            <input wire:model.defer='department' value="{{ $department->id }}" name="department" id="department-{{ $department->id }}" type="radio" class="w-4 h-4 bg-gray-100 border-gray-300 peer/department text-primary-600 focus:ring-2 focus:ring-primary-500">
                            <label for="department-{{ $department->id }}" class="absolute top-0 left-0 w-full h-full border border-gray-200 rounded-lg peer-checked/department:border-primary-500 peer-checked/department:bg-primary-500/10"></label>
                            <div class="flex-grow">
                                <p class="font-medium text-gray-900 whitespace-nowrap">{{ $department->name }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <x-input-error :messages="$errors->get('department')" class="mt-2" />
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
            </div>
        </form>
    </div>


</div>
