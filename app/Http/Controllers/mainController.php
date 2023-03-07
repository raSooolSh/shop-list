<?php

namespace App\Http\Controllers;

use App\Models\Plist;
use App\Models\Product;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class mainController extends Controller
{
    public function showList()
    {
        return view('show-list')->with(['products' => Plist::orderby('created_at')->get()]);
    }

    public function submitList()
    {
        $listItem = Plist::all();

        foreach ($listItem as $item) {
            $item->delete();
        }


        return redirect()->route('home');
    }

    public function createList()
    {
        return view('create-list')->with([
            'products' => Product::orderBy('created_at')->get()
        ]);
    }

    public function sumbitCreate(Request $request)
    {
        if ($request->password != env('PASSWORD')) {
            throw ValidationException::withMessages(['password' => 'پسورد ورودی اشتباه است']);
        }

        $request->validate([
            'quantity' => 'required',
            'quantity.*' => 'integer|required',
            'type' => 'required',
            'type.*' => 'in:baste,carton'
        ], [
            'quantity.required' => 'تعداد الزامی است',
            'quantity.*.required' => 'تعداد الزامی است',
            'quantity.*.integer' => 'تعداد باید به صورت عدد باشد',
            'type.required' => 'نوع بسته بندی الزامی است',
            'type.*.in' => 'نوع بسته بندی باید در قالب کارتن یا بسته باشد'
        ]);


        foreach ($request->type as $key => $item) {
            Plist::create([
                'product_id' => $key,
                'quantity' => $request->quantity[$key],
                'type' => $item
            ]);
        }

        $data = [
            'apikey' => env('MAX_SMS_API'),
            'fnum' => env('MAX_SMS_NUMBER'),
            'tnum' => '+989393449262',
            'pid' => 'af02vw58uegdql4',
            'v1'=>'date',
            'p1'=>Jalalian::now()->toString()
        ];

        Http::get(env('MAX_SMS_URL'), $data)->throw();

        return redirect()->route('home');
    }

    public function addProduct()
    {
        return view('add-product');
    }

    public function sumbitAddProduct(Request $request)
    {
        $request->validate([
            'product' => 'required',
            'product.*' => 'required'
        ], [
            'product.required' => 'وجود حداقل یک مقدار الزامی است',
            'product.*.required' => 'وجود نام محصول الزامی است',
        ]);

        foreach ($request->product as $product) {
            Product::create([
                'name' => $product
            ]);
        }

        return redirect()->route('home');
    }
}
