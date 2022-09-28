<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Student as ModelsStudent;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Student extends Component
{

    public $showTable = true;
    public $createForm = false;
    public $updateForm = false;

    public $name;
    public $email;
    public $address;
    public $phone;
    public $gender;
    public $class;

    public $edit_name;
    public $edit_email;
    public $edit_address;
    public $edit_phone;
    public $edit_gender;
    public $edit_class;

    public $student_id;
    public $search;
    public $totalStudent;

    use WithPagination;
    public function render()
    {
        $this->totalStudent = ModelsStudent::count();

        $searchTerm = '%'.$this->search.'%';
        if($this->search != ''){
            $students = ModelsStudent::where('name', 'LIKE', $searchTerm)->orderBy('id', 'desc')->paginate(6);
            return view('livewire.student', compact('students'))->layout('layout.app');
        }
        $students = ModelsStudent::orderBy('id', 'DESC')->paginate(6);
        return view('livewire.student', compact('students'))->layout('layout.app');
    }

    public function showForm()
    {
        $this->showTable = false;
        $this->createForm = true;
    }

    public function goBack()
    {
        $this->showTable = true;
        $this->createForm = false;
        $this->updateForm = false;
    }

    public function resetFields()
    {
        $this->name = "";
        $this->email = "";
        $this->phone = "";
        $this->address = "";
        $this->gender = "";
        $this->class = "";

        $this->edit_name = "";
        $this->edit_email = "";
        $this->edit_phone = "";
        $this->edit_address = "";
        $this->edit_gender = "";
        $this->edit_class = "";
    }

    public function store()
    {
        $validate = $this->validate([
            'name' => ['required', 'string', 'unique:students'],
            'email' => ['required', 'string', 'unique:students'],
            'phone' => ['required', 'string', 'unique:students'],
            'address' => ['required'],
            'gender' => ['required'],
            'class' => ['required'],
            
        ]);

        $result = ModelsStudent::create($validate);
        if($result){
            session()->flash('success', 'Action completed');
            $this->showTable = true;
            $this->createForm = false;
            $this->resetFields();
        }else{
            session()->flash('error', 'Action incomplete');
        }
    }

    public function editStudent($id)
    {
        $this->showTable = false;
        $this->updateForm = true;
        $students = ModelsStudent::findORFail($id);

        $this->student_id = $students->id;
        $this->edit_name = $students->name;
        $this->edit_email = $students->email;
        $this->edit_phone = $students->phone;
        $this->edit_address = $students->address;
        $this->edit_gender = $students->gender;
        $this->edit_class = $students->class;
    }

    public function update($id)
    {
        $students = ModelsStudent::findOrFail($id);

        $this->edit_name = $students->name;
        $this->edit_email = $students->email;
        $this->edit_phone = $students->phone;
        $this->edit_address = $students->address;
        $this->edit_gender = $students->gender;
        $this->edit_class = $students->class;

        $result = $students->save();

        if($result){
            session()->flash('success', 'Action completed');
            $this->showTable = true;
            $this->updateForm = false;
            $this->resetFields();
        }else{
            session()->flash('error', 'Action incomplete');
        }
    }

    public function deleteStudent($id)
    {
        $students = ModelsStudent::findOrFail($id);
        $result = $students->delete();
        if($result){
            session()->flash('success', 'Action completed');
        }else{
            session()->flash('error', 'Action incomplete');
        }
    }
    
}
