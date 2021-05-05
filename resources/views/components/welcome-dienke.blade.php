<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    <div>
        <x-jet-application-logo class="block h-12 w-auto" />
    </div>
    <div class="mt-8 text-2xl">
        <p>
            <h1>Tình hình của hệ thống điện kế hiện tại :
                <b>{{ now()->day."/".now()->month."/".now()->year }}</b> !</h1>
        </p>
    </div>
</div>