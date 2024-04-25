<?php

namespace App\Livewire;

use App\Models\Book;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Purchase;
use Livewire\Component;
use Livewire\WithFileUploads;
use PDOException;

class Books extends Component
{
    use WithFileUploads;
    //`name_book`, `name_author`, `descrption`, `quantity`, `price`, `tax`, `featured_image`
    public $name_book,$name_author,$descrption,$quantity,$price,$tax,$featured_image,$id,$category_id;
    public $per_page = 8;
    public $search = null;
    public $counts = 0;
    public $category = "";


    // sell of a book
    public $type_pay;
    public $customer;
    public $price_book;

    public $listeners = [
        
        'refreshBooks' => '$refresh',
        'deleteBookAction',
        'resetModalForm'
    ];

    public function resetModalForm()
    {
        $this->resetErrorBag();

    }

    public function render()
    {
        if(!empty($this->category))
        {
            $this->counts =   Book::search(trim($this->search))
            ->where('category_id',$this->category)
            ->where('active','1')
            ->count();

            $Books = Book::search(trim($this->search))
            ->where('category_id',$this->category)
            ->where('active','1')
            ->paginate($this->per_page);
        }
        else 
        {
            $this->counts =  Book::search(trim($this->search))
            ->where('active','1')

            ->count();
            $Books = Book::search(trim($this->search))
            ->where('active','1')
            ->paginate($this->per_page);
        }

        return view('livewire.books',
        [
            'Books' => $Books
        ]);
    }

    public function handlerSearch()
    {
        $this->render();
    }

    public function deleteBook($Item)
    {
        $this->dispatch('deleteBook',[
            'title' => 'هل انت متاكد ',
            'html' => 'سوف تقوم بحذف العنصر :'.$Item['name_book'],
            'id' => $Item['id']
        ]);
    }

    public function deleteBookAction($id)
    {
        try{
            $deleted = Book::findOrFail($id)->delete();
            if($deleted)
            {
                $this->dispatch('success', ['message' => 'تم حذف العنصر', 'type' => 'success']);

            }
        }catch(PDOException $ex)
        {
            $this->dispatch('error', ['error' => 'حدث خطأ', 'type' => 'error']);

        }
       
    }

    public function editBook($Item)
    {
        $this->id = $Item['id'];
        $this->name_book = $Item['name_book'];
        $this->name_author = $Item['name_author'];
        $this->descrption = $Item['descrption'];
        $this->quantity = $Item['quantity'];
        $this->price = $Item['price'];
        $this->tax = $Item['tax'];
        $this->featured_image = $Item['featured_image'];
        $this->category_id = $Item['category_id'];
        $this->dispatch('showEditBookModal');
    }

    public function UpdateBook()
    {
        $this->validate([
            'name_book' => 'required',
            'quantity' => 'required',
            'price' => 'required',
        ],
        [
            'required' => 'هذا الحقل اجباري'
        ]);
        
      
        
        
        $Book = Book::findOrFail($this->id);
        if($this->featured_image !== NULL && $this->featured_image != $Book->featured_image)
        {
            $imageExtension = $this->featured_image->getClientOriginalExtension();
            $Image = time().rand(1,100000).".".$imageExtension;
            $this->featured_image->storeAs('',$Image,'book');

            if(file_exists(public_path("admin/uploads/books/".$Book->featured_image)) && $Book->featured_image !== NULL)
            unlink(public_path("admin/uploads/books/".$Book->featured_image));
        
        }
        else 
        {
            $Image = $Book->featured_image;
        }



        $Updated = $Book->update([
            'name_book' => $this->name_book,
            'name_author' => $this->name_author,
            'descrption' => $this->descrption,
            'quantity'=>$this->quantity,
            'price' => $this->price,
            'tax' => $this->tax,
            'featured_image' => $Image
        ]);
        if($Updated)
        {
            $this->dispatch('success', ['message' => 'تم التعديل بنجاح', 'type' => 'success']);
            $this->dispatch('hideEditBookModal');

        }

    }


    // Sell Book 
    public function SellBook($item)
    {
        $this->customer = NULL;
        $this->type_pay = NULL;
        $this->name_book = $item['name_book'];
        $this->id = $item['id'];
        $this->quantity = $item['quantity'];

        $this->price_book = $item['tax'] !== NULL ?  $item['price'] *  $item['tax'] / 100 : $item['price'];
        $this->dispatch('showWizzardSellBook');
    }

    public function HandlerSellBook()
    {

        $this->validate([
            'type_pay' => 'required',
            'customer' => 'required|exists:customers,hash'
        ],
        [
            'required' => 'هذا الحقل مطلوب',
            'exists' => 'لم يتم العثور على البيانات'
        ]);

        // طرح الكتاب
        Book::where("id",$this->id)->update([
            'quantity' => $this->quantity - 1
        ]);

        $Customer = Customer::where('hash',$this->customer)->first();
        if($this->type_pay == 'cash')
        {
           if($Customer->cash < $this->price_book)
           {
            $this->dispatch('error', ['message' => 'لا يوجد رصيد كافي', 'type' => 'error']);
           }
           else
           {
            
            Customer::where('hash',$this->customer)->update([
                'cash' => $Customer->cash - $this->price_book
            ]);
            $Added = Purchase::create([
                'book_id' => $this->id, 
                'user_id' => auth()->user()->id,
                'customer_id' => $Customer->id,
                'cost' => $this->price_book
            ]);

            if($Added)
            {
                $this->dispatch('hideWizzardSellBook');
                $this->dispatch('success', ['message' => 'تم بنجاح', 'type' => 'success']);
            }
           }
        }
        else{
            $Added = Purchase::create([
                'book_id' => $this->id, 
                'user_id' => auth()->user()->id,
                'customer_id' => $Customer->id,
                'cost' => $this->price_book
            ]);
            if($Added)
            {
                $this->dispatch('hideWizzardSellBook');

                $this->dispatch('success', ['message' => 'تم بنجاح', 'type' => 'success']);

            }
        }
    }

    public function addToCart($item)
    {   
        if($item['tax'] !== NULL)
        {
            $price = $item['price'] *  $item['tax'] / 100;
        }
        else 
        {
            $price = $item['price'];
        }
        $Cart = new Cart();
        $Cart->book_id = $item['id'];
        $Cart->user_id = auth()->user()->id;
        $Cart->cost = $price;
        $Cart->save();
       
        $this->dispatch('success', ['message' => 'تم الاضافة الى السلة بنجاح', 'type' => 'success']);

    }

   
}
