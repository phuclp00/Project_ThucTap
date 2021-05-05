<nav x-data="{ open: false }">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 md:flex ">
                    <x-jet-nav-link href="{{url('/giadiens')}}" :active="request()->routeIs('dashboard')">
                        {{ __('Thông tin giá điện mới nhất ') }}
                    </x-jet-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 md:flex">
                    <x-jet-nav-link href="{{ route('giadien') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Giá điện hiện tại của hệ thống ') }}
                    </x-jet-nav-link>
                </div>
            </div>
        </div>
    </div>
</nav>