<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white relative overflow-x-auto shadow-xl sm:rounded-lg px-4 py-4">

            @if (session()->has('message'))
                <div class="flex-col pb-4">
                    <div class="flex justify-between">
                        <p class="text-sm">{{ session('message') }}</p>
                    </div>
                </div>
            @endif

            <div class="flex-col pb-4">
                <div class="flex justify-between">
                    <x-input type="search"
                            autocomplete="q"
                            placeholder="{{ __('Search') }}"
                            x-ref="q"
                            wire:model="q" />
                </div>
            </div>

            @if (isset($medicines))
                <table class="table-flex w-full" wire:loading.class.delay"opacity-50">
                    <tbody>
                        @forelse($medicines as $medicine)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="border px-4 py-2">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="">
                                                <div class="leading-tight">
                                                    <div class="text-gray-900">{{ $medicine->name }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="border px-4">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="leading-tight text-xs font-medium">
                                                @if (!is_null($medicine->created_at))
                                                    <div>
                                                        {{ $medicine->created_at->format('d/m/Y H:m:s') }}
                                                    </div>
                                                @endif
                                                @if ((!is_null($medicine->updated_at)) && ((!is_null($medicine->created_at)) && ($medicine->updated_at != $medicine->created_at)))
                                                    <div>
                                                        {{ $medicine->created_at->format('d/m/Y H:m:s') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <div class="flex justify-center">
                                        <span class="p-4">{{ __('No data') }}</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="row">
                    <div class="col">
                        {{ $medicines->links() }}
                    </div>
                </div>
            @endif
        </div>
</div>