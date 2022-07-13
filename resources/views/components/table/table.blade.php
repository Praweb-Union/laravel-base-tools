<div class="align-middle min-w-full overflow-x-visible  sm:rounded-lg">

    <div class="pb-5 border-b border-gray-200 flex items-center justify-between px-4 py-4">
        {{ $header ?? '' }}
    </div>

    <table class="min-w-full divide-y divide-cool-gray-200">
        <thead>
        <tr>
            {{ $head ?? '' }}
        </tr>
        </thead>

        <tbody class="bg-white divide-y divide-cool-gray-200">
        {{ $body ?? '' }}
        </tbody>
    </table>

    {{ $footer ?? '' }}

</div>
