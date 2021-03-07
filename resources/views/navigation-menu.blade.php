<nav class="max-w-2xl mx-auto">
    <div class="pt-6 px-6 lg:px-8 flex flex-col">
        <form method="POST" action="{{ route('logout') }}" class="self-end italic text-blue-500 underline font-semibold">
            @csrf
            <a href="{{ route('logout') }}"
                        class="text-lg"
                        onclick="event.preventDefault();
                            this.closest('form').submit();">
                {{ __('Log Out') }}
            </a>
        </form>

        <a href="{{ route('ledger') }}" :active="request()->routeIs('ledger')" class="self-center font-bold text-8xl underline">
            {{ __('Ledger') }}
        </a>
    </div>
</nav>
