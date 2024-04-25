<?php

namespace App\Livewire;

use App\Models\Purchase;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use PDOException;

class Sellers extends Component
{
    use WithFileUploads;
    public $name,$email,$password,$image,$id;
    public $counts;
    public $search;
    public $per_page = 8;
    public $Purchase = [];
    public $listeners = [
        'deleteSellerAction'
    ];
    public function render()
    {
        $this->counts =  User::search(trim($this->search))->count();
        $Users = User::search(trim($this->search))->paginate($this->per_page);


        return view('livewire.sellers',
    [
        'Users' => $Users
    ]
);
    }
    public function handlerSearch()
    {
        $this->render();
    }

    public function HandlerAdd()
    {
        

        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        try{
            $Image = null;
            if($this->image !== null)
            {
                $imageExtension = $this->image->getClientOriginalExtension();
                $Image = time().rand(1,100000).".".$imageExtension;
                $this->image->storeAs('',$Image,'seller');
            }
            $Added = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'image' => $Image
            ]);
            if($Added)
            {
                $this->dispatch('hideModalAddSeller');
                $this->dispatch('success', ['message' => 'تم الاضافة بنجاح', 'type' => 'success']);
            }
        }
        catch(PDOException $e)
        {
            $this->dispatch('error', ['message' => 'يوجد خطأ', 'type' => 'error']);

        }
    }

    public function deleteSeller($Item)
    {
        $this->dispatch('deleteeSeller',[
            'title' => 'هل انت متاكد ',
            'html' => 'سوف تقوم بحذف العنصر :'.$Item['name'],
            'id' => $Item['id']
        ]);
    }

    public function deleteSellerAction($id)
    {
        try{
            $delete = User::findOrFail($id)->delete();
            if($delete)
            {
                $this->dispatch('success', ['message' => 'تم اضافة القسم بنجاح', 'type' => 'success']);
            }
            else 
            {
                $this->dispatch('error', ['message' => 'حدث خطأ', 'type' => 'success']);
            }

        }catch(\PDOException $e)
        {
            $this->dispatch('error', ['message' => 'حدث خطأ', 'type' => 'success']);
        }
    }

    public function editSeller($Item)
    {
        $this->id = $Item['id'];
        $this->name = $Item['name'];
        $this->email = $Item['email'];
        $this->dispatch('showEditSellerModal');
    }

    public function HandlerUpdate()
    {
        
        $this->validate([
            'name' => 'required|min:5|unique:users,name,'.$this->id,
            'email' => 'required|min:5|email|unique:users,email,'.$this->id,
        ],[
            'unique' => 'الاسم مستخدم من قبل'
        ]); 
      
        
        
        $User = User::findOrFail($this->id);
        if($this->image !== NULL)
        {
            if(file_exists(public_path("admin/uploads/sellers/".$User->image)) && $User->image !== NULL)
            unlink(public_path("admin/uploads/sellers/".$User->image));

            $imageExtension = $this->image->getClientOriginalExtension();
            $Image = time().rand(1,100000).".".$imageExtension;
            $this->image->storeAs('',$Image,'seller');
        }
        else 
        {
            $Image = $User->image;
        }
        $password = $this->password !== NULL ? Hash::make($this->password) : $User->password;

        $Updated = $User->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $password,
            'image' => $Image
        ]);
        if($Updated)
        {
            $this->dispatch('success', ['message' => 'تم التعديل بنجاح', 'type' => 'success']);
            $this->dispatch('hideEditSellerModal');

        }
    }

    // الخزانة
    public function ModalCabinet($item)
    {  
        $Purchase = Purchase::whereDate("created_at",date("Y-m-d"))
        ->where('recovery',0)
        ->where('user_id',$item['id'])
        ->get();
        $this->Purchase = $Purchase;
    }
}
