<x-layout>
    <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6">Create a New Task</h1>

        <form action="{{ route('task.create') }}" method="POST">
            @csrf
            <x-form-field>
                <x-form-label for="title">Title</x-form-label>
                <x-form-input type="text" id="title" name="title" required />
                <x-form-error name='body' />

            </x-form-field>

            <x-form-field>
                <x-form-label for="body">Body</x-form-label>
                <x-form-input id="body" name="body" required />
                <x-form-error name='body' />

            </x-form-field>
            <div class="flex items-center justify-between">
                <x-form-button>Add Task</x-form-button>
            </div>
        </form>

    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        @foreach ($all as $task)
            <div class="bg-white rounded-lg shadow-md p-6 mb-4">
                <h2 class="text-2xl font-bold mb-2">{{ $task->title }}</h2>
                <p class="text-gray-700 mb-4">{{ $task['body'] }}</p>

                <div class="flex gap-2 justify-between items-center ">
                    <form action="{{ route('task.delete', $task->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-form-button class="bg-red-500 hover:bg-red-700">
                            <x-delete-icon />
                        </x-form-button>
                    </form>

                    <x-form-button
                        onclick="openEditModal({{ $task->id }}, '{{ $task->title }}', '{{ $task->body }}')">
                        <x-edit-icon />
                    </x-form-button>

                    <form action="{{ route('task.patch', $task->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="isFinished" value="{{ $task->isFinished ? 0 : 1 }}" />
                        <x-form-button
                            class="{{ $task->isFinished ? 'bg-red-500 hover:bg-red-700' : 'bg-green-500 hover:bg-green-700' }}">
                            {{ $task->isFinished ? 'Incomplete' : 'Complete' }}
                        </x-form-button>
                    </form>
                </div>
            </div>
            {{-- Edit model --}}
            <div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50  items-center justify-center hidden">
                <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
                    <h2 class="text-2xl font-bold mb-4">Edit Task</h2>
                    <form id="editForm" action="" method="POST">
                        @csrf
                        @method('PATCH')

                        <input type="hidden" id="editTaskId">

                        <x-form-field>
                            <x-form-label for="editTitle">Title</x-form-label>
                            <x-form-input type="text" id="editTitle" name="title" required />
                            <x-form-error name='title' />
                        </x-form-field>

                        <x-form-field>
                            <x-form-label for="editBody">Body</x-form-label>
                            <x-form-input id="editBody" name="body" required />
                            <x-form-error name='body' />
                        </x-form-field>

                        <div class="flex items-center justify-between">
                            <button type="submit"
                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Save Changes
                            </button>
                            <button type="button" onclick="closeEditModal()"
                                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach

    </div>

</x-layout>
