<div class="mx-auto max-w-7xl py-8">
    {{-- header --}}
    <header class="mb-12 flex w-full items-center justify-between">
        <h1 class="text-5xl font-medium">Departamentos</h1>
        <a href="{{ route('department.create') }}">
            <x-primary-button>
                <x-icon.plus class="w-5" />
                Novo departamento
            </x-primary-button>
        </a>
    </header>

    {{-- table --}}
    @if ($departments->isNotEmpty())
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
                @foreach ($departments as $department)
                    <tr class="bg-white">
                        {{-- Show Tag Start --}}
                        <td class="whitespace-no-wrap px-6 py-4">
                            {{ $department->name }}
                        </td>
                        {{-- Show tag End --}}
                        <td class="flex gap-2 py-4 px-6">
                            <a href="{{ route('department.edit', ['id' => $department->id]) }}" class="flex h-10 w-10 items-center justify-center rounded-lg text-gray-500 transition-all duration-200 hover:border-transparent hover:bg-primary-500/10 hover:text-primary-500">
                                <x-icon.edit class="w-5" />
                            </a>
                            <button wire:click="showDeleteModal({{ $department->id }})" class="flex h-10 w-10 items-center justify-center rounded-lg text-gray-500 transition-all duration-200 hover:border-transparent hover:bg-red-500/10 hover:text-red-500">
                                <x-icon.trash class="w-5" />
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="w-full rounded-lg bg-white p-6">
            Ainda não há nenhum departamento.
        </div>
    @endif

    {{-- pagination --}}
    @if ($departments->hasPages())
        <div class="rounded-b-lg border-x border-b border-gray-200 bg-white py-3 px-6">
            {!! $departments->links() !!}
        </div>
    @endif

    {{-- delete modal --}}
    <div class="@if (!$showDeleteModal) hidden @endif fixed left-0 bottom-0 flex h-full w-full items-center justify-center bg-gray-800 bg-opacity-90 px-4">
        <div class="w-full rounded-lg bg-white lg:w-1/2">
            <form wire:submit.prevent="delete" class="w-full">
                <div class="flex flex-col items-start p-4">
                    <div class="mb-4 flex w-full items-center border-b pb-4">
                        <div class="text-lg font-medium text-gray-900">Excluir departamento</div>
                        <svg wire:click.prevent="$set('showDeleteModal', false)" class="ml-auto h-6 w-6 cursor-pointer fill-current text-gray-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z" />
                        </svg>
                    </div>
                    <div class="mb-2 w-full text-gray-700">
                        Atenção! Todos os tickets deste departamento serão excluídos junto.
                        <br />
                        <br />
                        Voce tem certeza disto?
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
