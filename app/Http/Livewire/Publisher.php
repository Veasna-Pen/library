<?php

namespace App\Http\Livewire;
use App\Models\Publisher as ModelsPublisher;
use Livewire\Component;
use Livewire\WithPagination;

class Publisher extends Component
{

    public $showTable = true;
    public $createForm = false;
    public $updateForm = false;
    public $publisher_name;
    public $search;
    public $publisher_id;
    public $edit_publisher_name;
    public $totalPublisher;

    use WithPagination;
    public function render()
    {
        $this->totalPublisher = ModelsPublisher::count();

        $searchTerm = '%'.$this->search.'%';
        if($this->search != ''){
            $publishers = ModelsPublisher::where('publisher_name', 'LIKE', $searchTerm)->orderBy('id', 'desc')->paginate(6);
            return view('livewire.publisher', compact('publishers'))->layout('layout.app');
        }
        $publishers = ModelsPublisher::orderBy('id', 'DESC')->paginate(6);
        return view('livewire.publisher', compact('publishers'))->layout('layout.app');
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
            'publisher_name' => ['required', 'string', 'unique:publishers'],
        ]);

        $result = ModelsPublisher::create($validate);
        if($result){
            session()->flash('success', 'Action completed');
            $this->showTable = true;
            $this->createForm = false;
            $this->author_name = '';
        }else{
            session()->flash('error', 'Action incomplete');
        }
    }

    public function editPublisher($id)
    {
        $this->showTable = false;
        $this->updateForm = true;
        $publishers = ModelsPublisher::findORFail($id);
        $this->publisher_id = $publishers->id;
        $this->edit_publisher_name = $publishers->publisher_name;
    }

    public function update($id)
    {
        $publishers = ModelsPublisher::findOrFail($id);
        $publishers->publisher_name = $this->edit_publisher_name;
        $result = $publishers->save();

        if($result){
            session()->flash('success', 'Action completed');
            $this->showTable = true;
            $this->updateForm = false;
            $this->edit_publisher_name = '';
        }else{
            session()->flash('error', 'Action incomplete');
        }
    }

    public function deletePublisher($id)
    {
        $publishers = ModelsPublisher::findOrFail($id);
        $result = $publishers->delete();
        if($result){
            session()->flash('success', 'Action completed');
        }else{
            session()->flash('error', 'Action incomplete');
        }
    }
    
    
}
