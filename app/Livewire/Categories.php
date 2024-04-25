<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;
    public $per_page = 8;
    public $count = 0;
    public $name,$id,$active = true;
    public $search;
    public $listeners = [
        'updateDATA' => '$refresh',
        'deleteCategoryAction',
        'resetModalForm'
    ];

  

    public function render()
    {
        $Categories = Category::search(trim($this->search))->paginate($this->per_page);
        $this->count = Category::search(trim($this->search))->count();
        return view('livewire.categories',[
            'Categories'=>$Categories
        ]);
    }

    public function resetModalForm()
    {

        $this->resetErrorBag();
        $this->active = true;
        $this->name =  NULL;
    }

    // Add Category
    public function toggleActive()
    {
        return $this->active !== false ? '1' : '0';
    }
    
    public function HandlerAdd()
    {
       $this->validate([
        'name' => 'required|min:5|unique:categories,name'
       ],[
        'required' => 'هذا الحقل اجباري'
       ]);

       $saved = $Category = Category::create(
        [
            'name' => $this->name,
            'active' => $this->toggleActive()
        ]
        );
        if($saved)
        {
            $this->dispatch('hideCategoryModal');
            $this->name = null;
            $this->dispatch('success', ['message' => 'تم اضافة القسم بنجاح', 'type' => 'success']);
            $this->dispatch('updateDATA');
        }
        else{
            $this->dispatch('error', ['message' => 'يوجد خطأ', 'type' => 'error']);

        }
    }



    // Delete Category 
    public function deleteCategory($Item)
    {
        $this->dispatch('deleteCategory',[
            'title' => 'هل انت متاكد ',
            'html' => 'سوف تقوم بحذف العنصر :'.$Item['name'],
            'id' => $Item['id']
        ]);
    }

    // Handler Search
    public function handlerSearch()
    {
       $this->render();
    }


    public function deleteCategoryAction($id)
    {
        try{
            $delete = Category::findOrFail($id)->delete();
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


    public function editCategory($category)
    {
        $active = $category['active'] == '1' ? true : false;
       $this->id = $category['id'];
       $this->name = $category['name'];
        $this->active = $active;
       $this->dispatch('showEditCategoryModal');

    }

    public function HandlerUpdate()
    {
        $this->validate([
            'name' => 'required|min:5|unique:categories,name,'.$this->id
        ],[
            'unique' => 'الاسم مستخدم من قبل'
        ]); 
        
       try{
        $Updated = Category::find($this->id)->update([
            'name' => $this->name,
            'active' => $this->toggleActive()
        ]);
        if($Updated)
        {
            $this->dispatch('success', ['message' => 'تم تعديل البيانات بنجاح', 'type' => 'success']);
            $this->dispatch('hideEditCategoryModal');

        }
       }catch(\PDOException $e)
       {
        $this->dispatch('error', ['message' => 'حدث خطأ', 'type' => 'success']);

       }
    }

    
}

