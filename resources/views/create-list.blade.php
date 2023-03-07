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
        action="{{ route('list-create') }}">
        @csrf
        <div class="flex flex-col w-full md:w-2/3 border-2 border-gray-400 p-4 mx-auto" dir="rtl">
            @foreach ($products as $product)
                <div class="p-4 flex flex-col md:flex-row md:justify-between justify-center items-center gap-4">
                    <input type="hidden" name="quantity[{{ $product->id }}]" value="0">
                    <input type="hidden" name="type[{{ $product->id }}]" value="baste">
                    <span class="font-bold">{{ $product->name }}</span>
                    <div class="flex flex-row gap-4 items-center">
                        <span data-id="{{ $product->id }}"
                            class="decrement bg-red-400 rounded-md p-2 cursor-pointer">-</span>
                        <span id="quantity_{{ $product->id }}" data-id="{{ $product->id }}">0</span>
                        <span data-id="{{ $product->id }}"
                            class="increment bg-lime-400 rounded-md p-2 cursor-pointer">+</span>
                        <span data-id="{{ $product->id }}"
                            class="type cursor-pointer bg-gray-400 p-2 rounded-md">بسته</span>
                    </div>
                </div>
                @if (!$loop->last)
                    <hr>
                @endif
            @endforeach
        </div>
        <div class="flex flex-row self-start justify-start gap-4">
            <button class="self-start bg-lime-500 py-2 px-8 rounded-md">ثبت</button>
            <input type="password" name="password" class="p-2 w-full md:w-1/2 rounded-md bg-white border-2 border-black"
                placeholder="پسورد" dir="rtl" />
        </div>
    </form>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.decrement').on('click', (e) => {
                let id = $(e.target).data('id')
                if ($(`#quantity_${id}`).html() > 0) {
                    $(`input[name="quantity[${id}]"]`).val(parseInt($(`#quantity_${id}`).html()) - 1)
                    $(`#quantity_${id}`).html(parseInt($(`#quantity_${id}`).html()) - 1);
                }
            })

            $('.increment').on('click', (e) => {
                let id = $(e.target).data('id')
                $(`input[name="quantity[${id}]"]`).val(parseInt($(`#quantity_${id}`).html()) + 1)
                $(`#quantity_${id}`).html(parseInt($(`#quantity_${id}`).html()) + 1);
            })

            $('.type').on('click', (e) => {
                let id = $(e.target).data('id')
                console.log($(`.type[data-id="${id}"]`)[0])
                console.log($($(`input[name="type[${id}]"]`)[0]).val())
                if ($($(`input[name="type[${id}]"]`)[0]).val() == 'baste') {
                    $($(`input[name="type[${id}]"]`)[0]).val('carton')
                    $($(`.type[data-id="${id}"]`)[0]).html('کارتن')
                } else {
                    $($(`input[name="type[${id}]"]`)[0]).val('baste')
                    $($(`.type[data-id="${id}"]`)[0]).html('بسته')
                }
            })
        });
    </script>
</body>

</html>
