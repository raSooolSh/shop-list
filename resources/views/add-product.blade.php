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

    @if ($errors->any())
        <div class="bg-rose-500 p-4 text-white w-full md:w-1/2 mx-auto" dir="rtl">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" class="flex flex-col justify-center items-center w-full md:w-[80vw] mx-auto p-8 gap-4"
        action="{{ route('add-product') }}">
        @csrf
        <input name="product[]" class="p-2 w-full md:w-1/2 rounded-md bg-white border-2 border-black"
            placeholder="نام محصول " dir="rtl" />
        <button id="add_input" type="button" class="px-2 py-1 bg-red-800 rounded-full">+
        </button>
        <button class="self-start bg-lime-500 py-2 px-8 rounded-md">ثبت</button>
    </form>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#add_input').on('click', () => {
                let input = $(`<input name="product[]" class="p-2 w-full md:w-1/2 rounded-md bg-white border-2 border-black"
                placeholder="نام محصول " dir="rtl" />`)
                input.insertBefore('#add_input');
            })
        });
    </script>
</body>

</html>
