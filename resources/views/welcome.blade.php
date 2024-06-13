<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>TodoList foda</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-6 gap-10 flex flex-col max-w-5xl mx-auto">
    <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6">Create a New Task</h1>
        <form action="{{ route('task.create') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title</label>
                <input type="text" id="title" name="title"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required>
            </div>
            <div class="mb-6">
                <label for="body" class="block text-gray-700 text-sm font-bold mb-2">Body</label>
                <textarea id="body" name="body" rows="4"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required></textarea>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Add Task
                </button>
            </div>
        </form>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        @foreach ($all as $task)
            <div class="bg-white rounded-lg shadow-md p-6 mb-4">
                <h2 class="text-2xl font-bold mb-2">{{ $task['title'] }}</h2>
                <p class="text-gray-700 mb-4">{{ $task['body'] }}</p>
                <div class="flex gap-2">
                    <form action="{{ route('task.delete', $task->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-2 rounded focus:outline-none focus:shadow-outline">
                            Delete
                        </button>
                    </form>
                    <button onclick="openEditModal({{ $task->id }}, '{{ $task->title }}', '{{ $task->body }}')"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded focus:outline-none focus:shadow-outline">
                        Edit
                    </button>
                    <form action="{{ route('task.patch', $task->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="isFinished" value="{{ $task->isFinished ? 0 : 1 }}">
                        <button type="submit"
                            class="{{ $task['isFinished'] ? 'bg-red-500 hover:bg-red-700' : 'bg-green-500 hover:bg-green-700' }}  text-white font-bold py-2 px-2 rounded focus:outline-none focus:shadow-outline">
                            {{ $task->isFinished ? 'Incomplete' : 'Complete' }}
                        </button>
                    </form>
                </div>
            </div>
            {{-- Edit model --}}
            <div id="editModal"
                class="fixed inset-0 bg-gray-600 bg-opacity-50  items-center justify-center hidden flex">
                <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
                    <h2 class="text-2xl font-bold mb-4">Edit Task</h2>
                    <form id="editForm" action="" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" id="editTaskId">
                        <div class="mb-4">
                            <label for="editTitle" class="block text-gray-700 text-sm font-bold mb-2">Title</label>
                            <input type="text" id="editTitle" name="title"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required>
                        </div>
                        <div class="mb-6">
                            <label for="editBody" class="block text-gray-700 text-sm font-bold mb-2">Body</label>
                            <textarea id="editBody" name="body" rows="4"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required></textarea>
                        </div>
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
</body>
<script>
    function openEditModal(id, title, body) {
        document.getElementById('editForm').action = `/${id}`;
        document.getElementById('editTitle').value = title;
        document.getElementById('editBody').value = body;
        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }
</script>

</html>
