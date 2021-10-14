<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Alert;
use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;
    
    public $isOpen=0;
    public $userId, $nama, $email, $password, $konfirmasi_password, $role, $seksi_id;
    public function render()
    {
        return view('livewire.user.users',[
            'i' => 1,
            'users' => User::latest()->paginate(5)
        ]);
    }

    public function showModal() {
        $this->isOpen = true;
    }

    public function hideModal() {
        $this->isOpen = false;
    }

    public function edit($id){
        $user = User::findOrFail($id);
        $this->userId = $id;
        $this->nama = $user->nama;
        $this->email = $user->email;
        $this->password = $user->password;
        $this->role = $user->role;
        $this->seksi_id = $user->seksi_id;
        $this->showModal();
    }

    public function store() {
        $this->validate([
            'nama' => 'required|min:3|max:50',
            'email' => 'required',
            'password' => 'min:6|max:20|required|same:konfirmasi_password',
            'konfirmasi_password' => 'min:6|max:20|required|same:password',
            'role' => 'required',
            'seksi_id' => 'required'
        ]);
        
        User::updateOrCreate(['id' => $this->userId],
        [
            'nama'=>$this->nama,
            'email'=>$this->email,
            'password'=>Hash::make($this->password),
            'role'=>$this->role,
            'seksi_id'=>$this->seksi_id
        ]);

        $this->hideModal();
        if ($this->userId)
            $this->emit('alert',['type'=>'success','message'=>'User Berhasil Diupdate','title'=>'Berhasil']);
        else
            $this->emit('alert',['type'=>'success','message'=>'User Berhasil Ditambahkan','title'=>'Berhasil']);
        $this->userId='';
        $this->nama='';
        $this->email='';
        $this->password='';
        $this->konfirmasi_password='';
        $this->role='';
        $this->seksi_id='';
        Alert::success('Berhasil','User Berhasil ditambahkan');
           
    }

    public function delete($id){
        User::find($id)->delete();
        $this->emit('alert',['type'=>'success','message'=>'User Berhasil Dihapus','title'=>'Berhasil']);
    }
   
}
