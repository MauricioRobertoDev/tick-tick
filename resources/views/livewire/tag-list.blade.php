<div class="mx-auto max-w-7xl py-8">
    {{-- header --}}
    <header class="mb-12 flex w-full items-center justify-between">
        <h1 class="text-xl font-medium lg:text-3xl">Tags</h1>
        <button wire:click="openModal()" class="flex h-10 items-center justify-center gap-1 rounded-lg bg-primary-500 px-4 text-sm uppercase text-white hover:bg-primary-600">
            <x-icon.plus class="w-5" />
            Nova tag
        </button>
    </header>

    {{-- table --}}
    <table class="min-w-full divide-y divide-gray-200 border text-gray-900">
        <thead>
            <tr class="bg-white">
                <th class="px-6 py-3 text-left">
                    <span class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Nome</span>
                </th>

                <th class="w-20 px-6 py-3 text-left">
                </th>
            </tr>
        </thead>
        <tbody class="divide-y divide-solid divide-gray-200">
            @foreach ($tags as $tag)
                <tr class="bg-white">
                    {{-- Inline Edit Start --}}
                    <td class="@if ($editedTagId !== $tag->id) hidden @endif whitespace-no-wrap px-6 py-4">
                        <x-text-input wire:model.defer="tag.name" id="tag.name" class="w-full rounded-lg border border-gray-400 py-2 pr-4 pl-2 text-sm focus:border-blue-400 focus:outline-none sm:text-base" />
                        @error('tag.name')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </td>
                    {{-- Inline Edit End --}}

                    {{-- Show Tag Start --}}
                    <td class="@if ($editedTagId === $tag->id) hidden @endif whitespace-no-wrap px-6 py-4">
                        {{ $tag->name }}
                    </td>
                    {{-- Show tag End --}}
                    <td class="flex gap-2 py-4 px-6">
                        @if ($editedTagId === $tag->id)
                            <button wire:click="save()" type="button" class="flex h-10 w-10 items-center justify-center rounded-lg text-green-500 transition-all duration-200 hover:bg-green-500/10">
                                <x-icon.check class="w-5" />
                            </button>
                            <button wire:click="cancelTagEdit()" type="button" class="flex h-10 w-10 items-center justify-center rounded-lg text-red-500 transition-all duration-200 hover:bg-red-500/10">
                                <x-icon.close class="w-5" />
                            </button>
                        @else
                            <button wire:click="editTag({{ $tag->id }})" class="flex h-10 w-10 items-center justify-center rounded-lg text-gray-500 transition-all duration-200 hover:border-transparent hover:bg-primary-500/10 hover:text-primary-500">
                                <x-icon.edit class="w-5" />
                            </button>
                            <button wire:click="showDeleteModal({{ $tag->id }})" class="flex h-10 w-10 items-center justify-center rounded-lg text-gray-500 transition-all duration-200 hover:border-transparent hover:bg-red-500/10 hover:text-red-500">
                                <x-icon.trash class="w-5" />
                            </button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- pagination --}}
    @if ($tags->hasPages())
        <div class="rounded-b-lg border-x border-b border-gray-200 bg-white py-3 px-6">
            {!! $tags->links() !!}
        </div>
    @endif

    @if (session()->has('status'))
        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-500">
            {{ session('status') }}
        </p>
    @endif

    {{-- create modal --}}
    <div class="@if (!$showModal) hidden @endif fixed left-0 bottom-0 flex h-full w-full items-center justify-center bg-gray-800 bg-opacity-90 px-4">
        <div class="w-full rounded-lg bg-white lg:w-1/2">
            <form wire:submit.prevent="save" class="w-full">
                <div class="flex flex-col items-start p-4">
                    <div class="mb-4 flex w-full items-center border-b pb-4">
                        <div class="text-lg font-medium text-gray-900">Nova tag</div>
                        <svg wire:click.prevent="$set('showModal', false)" class="ml-auto h-6 w-6 cursor-pointer fill-current text-gray-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z" />
                        </svg>
                    </div>
                    <div class="mb-2 w-full">
                        <label class="block text-sm font-medium text-gray-700" for="tag.name">
                            Nome
                        </label>
                        <input wire:model.defer="tag.name" id="tag.name" class="mt-2 w-full rounded-lg border border-gray-400 py-2 pr-4 pl-2 text-sm focus:border-blue-400 focus:outline-none sm:text-base" />
                        @error('tag.name')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-4 ml-auto space-x-2">
                        <button class="rounded border border-primary-500 bg-primary-500 px-4 py-2 text-sm uppercase text-white hover:border-primary-500 hover:bg-primary-700" type="submit">
                            Criar
                        </button>
                        <button wire:click.prevent="$set('showModal', false)" class="rounded border px-4 py-2 text-sm uppercase text-gray-700 hover:bg-gray-200" type="button" data-dismiss="modal">
                            Fechar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- delete modal --}}
    <div class="@if (!$showDeleteModal) hidden @endif fixed left-0 bottom-0 flex h-full w-full items-center justify-center bg-gray-800 bg-opacity-90 px-4">
        <div class="w-full rounded-lg bg-white lg:w-1/2">
            <form wire:submit.prevent="delete" class="w-full">
                <div class="flex flex-col items-start p-4">
                    <div class="mb-4 flex w-full items-center border-b pb-4">
                        <div class="text-lg font-medium text-gray-900">Excluir tag</div>
                        <svg wire:click.prevent="$set('showDeleteModal', false)" class="ml-auto h-6 w-6 cursor-pointer fill-current text-gray-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z" />
                        </svg>
                    </div>
                    <div class="mb-2 w-full text-gray-700">
                        Atenção! Não será mais possível encontrar tickets através dessa tag.
                    </div>
                    <div class="mt-4 ml-auto space-x-2">
                        <button class="rounded border border-red-500 bg-red-500 px-4 py-2 text-sm uppercase text-white hover:border-red-500 hover:bg-red-700" type="submit">
                            Excluir
                        </button>
                        <button wire:click.prevent="$set('showDeleteModal', false)" class="rounded border px-4 py-2 text-sm uppercase text-gray-700 hover:bg-gray-200" type="button" data-dismiss="modal">
                            Fechar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
