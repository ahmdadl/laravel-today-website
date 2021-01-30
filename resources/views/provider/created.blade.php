<x-app-layout>
    <div class='mx-auto text-left w-90'>
        <div class='alert alert-success'>
            <h1 class='text-3xl'>
                <i class='mx-2 fas fa-check'></i>
                Done
            </h1>
        </div>
        <x-card title='Please Note'>
            <div class='p-4 mt-3 mb-10 font-semibold text-left text-gray-700 bg-gray-200 rounded shadow dark:bg-gray-800 dark:text-gray-400'>
                <p>your website was added successfuly but we will need you to verify your ownership,<br> thus for you should add this meta tag into your website home page and request url page</p><br>
                <pre class='text-gray-900 dark:text-gray-100'>{{'<meta name="can_be_scraped" content="approve" />'}}</pre>
                <br>
                you can check if your website was approved from <a href='providers/check' class='text-green-600 underline uppercase dark:text-green-300'>here</a>
            </div>
        </x-card>
    </div>
</x-app-layout>