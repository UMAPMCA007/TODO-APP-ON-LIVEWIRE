<?php

namespace App\Http\Livewire\Todo;

use Livewire\Component;
use App\Models\Todo;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CreateTodo extends Component
{
    use LivewireAlert;

    public $todoItem,$class,$todo_id,$div='d-none';
    public $todos;

    public function mount()
    {
        $todos = Todo::orderBy('order','asc')->get();
        $this->todos = $todos;
       
    }

    public function render()
    {
        
        return view('livewire.todo.create-todo');
    }

    public function submit()
    {
        $todo = new Todo();
        $todo->title = $this->todoItem;
        $todo->order=null;  
        $todo->save();
        $this->todoItem = '';
        $this->alert('success', 'Todo Created Successfully');
        $this->mount();
    }

    public function edit($id)
    {   
        $this->todo_id=$id;
        $todo = Todo::find($id);
        $this->todoItem = $todo->title;
        $this->class='d-none';
        $this->div='';
       
    }

    public function update()
    {
        $id=$this->todo_id;
        $todo = Todo::find($id);
        $todo->title = $this->todoItem;
        $todo->save();
        $this->todoItem = '';
        $this->div='d-none';
        $this->class='';
        $this->alert('success', 'Todo Updated Successfully');
        $this->mount();
    }

    public function delete($id)
    {
        $todo = Todo::find($id);
        $todo->delete();
        $this->alert('success', 'Todo Deleted Successfully');
        $this->mount();
    }

   public function updateTaskOrder($orderedIds)
    {
        // $this->todos=collect($orderedIds)->map(function($id) {
        //     return collect($this->todos)->where('id',$id['value'])->first();   
        // })->toArray();

        $this->todos=collect($orderedIds)->map(function($id) {
            $todos=Todo::find($id['value']);
            $todos->order=$id['order'];
            $todos->save();
            })->toArray();

            $this->todos=Todo::orderBy('order','asc')->get();
     
    } 

}
