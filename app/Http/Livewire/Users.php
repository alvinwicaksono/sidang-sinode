<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Seksi;
use Alert;
use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;
    public $search;
    public $isOpen=0;
    public $isOpenUpdate=0;
    public $isOpenPass=0;
    public $userId, $nama, $email, $password, $konfirmasi_password, $role='', $seksi_id='';
    public function render()
    {
        $search = '%'.$this->search. '%';
        return view('livewire.user.users',[
            'seksis' => Seksi::orderBy('id','asc')->get(),
            'users' => User::join('seksis','users.seksi_id','=','seksis.id')
                            ->where('users.nama','LIKE',$search)
                            ->orWhere('users.email','LIKE',$search)
                            ->orWhere('users.role','LIKE',$search)
                            ->orWhere('seksis.nama','LIKE',$search)
                            ->select('*','users.id as us_id', 'users.nama as nama_user')
                            ->orderBy('users.id', 'desc')
                            ->paginate(5)
        ]);
    }

    private function clearCache(){
        $this->userId='';
        $this->nama='';
        $this->email='';
        $this->role='';
        $this->seksi_id='';
        $this->password='';
        $this->konfirmasi_password='';
    }

    public function showModal() {
        $this->isOpen = true;
    }
    public function hideModal() {
        $this->clearCache();
        $this->isOpen = false;
    }

    public function showModalUpdate() {
        $this->isOpenUpdate = true;
    }
    public function hideModalUpdate() {
        $this->clearCache();
        $this->isOpenUpdate = false;
    }

    public function showModalPass() {
        $this->isOpenPass = true;
    }
    public function hideModalPass() {
        $this->clearCache();
        $this->isOpenPass = false;
    }

    public function edit($id){
        $user = User::find($id);

        $this->userId = $id;
        $this->nama = $user->nama;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->seksi_id = $user->seksi_id;
        $this->showModalUpdate();
    }

    public function pass($id){
        $user = User::find($id);
        $this->userId = $id;
        $this->nama = $user->nama;
        $this->showModalPass();
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
        
        User::create(
        [
            'nama'=>$this->nama,
            'email'=>$this->email,
            'password'=>Hash::make($this->password),
            'role'=>$this->role,
            'seksi_id'=>$this->seksi_id
        ]);

        $this->hideModal();
        $this->emit('alert',['type'=>'success','message'=>'User Berhasil Ditambahkan','title'=>'Berhasil']);
    }

    public function update() {
        $this->validate([
            'nama' => 'required|min:3|max:50',
            'email' => 'required',
            'role' => 'required',
            'seksi_id' => 'required'
        ]);

        $user = User::find($this->userId);

        $user->update(
        [
            'nama'=>$this->nama,
            'email'=>$this->email,
            'role'=>$this->role,
            'seksi_id'=>$this->seksi_id
        ]);

        $this->hideModalUpdate();
        $this->emit('alert',['type'=>'success','message'=>'User Berhasil Diupdate','title'=>'Berhasil']);
    }

    public function password() {
        $this->validate([
            'password' => 'min:6|max:20|required|same:konfirmasi_password',
            'konfirmasi_password' => 'min:6|max:20|required|same:password',
        ]);
        
        $user = User::find($this->userId);
        
        $user->update(
        [
            'password'=>Hash::make($this->password),
        ]);

        $this->hideModalPass();
        $this->emit('alert',['type'=>'success','message'=>'Password User Berhasil Diupdate','title'=>'Berhasil']);
    }

    public function delete($id){
        User::find($id)->delete();
        $this->clearCache();
        $this->emit('alert',['type'=>'success','message'=>'User Berhasil Dihapus','title'=>'Berhasil']);
    }
   
}
