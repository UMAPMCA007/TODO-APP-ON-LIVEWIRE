<div class="container mt-5">
    
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
     @endif   
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header text-center">Todo List</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" class="form-control "  wire:model='todoItem'  placeholder="Enter Todo"> 
                                </div>
                            </div>
                            
                                <div class="col-md-3 form-group {{$class}}">
                                    <button wire:click="submit" id="submit" class="btn btn-success">Add Todo</button>
                                </div> 
                                <div class="col-md-3 form-group {{$div}}">
                                    <button wire:click="update"  class="btn btn-success">Update Todo</button>
                                </div>
                        </div>
                       
                            
                                <ul  wire:sortable="updateTaskOrder">
                                    @foreach ($todos as $task)
                                        <li class="row" wire:sortable.item="{{ $task['id'] }}" wire:key="task-{{ $task['id']}}">
                                             <h4  class='col-md-6' wire:sortable.handle>{{ $task['title'] }}</h4>
                                             <button class='col-md-2 btn btn-success mr-1'  wire:click="edit({{ $task['id']}})">Edit</button>
                                              <button class='col-md-2 btn btn-danger' wire:click="delete({{ $task['id']}})">Remove</button>
                                        </li><br>
                                    @endforeach
                                </ul> 
                                  
                      
                   
                   
                </div>
            </div>
        </div>
</div> 
