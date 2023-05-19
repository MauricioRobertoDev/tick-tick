<div class="mx-auto grid h-full max-w-7xl grid-rows-[auto,1fr] px-4 lg:px-0">
    {{-- header --}}
    <header class="flex items-center flex-grow-0 row-span-1 gap-2 start-row-1 h-14 lg:h-20">
        <a href="{{ route('myticket.index') }}" class="hover:text-primary-500">
            <x-icon.arrow-left class="w-5 h-5 lg:h-6 lg:w-6" />
        </a>
        <h1 class="text-xl font-medium lg:text-3xl">Meu ticket</h1>
    </header>

    <div class="gris-cols-1 grid h-full grid-flow-col grid-rows-[auto,_1fr] gap-4 overflow-hidden pb-4 lg:grid-cols-[1fr,320px] lg:grid-rows-1">
        <div class="flex flex-col-reverse items-stretch w-full h-full gap-2 p-4 overflow-y-auto bg-white border rounded-lg shadow lg:col-span-1 lg:col-start-1">
            @if ($messages->isNotEmpty())
                @foreach ($messages as $message)
                    @if ($message->user_id == auth()->user()->id)
                        <div class="self-end p-2 text-white rounded-lg max-w-3/4 bg-primary-500">
                            <p>{{ $message->content }}</p>
                            <p class="text-xs text-right text-white/50">{{ $message->created_at->diffForHumans() }}</p>
                        </div>
                    @else
                        <div class="self-start p-2 text-gray-700 bg-gray-200 rounded-lg max-w-3/4">
                            <p>{{ $message->content }}</p>
                            <p class="text-xs text-left text-gray-400">{{ $message->created_at->diffForHumans() }}</p>
                        </div>
                    @endif
                @endforeach
            @else
                <div>Ainda não há mensagens.</div>
            @endif

            {{-- @foreach ($ticket->messages as $message)
                @php
                    $align_self = $message->user_id == auth()->user()->id ? 'self-start' : 'self-end';
                @endphp
                <div class="{{ $align_self }}">
                    {{ $message->content }}
                </div>
            @endforeach --}}
        </div>
        <div class="w-full col-start-1 space-y-4 lg:col-span-1 lg:col-start-2" x-data="{ show: false }">
            <div class="overflow-hidden bg-white rounded-lg shadow">
                <button x-on:click.prevent="show = !show" class="flex items-center justify-between w-full h-10 px-4 text-sm text-left text-gray-700 uppercase bg-white border-b">
                    Dados primários
                    <span :class="show ? '' : 'rotate-180'" class="transition-all transform duration-400 lg:hidden">
                        <x-icon.chevron class="w-5 h-5 -rotate-90" />
                    </span>
                </button>
                <div x-show="show" class="space-y-3 overflow-hidden bg-white p-4 text-gray-700 lg:!block">
                    <p class="text-sm text-gray-500 uppercase">ID: <span class="text-gray-900">{{ $ticket->id }}</span></p>
                    <p class="space-x-32 text-sm text-gray-500 uppercase">
                        Status:
                        @php $status_color = $ticket->status == 'open' ? 'text-green-500 bg-green-100' : 'text-red-500 bg-red-100'; @endphp
                        <span class="{{ $status_color }} rounded-full px-3 py-1 text-xs">
                            {{ __($ticket->status) }}
                        </span>
                    </p>
                    <p class="text-sm text-gray-500 uppercase">Departamento: <span class="text-gray-900">{{ $ticket->department->name }}</span></p>
                    <div>
                        <p class="text-sm text-gray-500 uppercase">Assunto</p>
                        <p>{{ $ticket->subject }}</p>
                        <br />
                        <p class="text-sm text-gray-500 uppercase">Descrição</p>
                        <p>{{ $ticket->description }}</p>
                    </div>
                </div>
            </div>
            <x-primary-button wire:click.prevent="openModal()" class="w-full">Nova mensagem</x-primary-button>
        </div>
    </div>

    {{-- create modal --}}
    <div class="@if (!$showModal) hidden @endif fixed left-0 bottom-0 flex h-full w-full items-end justify-center bg-gray-800 bg-opacity-90 lg:items-center lg:px-4">
        <div class="w-full max-h-full overflow-y-auto bg-white rounded-lg h-min lg:w-1/2">
            <form wire:submit.prevent="save" class="w-full">
                <div class="flex flex-col items-start p-4">
                    <div class="flex items-center w-full pb-4 mb-4 border-b">
                        <div class="text-lg font-medium text-gray-900">Nova mensagem</div>
                        <svg wire:click.prevent="$set('showModal', false)" class="w-6 h-6 ml-auto text-gray-700 cursor-pointer fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z" />
                        </svg>
                    </div>
                    <div class="w-full mb-2">
                        <x-input-label for="content" value="Mensagem" class="mb-2" />
                        <x-input-text-area rows="5" wire:model.defer='message.content' id="content" name="content" type="text-area" class="block w-full mt-1" />
                        <x-input-error :messages="$errors->get('message.content')" class="mt-2" />
                    </div>

                    <div class="mt-4 ml-auto space-x-2">
                        <button wire:click.prevent="save()" class="px-4 py-2 text-sm text-white uppercase border rounded border-primary-500 bg-primary-500 hover:border-primary-500 hover:bg-primary-700" type="submit">
                            Enviar
                        </button>
                        <button wire:click.prevent="$set('showModal', false)" class="px-4 py-2 text-sm text-gray-700 uppercase border rounded hover:bg-gray-200" type="button" data-dismiss="modal">
                            Fechar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
