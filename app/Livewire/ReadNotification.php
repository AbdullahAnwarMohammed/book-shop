<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ReadNotification extends Component
{
    use WithPagination;
    public $tab = 1;
    public $per_page = 4;
    public $search = NULL;
    public function render()
    {
        /*    public function scopeSearch($query,$term)
    {
        $term = "%$term%";
        $query->where(function($query) use ($term){
            $query->where('name','like',$term);
        }); 
    }
*/
        $term = "%".$this->search."%";
        $notifications = DB::table('notifications')
        ->where('notifiable_type','App\Models\Admin')
        ->where('data->name','LIKE',$term)
        ->paginate($this->per_page);
        $notificationsUnFav = DB::table('notifications')->where('notifiable_type','App\Models\Admin')
        ->where('favorite',1)
        ->paginate($this->per_page);;
        return view('livewire.read-notification', [
            'notifications' => $notifications,
            'notificationsUnFav' => $notificationsUnFav
        ]);
     }

     public function updateDATA()
     {
        $this->render();
     }


     public function addFavorite($id,$tab)
     {
        $this->tab = $tab;
        DB::table("notifications")->where("id",$id)->update([
            'favorite' => 1
        ]);
        $this->dispatch('success', ['message' => 'تم وضعها ف المفضلة بنجاح', 'type' => 'success']);

     }

     public function removeFavorite($id,$tab)
     {
        $this->tab = $tab;
        DB::table("notifications")->where("id",$id)->update([
            'favorite' => 0
        ]);
        $this->dispatch('success', ['message' => 'تم حذفها من المفضلة', 'type' => 'success']);
     }
}
