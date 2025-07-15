<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>

    <form id="frm" method="post" action="/search/service">
        @csrf
        <input type="text" name="service_name" id="service_name" value="{{ old('service_name') }}"
            placeholder="Enter service name">
        <button type="submit" id="create_button">
            search
        </button>
    </form>

        @if(session('myData'))
        @foreach(session('myData') as $item)
            <p>ID: {{ $item['service_provice_id'] }}, Name: {{ $item['name'] }}</p>
            <div class="max-w-sm rounded overflow-hidden shadow-lg">
                <img class="w-full" src="https://i.pinimg.com/736x/56/67/93/5667936906181a6fbe0501b471e2b5bd.jpg"
                    alt="Sunset in the mountains">
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">{{ $item['service_name'] }}</div>
                    <p class="text-gray-700 text-base">
                        {{ $item['name'] }},
                        Rs{{ $item['price'] }} per project
                    </p>
                    <form method="POST" action="{{ '/book/service' }}">
                        @csrf
                        <input type="hidden" name="service_email" value=" {{ $item['email'] }}">
                        <button type="submit" class="bg-blue-500 rounded-md px-4">Book</button>
                    </form>
                </div>
                <div class="px-6 pt-4 pb-2">
                    <span
                        class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#photography</span>
                    <span
                        class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#travel</span>
                    <span
                        class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#winter</span>

        @endforeach
    @endif




</body>
<script>
    const service = document.querySelector('#frm');
    // const btn = document.querySelector('#btn')
    const name = document.querySelector('#service_name');
    service.addEventListener('submit', (e) => {
        // e.preventDefault();
        console.log('submitted')
        console.log('service type ->', name.value);
        if (name.value) {
        }
    })

    name.value = name.value
    console.log()
</script>

</html>