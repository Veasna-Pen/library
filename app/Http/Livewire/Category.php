<?php

namespace App\Http\Livewire;
use App\Models\Category as ModelsCategory;
use Livewire\Component;
use Livewire\WithPagination;

class Category extends Component
{

    public $showTable = true;
    public $createForm = false;
    public $updateForm = false;
    public $category_name;
    public $search;
    public $category_id;
    public $edit_category_name;
    public $totalCategory;

    use WithPagination;
    public function render()
    {
        $this->totalCategory = ModelsCategory::count();

        $searchTerm = '%'.$this->search.'%';
        if($this->search != ''){
            $categories = ModelsCategory::where('category_name', 'LIKE', $searchTerm)->orderBy('id', 'desc')->paginate(6);
            return view('livewire.category', compact('categories'))->layout('layout.app');
        }
        $categories = ModelsCategory::orderBy('id', 'DESC')->paginate(6);
        return view('livewire.category', compact('categories'))->layout('layout.app');
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

    public function store()
    {
        $validate = $this->validate([
            'category_name' => ['required', 'string', 'unique:categories'],
        ]);

        $result = ModelsCategory::create($validate);
        if($result){
            session()->flash('success', 'Action completed');
            $this->showTable = true;
            $this->createForm = false;
            $this->category_name = '';
        }else{
            session()->flash('error', 'Action incomplete');
        }
    }

    public function editCategory($id)
    {
        $this->showTable = false;
        $this->updateForm = true;
        $categories = ModelsCategory::findORFail($id);
        $this->category_id = $categories->id;
        $this->edit_category_name = $categories->category_name;
    }

    public function update($id)
    {
        $categories = ModelsCategory::findOrFail($id);
        $categories->category_name = $this->edit_category_name;
        $result = $categories->save();

        if($result){
            session()->flash('success', 'Action completed');
            $this->showTable = true;
            $this->updateForm = false;
            $this->edit_category_name = '';
        }else{
            session()->flash('error', 'Action incomplete');
        }
    }

    public function deleteCategory($id)
    {
        $categories = ModelsCategory::findOrFail($id);
        $result = $categories->delete();
        if($result){
            session()->flash('success', 'Action completed');
        }else{
            session()->flash('error', 'Action incomplete');
        }
    }
    
    
}
