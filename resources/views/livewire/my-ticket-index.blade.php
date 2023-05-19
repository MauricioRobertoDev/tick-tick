<div class="mx-auto max-w-7xl px-4 py-8">
    {{-- header --}}
    <header class="mb-12 flex w-full flex-wrap items-center justify-between gap-2">
        <h1 class="text-xl font-medium lg:text-3xl">Meus tickets</h1>
        <a href="{{ route('myticket.create') }}">
            <x-primary-button>
                <x-icon.plus class="w-5" />
                Novo ticket
            </x-primary-button>
        </a>
    </header>

    <div class="w-full overflow-x-auto">
        @if ($tickets->isNotEmpty())
            <table class="min-w-full divide-y divide-gray-200 border text-gray-900">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="min-w-60 px-6 py-3 text-left">
                            <span class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Assunto</span>
                        </th>
                        <th class="min-w-20 w-20 px-6 py-3 text-left">
                            <span class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Status</span>
                        </th>
                        <th class="min-w-40 w-40 px-6 py-3 text-left">
                            <span class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Criado</span>
                        </th>
                        <th class="min-w-20 w-20 px-6 py-3 text-center">

                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-solid divide-gray-200">
                    @foreach ($tickets as $ticket)
                        <tr class="bg-white">
                            {{-- Show Tag Start --}}
                            <td class="whitespace-nowrap px-6 py-4 text-sm lg:text-base">
                                {{ $ticket->subject }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm lg:text-base">
                                @php $status_color = $ticket->status == 'open' ? 'text-green-500 bg-green-100' : 'text-red-500 bg-red-100'; @endphp
                                <div class="{{ $status_color }} rounded-full px-3 py-1 text-sm">
                                    {{ __($ticket->status) }}
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm lg:text-base">
                                {{ $ticket->created_at->diffForHumans() }}
                            </td>
                            {{-- Show tag End --}}
                            <td class="text-gray-400">
                                <a href="{{ route('myticket.show', ['id' => $ticket->id]) }}">
                                    <x-icon.chevron class="mx-auto h-5 w-5" />
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="w-full rounded-lg bg-white p-6">
                Ainda não há nenhum ticket.
            </div>
        @endif
    </div>

    @if ($tickets->hasPages())
        <div class="rounded-b-lg border-x border-b border-gray-200 bg-white px-6 py-3">
            {!! $tickets->links() !!}
        </div>
    @endif

    @if (session()->has('toast'))
        <x-toast :message="session('toast')['message']" :type="session('toast')['type']" />
    @endif

</div>
