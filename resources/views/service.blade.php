<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
 <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css"
>
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
                </div>
                <form method="POST" action="{{ '/book/service' }}" id="booking-form">
                    @csrf
                    <input type="hidden" name="service_email" value="{{ $item['email'] }}" id=email> 
                     <input type="hidden" name="price" value="{{ $item['price'] }}">
                    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">

                    <button type="submit" class="bg-blue-500 rounded-md px-4">Book</button>
                </form>

            </div>
        @endforeach
    @else
        <!-- <div class="flex h-screen"> -->
        <div class="grid grid-cols-3 gap-4 p-4 min-h-screen" style="height: 400px;">
            <div class="bg-red-500  rounded-lg">
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
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>

// const email=document.querySelector("#email").value;

    name.value = name.value
    // console.log(email,"------")


    const orderId = "{{ session('order_id') }}";
    const email = "{{ session('service_email') }}";
    console.log("Order ID:", orderId);
    if (orderId && email) {
        pay()
    }
    // document.getElementById('rzp-button').onclick = 
    function pay() {

        const amountInRupees = 1500; // dynamically get this from your server or user input
        const amountInPaise = amountInRupees * 1000;
        let callback_url = "http://127.0.0.1:8000/done";

        var options = {
            "key": "{{ env('RAZORPAY_KEY') }}", // Razorpay key
            "amount": amountInPaise, // in paise (100 INR = 10000)
            "currency": "INR",
            "name": "Service Provider",
            "order_id": orderId,
            "description": "Test Transaction",
            "image": "https://www.itsolutionstuff.com/frontTheme/images/logo.png",
            "callback_url": callback_url,
            "prefill": {
                "email": email
            },
            "theme": {
                "color": "#ff7529"
            },

        };

        var rzp = new Razorpay(options);
        rzp.open();
        console.log("Rzpppp", rzp)
        // e.preventDefault();
    }


</script>

</html>