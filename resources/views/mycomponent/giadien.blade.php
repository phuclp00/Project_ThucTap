<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Thông tin giá điện mới nhất') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <x-nav-giadien />
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome_giadien />
                <div class="w-4/5" style="margin: 0px auto">
                    {!!$title !!}
                </div>
                <div class="border-dotted border-4 border-light-blue-500 w-4/5" style="margin: 20px auto;padding:20px">
                    <ul>{!! $content!!}</ul>
                </div>
                <div>

                </div>
                <table class="table-auto w-full">
                    {!! $data !!}
                </table>
            </div>
        </div>
    </div>
</x-app-layout>