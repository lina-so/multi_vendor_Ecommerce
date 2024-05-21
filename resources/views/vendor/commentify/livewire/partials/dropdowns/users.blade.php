
<div class="dropdown z-10">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Select User
    </button>
    <div class="dropdown-menu dropdown-menu-right rounded-lg shadow w-60" aria-labelledby="dropdownMenuButton">
        <ul class="list-group list-group-flush h-48 overflow-y-auto">
            @foreach($users as $user)
                <li wire:click="selectUser('{{ $user->name }}')" wire:key="{{ $user->id }}" class="list-group-item">
                    <a class="d-flex align-items-center px-4 py-2 text-dark" href="#">
                        <img class="w-6 h-6 mr-2 rounded-circle" src="{{$user->avatar()}}" alt="{{ $user->name }}">
                        {{ $user->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
