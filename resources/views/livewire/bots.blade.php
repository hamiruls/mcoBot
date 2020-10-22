<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Manage bots ()
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                  <div class="flex">
                    <div>
                      <p class="text-sm">{{ session('message') }}</p>
                    </div>
                  </div>
                </div>
            @endif
            <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Create New Poll</button>
            @if($isOpen)
                @include('livewire.createbot')
            @endif
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">No.</th>
                        <th class="px-4 py-2">Group ID</th>
                        <th class="px-4 py-2">Question</th>
                        <th class="px-4 py-2">Answer</th>
                          <th class="px-4 py-2">Time</th>
                            <th class="px-4 py-2">Time to Send</th>
                               <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bots as $bot)
                    <tr>
                        <td class="border px-4 py-2">{{ $bot->id }}</td>
                         <td class="border px-4 py-2">{{ $bot->chatid }}</td>
                        <td class="border px-4 py-2">{{ $bot->question }}</td>
                        <td class="border px-4 py-2">{{ $bot->answer }}</td>
                         <td class="border px-4 py-2">{{ $bot->masa }}</td>
                          <td class="border px-4 py-2">{{ $bot->masacron }}</td>
                        <td class="border px-4 py-2">
                        <button wire:click="edit({{ $bot->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                            <button wire:click="delete({{ $bot->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>

                            
                        </td>


                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>