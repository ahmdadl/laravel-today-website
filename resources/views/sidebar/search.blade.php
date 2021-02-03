<x-card icon='fas fa-search'>
    <div x-data="{q: '{{ request('q') }}'}">
        <form action='/' class='search-form' method='get'>
            <input type='search' name='q' x-model='q' autocapitalize='off' autocorrect="off" class='w-full form-input'
                placeholder='Search for Posts or Providers' required />
            <div class='grid grid-cols-2 gap-2 py-2'>
                <x-button type='submit' bg='green' icon='fas fa-search' x-bind:disabled='q.length < 3' spin='1'>Search</x-button>
                <x-button type='reset' bg='orange' icon='fas fa-times' clear='1' x-bind:disabled='!q.length'>Reset
                </x-button>
            </div>
        </form>
    </div>
</x-card>
