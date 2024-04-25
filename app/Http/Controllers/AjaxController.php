<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AjaxController extends Controller
{
    public function createBook(Request $request)
    {

        //`name_book`, `name_author`, `descrption`, `quantity`, `price`, `tax`, `featured_image`, `active`
        $request->validate([
            'name_book' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            // 'featured_image' => 'required'
        ],
        [
            'required' => 'هذا الحقل اجباري'
        ]);

        $Book = new Book();
        $imageName = NUll;
        if($request->hasFile('featured_image'))
        {
            $Image = $request->file("featured_image");
            $imageExtension = $Image->getClientOriginalExtension();
            $imageName = time().rand(1,100000).".".$imageExtension;
            $Image->storeAs('',$imageName,'book');
        }
        $Book->name_book = $request->name_book;
        $Book->name_author = $request->name_author;
        $Book->descrption = $request->descrption;
        $Book->quantity = $request->quantity;
        $Book->price = $request->price;
        $Book->tax = $request->tax;
        $Book->featured_image = $imageName;
        $Book->number_of_pages = $request->number_of_pages;
        $Book->category_id = $request->category_id;
        
        $Added = $Book->save();
        if($Added)
        {
            return response()->json(['code'=>1,'msg'=>'تم الاضافة بنجاح']);
        }
        else
        {
            return response()->json(['code'=>3,'msg'=>'حدث خطأ']);

        }


    }


    public function creatCustomer(Request $request)
    {
        //`name`, `email`, `phone`, `blocked`, `fav`, `location`
        $hash = Hash::make($request->name);

        $request->validate([
            'name' => 'required|unique:customers,name',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|numeric|digits:11',
        ]);

        $Added = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'fav' => $request->fav,
            'location' => $request->location,
            'hash' => $hash,
            'gender' => $request->gender,
            'user_id' => auth()->user()->id
         ]);  

         if($Added)
         {
             return response()->json(['code'=>1,'msg'=>'تم الاضافة بنجاح']);
         }
         else
         {
             return response()->json(['code'=>3,'msg'=>'حدث خطأ']);
 
         }

    }
}
