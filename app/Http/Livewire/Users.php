<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Alert;
use Illuminate\Support\Facades\Hash;

class Users extends Component
{
    public $users;
    public $isOpen=0;
    public $userId, $nama, $email, $password, $konfirmasi_password, $role, $seksi_id;
    public function render()
    {
        $this->users = User::all();
        return view('livewire.user.users');
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
            'nama' => 'required',
            'email' => 'required',
            'password' => 'required',
            'konfirmasi_password' => 'required',
            'role' => 'required',
            'seksi_id' => 'required'
        ]);

        $password = $this->password;
        $konfirmasi_password = $this->konfirmasi_password;

        if($password == $konfirmasi_password) {
        
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
        
        } else {
            Alert::success('Gagal','Password harus sama');
        }
           
    }

    public function delete($id){
        User::find($id)->delete();
    }
   
}
