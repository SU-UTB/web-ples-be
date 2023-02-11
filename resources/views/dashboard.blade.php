<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p>Free seats: {{ $freeSeats }}</p>
                    <p>Taken seats: {{ $takenSeats }}</p>
                    <br>
                    <br>
                    <p>Free with raut: {{ $freeWithRautSeats }}</p>
                    <p>Free normal seats: {{ $freeNormalSeats }}</p>
                    <br>
                    <br>
                    <p>Available stands: {{ $availableStands }}</p>
                    <p>Purchased stands: {{ env("AVAILABLE_STANDS") - $availableStands }}</p>
                    <br>
                    <p>Money raised: {{ $moneyRaised }} CZK</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
