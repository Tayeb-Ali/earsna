@props(['page', 'columns' => []])

<div class="max-w-7xl mx-auto hidden sm:flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden border border-gray-200 sm:rounded-sm">
                <table {{ $attributes->merge(['class' => 'min-w-full divide-y divide-gray-200']) }}>
                    <thead class="bg-gray-50">
                        <tr>
                            @foreach ($columns as $column)
                                <th scope="col" class="px-6 py-3 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }} text-xs font-medium text-gray-400 uppercase tracking-wider">
                                    {{ __('page.' . $page . '.index.table.' . $column) }}
                                </th>
                            @endforeach

                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">

                        {{ $slot }}

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div dir="ltr" class="mt-6">
        {{ $pagination }}
    </div>
</div>
