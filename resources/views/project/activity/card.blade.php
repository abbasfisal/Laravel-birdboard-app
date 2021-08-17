<div class="card mt-3">
    <ul class="fs-6 list-unstyled ps-2 ">
        @foreach($project->activity as $activity)
            <li class="{{$loop->last ? 'shadow' : 'border'}}" style="font-size: smaller">
                @include("project.activity.{$activity->description}")
                <span class="text-muted badge badge-info " style="font-size: x-small">{{$activity->created_at->diffforHumans(null ,    true) }}</span>
            </li>
        @endforeach
    </ul>
</div>
