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
        $this->resetValidation();
        $this->isOpen = false;
    }

    public function showModalUpdate() {
        $this->isOpenUpdate = true;
    }
    public function hideModalUpdate() {
        $this->clearCache();
        $this->resetValidation();
        $this->isOpenUpdate = false;
    }

    public function showModalPass() {
        $this->isOpenPass = true;
    }
    public function hideModalPass() {
        $this->clearCache();
        $this->resetValidation();
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

        $validatedData = $this->validate(
            [
                'nama' => 'required',
                'email' => 'required',
                'password' => 'min:6|required|same:konfirmasi_password',
                'konfirmasi_password' => 'min:6|required|same:password',
                'role' => 'required',
                'seksi_id' => 'required'
            ],
            [
                'nama.required' => 'Form :attribute tidak boleh kosong',
                'email.required' => 'Form :attribute tidak boleh kosong',
                'password.required' => 'Form :attribute tidak boleh kosong',
                'konfirmasi_password.required' => 'Form :attribute tidak boleh kosong',
                'role.required' => 'Form :attribute tidak boleh kosong',
                'seksi_id.required' => 'Form :attribute tidak boleh kosong',
                'password.min' => 'Form :attribute minimal 6 karakter',
                'konfirmasi_password.min' => 'Form :attribute minimal 6 karakter',
                'password.same' => 'Form :attribute harus sama dengan Konfirmasi Password',
                'konfirmasi_password.same' => 'Form :attribute sama dengan Passowrd',
            ],
            [
                'nama' => 'Nama',
                'email' => 'Email',
                'password' => 'Password',
                'konfirmasi_password' => 'Konfirmasi Password',
                'role' => 'Role',
                'seksi_id' => 'Seksi',
            ]
        );
        
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

        $validatedData = $this->validate(
            [
                'nama' => 'required',
                'email' => 'required',
                'role' => 'required',
                'seksi_id' => 'required'
            ],
            [
                'nama.required' => 'Form :attribute tidak boleh kosong',
                'email.required' => 'Form :attribute tidak boleh kosong',
                'role.required' => 'Form :attribute tidak boleh kosong',
                'seksi_id.required' => 'Form :attribute tidak boleh kosong',
            ],
            [
                'nama' => 'Nama',
                'email' => 'Email',
                'role' => 'Role',
                'seksi_id' => 'Seksi',
            ]
        ); 

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

        $validatedData = $this->validate(
            [
                'password' => 'min:6|required|same:konfirmasi_password',
                'konfirmasi_password' => 'min:6|required|same:password'
            ],
            [
                'password.required' => 'Form :attribute tidak boleh kosong',
                'konfirmasi_password.required' => 'Form :attribute tidak boleh kosong',
                'password.min' => 'Form :attribute minimal 6 karakter',
                'konfirmasi_password.min' => 'Form :attribute minimal 6 karakter',
                'password.same' => 'Form :attribute harus sama dengan Konfirmasi Password',
                'konfirmasi_password.same' => 'Form :attribute sama dengan Passowrd'
            ],
            [
                'password' => 'Password',
                'konfirmasi_password' => 'Konfirmasi Password'
            ]
        );
        
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
