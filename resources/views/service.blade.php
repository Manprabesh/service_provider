<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>
    <div>
        <form id="frm" method="post" action="/search/service">
            @csrf
            <input type="text" name="service_name" id="service_name" value="{{ old('service_name') }}"
                placeholder="Enter service name">
            <button type="submit" id="create_button">
                search
            </button>
        </form>


    </div>

    @session('null')
        <div class="alert alert-success" role="alert">
            {{ $value }}
        </div>
    @endsession

    @if(session('myData'))
        @foreach(session('myData') as $item)
            <!-- <p>ID: {{ $item['service_provice_id'] }}, Name: {{ $item['name'] }}</p> -->
            <div class="max-w-sm rounded overflow-hidden shadow-lg">
                @if($item['photo'])
                    <img class="w-full" src={{ $item['photo'] }} alt="Sunset in the mountains">
                @else
                    <img class="w-full" src="https://i.pinimg.com/736x/56/67/93/5667936906181a6fbe0501b471e2b5bd.jpg"
                        alt="Sunset in the mountains">
                @endif
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">{{ $item['service_type'] }}</div>
                    <p class="text-gray-700 text-base">
                        Name:{{ $item['name'] }},
                        Rs{{ $item['price'] }} per project
                        Email: {{ $item['email'] }}
                        Phone: {{ $item['phone'] }}
                    </p>
                    <form method="POST" action="{{ '/book/service' }}">
                        @csrf
                        <input type="hidden" name="service_email" value=" {{ $item['email'] }}">
                        <button type="submit" class="bg-blue-500 rounded-md px-4">Book</button>
                    </form>
                </div>

            </div>
        @endforeach
    @else
        <!-- <div class="flex h-screen"> -->
        <div class="grid grid-cols-3 gap-4 p-4 min-h-screen" style="height: 400px;" >
            <div class="bg-red-500  rounded-lg" >
                <a href="{{ '/service/cybersecurity' }}">

                    <img src="https://i.pinimg.com/736x/ea/06/8a/ea068a2fb7720f1ffcfe86bf7fcdcd3a.jpg" alt=""
                        class="h-70 w-auto object-contain">
                    <p class="mt-10">Cyber security</p>
                </a>
            </div>
            <div class="bg-red-500  rounded-lg">
                <a href="/service/cleaner">

                    <img src="https://i.pinimg.com/736x/1e/b8/07/1eb807c0307acd9e098a5b56b7c21182.jpg" alt=""
                        class="h-70 w-auto object-contain">
                    <p class="mt-10">cleaner</p>
                </a>
            </div>
            <div class="bg-red-500  rounded-lg">
                <img src="https://i.pinimg.com/736x/a8/f9/9d/a8f99dfd7631fbd123cdc567a7c63c39.jpg" alt=""
                    class="h-70 w-auto object-contain">
                <p class="mt-10">Driver</p>
            </div>
            <div class="bg-red-500  rounded-lg">
                <img src="https://i.pinimg.com/736x/5b/79/11/5b7911765a2ad889debb658c04759c98.jpg" alt=""
                    class="h-70 w-auto object-contain">
                <p class="mt-10">Plumber</p>
            </div>
            
        </div>
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