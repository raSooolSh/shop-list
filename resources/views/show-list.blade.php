<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>برزگر</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />


    @vite('resources/css/app.css')
</head>

<body class="p-8">
    <div class="mb-4">
        <a class="bg-red-500 p-2 rounded-md" href="{{ route('home') }}">صفحه اصلی</a>
    </div>

    <form method="post" class="flex flex-col justify-center items-center w-full md:w-[80vw] mx-auto p-8 gap-4"
        action="{{ route('list-show') }}">
        @csrf
        <h1 class="font-bold text-3xl">لیست</h1>
        <div class="flex flex-col w-full md:w-2/3 border-2 border-gray-400 p-4 mx-auto" dir="rtl">
            @foreach ($products as $product)
                <div
                data-id="{{ $product->id }}"
                    class="product-row cursor-pointer p-4 flex flex-col md:flex-row md:justify-between justify-center items-center gap-4">
                    <div class="flex flex-row gap-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>

                        <span class="font-bold">{{ $product->product->name }}</span>
                    </div>

                    <span>{{ $product->quantity }} {{ $product->type == 'baste' ? 'بسته' : 'کارتن' }}</span>
                </div>
                @if (!$loop->last)
                    <hr>
                @endif
            @endforeach
        </div>
        <div class="flex flex-row self-start justify-start gap-4">
            <button class="self-start bg-lime-500 py-2 px-8 rounded-md">پاک کردن لیست</button>
        </div>
    </form>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.product-row').on('click', (e) => {
                let id = $(e.target).data('id')
                console.log(id)
                $(`.product-row[data-id="${id}"]`).addClass('bg-lime-200');
            })
        });
    </script>
</body>

</html>
