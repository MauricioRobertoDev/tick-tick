<div class="mx-auto max-w-7xl py-8 px-4">
    {{-- header --}}
    <header class="mb-12 flex w-full flex-wrap items-center justify-between gap-2">
        <h1 class="text-xl font-medium lg:text-3xl">Usuários</h1>
        <a href="{{ route('user.create') }}">
            <x-primary-button>
                <x-icon.plus class="w-5" />
                Novo usuário
            </x-primary-button>
        </a>
    </header>

    {{-- table --}}
    <div class="w-full overflow-x-auto">
        @if ($users->isNotEmpty())
            <table class="w-full divide-y divide-gray-200 border text-gray-900">
                <thead class="">
                    <tr class="bg-white">
                        <th class="px-6 py-3 text-left">
                            <span class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Usuário</span>
                        </th>
                        <th class="px-6 py-3 text-left">
                            <span class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Tipo</span>
                        </th>
                        <th class="w-20 px-6 py-3 text-left">
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-solid divide-gray-200">
                    @foreach ($users as $user)
                        <tr class="bg-white">
                            <td class="whitespace-no-wrap gap-2 px-6 py-4">
                                <div class="flex items-center gap-4 whitespace-nowrap">
                                    <div class="h-10 w-10">
                                        @if ($user->avatar)
                                            <img src="{{ asset($user->avatar) }}" class="h-10 w-10 flex-grow-0 rounded-md" />
                                        @else
                                            <img src="{{ asset('avatars/default.png') }}" class="h-10 w-10 flex-grow-0 rounded-md" />
                                        @endif
                                    </div>
                                    <div>
                                        <p class="">{{ $user->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </td>

                            <td class="whitespace-no-wrap gap-2 px-6 py-4">

                                @if ($user->roles->count() > 0)
                                    @foreach ($user->roles as $role)
                                        <span class="rounded bg-primary-100 py-1 px-2 text-sm text-primary-500">
                                            {{ __($role->name) }}
                                        </span>
                                    @endforeach
                                @else
                                    <span class="rounded bg-orange-100 py-1 px-2 text-sm text-orange-500">
                                        cliente
                                    </span>
                                @endif

                            </td>

                            <td class="flex gap-2 py-4 px-6">
                                <a href="{{ route('user.edit', ['id' => $user->id]) }}" class="flex h-10 w-10 items-center justify-center rounded-lg text-gray-500 transition-all duration-200 hover:border-transparent hover:bg-primary-500/10 hover:text-primary-500">
                                    <x-icon.edit class="w-5" />
                                </a>
                                <button wire:click="showDeleteModal({{ $user->id }})" class="flex h-10 w-10 items-center justify-center rounded-lg text-gray-500 transition-all duration-200 hover:border-transparent hover:bg-red-500/10 hover:text-red-500">
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
    </div>

    {{-- pagination --}}
    @if ($users->hasPages())
        <div class="rounded-b-lg border-x border-b border-gray-200 bg-white py-3 px-6">
            {!! $users->links() !!}
        </div>
    @endif

    @if (session()->has('status'))
        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-500">
            {{ session('status') }}
        </p>
    @endif

    {{-- delete modal --}}
    <div class="@if (!$showDeleteModal) hidden @endif fixed left-0 bottom-0 flex h-full w-full items-center justify-center bg-gray-800 bg-opacity-90 px-4">
        <div class="w-full rounded-lg bg-white lg:w-1/2">
            <form wire:submit.prevent="delete" class="w-full">
                <div class="flex flex-col items-start p-4">
                    <div class="mb-4 flex w-full items-center border-b pb-4">
                        <div class="text-lg font-medium text-gray-900">Excluir usuário</div>
                        <svg wire:click.prevent="$set('showDeleteModal', false)" class="ml-auto h-6 w-6 cursor-pointer fill-current text-gray-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z" />
                        </svg>
                    </div>
                    <div class="mb-2 w-full text-gray-700">
                        Atenção! Todos os tickets deste usuário serão excluídos também.
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
