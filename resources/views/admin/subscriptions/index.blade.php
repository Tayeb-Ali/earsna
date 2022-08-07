<x-app-layout>
    <!-- begin::Page Heading -->
    <x-slot name="header" class="py-6">
        {{ __('page.subscriptions.index.header') }}

        <!-- begin::Add -->
        <x-actions.add href="{{ route('subscriptions.create') }}" />
        <!-- end::Add -->
    </x-slot>
    <!-- end::Page Heading -->

    <!-- begin::Page Content -->
    <x-table page="subscriptions" :columns="['#', 'package', 'client', 'status']">
        @foreach ($subscriptions as $subscription)
            <tr>
                <!-- begin::Number -->
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm  text-slate-800">
                        {{ $subscription->id }}
                    </div>
                </td>
                <!-- end::Number -->

                <!-- begin::Package -->
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm  text-slate-500">
                        {{ $subscription->package->name }}
                    </div>
                </td>
                <!-- end::Package -->

                <!-- begin::Client -->
                <td class="px-6 py-3 whitespace-nowrap {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                    <div class="text-sm  text-slate-500" dir="ltr">
                        {{ $subscription->client->user->name }}
                    </div>
                </td>
                <!-- end::Client -->

                <!-- begin::Status -->
                <td class="px-6 py-3 whitespace-nowrap">
                    <div
                        class="inline-block text-xs px-2 py-0.5 rounded-full
                        {{
                            $subscription->status === 'active'
                                ? 'bg-green-200/50 text-green-600'
                                : 'bg-yellow-200/50 text-yellow-600'
                        }}"
                    >
                        {{ ucwords(__('status.' . $subscription->status)) }}
                    </div>
                </td>
                <!-- end::Status -->

                <!-- begin::Actions -->
                <td class="px-6 py-3 whitespace-nowrap text-right text-sm space-s-1 flex items-center justify-end">
                    @if ($subscription->status === 'suspended')
                        <!-- begin::Activate -->
                        <x-actions.activate action="{{ route('subscriptions.update', $subscription->id) }}" />
                        <!-- end::Activate -->
                    @else
                        <!-- begin::Suspend -->
                        <x-actions.suspend action="{{ route('subscriptions.update', $subscription->id) }}" />
                        <!-- end::Suspend -->
                    @endif

                    <!-- begin::Edit -->
                    <x-actions.edit href="{{ route('subscriptions.edit', $subscription->id) }}" />
                    <!-- end::Edit -->

                    <!-- begin::Delete -->
                    <x-actions.delete :action="route('subscriptions.destroy', $subscription->id)" />
                    <!-- end::Delete -->
                </td>
                <!-- end::Actions -->
            </tr>
        @endforeach

        <x-slot name="pagination">
            {{ $subscriptions->links() }}
        </x-slot>

    </x-table>
    <!-- begin::Page Content -->
</x-app-layout>
