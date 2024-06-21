<x-layout>
    <form method="POST" action="/login">
        @csrf

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12 flex justify-center">
                <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md ">
                    <x-form-field>
                        <x-form-label for="email">Email</x-form-label>

                        <x-form-field>
                            <x-form-input name="email" id="email" type="email" required />

                            <x-form-error name="email" />
                        </x-form-field>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="password">Password</x-form-label>

                        <x-form-field>
                            <x-form-input name="password" id="password" type="password" required />

                            <x-form-error name="password" />
                        </x-form-field>
                    </x-form-field>
                    <div class="mt-6 flex items-center justify-end gap-x-6">
                        <x-form-button>Log In</x-form-button>
                    </div>
                </div>

            </div>
        </div>


    </form>
</x-layout>
