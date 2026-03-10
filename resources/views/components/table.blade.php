@props(['headers', 'rows' => null])

<div class="relative overflow-x-auto shadow-sm sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
            <tr>
                @foreach($headers as $header)
                    <th scope="col" class="px-6 py-3">
                        {{ $header }}
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @if($rows)
                @foreach($rows as $row)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        {{ $row }}
                    </tr>
                @endforeach
            @else
                {{ $slot }}
            @endif
        </tbody>
    </table>
</div>
