<li class="media mt-4 mb-4">
    <a href="{{route('users.show', $user->id)}}"><img src="{{$user->gravatar()}}" class="mr-3 gravatar"></a>
    <div class="media-body">
        <h5 class="mt-0 mb-1">
            {{$user->name}}<small>/ {{$status->created_at->diffForHumans()}}</small> {{$status->content}}
        </h5>
    </div>
    @can('destroy', $status)
        <form action="{{route('statuses.destroy',$status->id)}}" method="POST" onsubmit="if (!confirm('确定要删除吗？')) return false;">
            {{csrf_field()}}
            {{method_field('DELETE')}}
            <button type="submit" class="btn btn-sm btn-danger">删除</button>
        </form>
    @endcan
</li>
