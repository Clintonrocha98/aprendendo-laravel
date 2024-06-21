<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>TodoList foda</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <nav class="bg-gray-800 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-white font-bold text-xl">
                Todolist
            </div>
            <div class="flex space-x-4">
                @guest
                    <a href="/login" class="text-white">Login</a>
                    <a href="/register" class="text-white">Register</a>
                @else
                    <form method="POST" action="/logout">
                        @csrf
                        <button type="submit" class="text-white">Logout</button>
                    </form>
                @endguest
            </div>
        </div>
    </nav>
    <section class=" p-6 gap-10 flex flex-col max-w-5xl mx-auto">

        {{ $slot }}
    </section>
</body>

<script>
    function openEditModal(id, title, body) {
        document.getElementById('editForm').action = `/${id}`;
        document.getElementById('editTitle').value = title;
        document.getElementById('editBody').value = body;
        const modal = document.getElementById('editModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeEditModal() {
        const modal = document.getElementById('editModal');
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }
</script>

</html>
