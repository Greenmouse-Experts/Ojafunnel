<ul class="nav nav-tabs nav-tabs-custom">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('user.view.overview', ["username" => Auth::user()->username, "uid" => $list->uid]) }}"><i class="bi bi-graph-up"></i> Overview</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="{{route('user.list.setting', ["username" => Auth::user()->username, "uid" => $list->uid])}}"><i class="bi bi-gear"></i> Setting</a>
    </li>
    <li class="nav-item">
        <div class="dropdown">
            <a class="nav-link" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-check"></i> Subscribers <i class="bi bi-caret-up"></i>
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{route('user.list.subscribers', ["username" => Auth::user()->username, "uid" => $list->uid])}}">View all</a></li>
                <li><a class="dropdown-item" href="{{route('user.new.subscribers', ["username" => Auth::user()->username, "uid" => $list->uid])}}">Add</a></li>
                <li><a class="dropdown-item" href="{{route('user.import.subscribers', ["username" => Auth::user()->username, "uid" => $list->uid])}}">Import</a></li>
              <li><a class="dropdown-item" href="{{route('user.export.subscribers', ["username" => Auth::user()->username, "uid" => $list->uid])}}">Export</a></li>
            </ul>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('user.new.segments', Auth::user()->username)}}"><i class="bi bi-layout-three-columns"></i> Segment</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#"><i class="bi bi-card-checklist"></i> Manage list fields</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#"><i class="bi bi-columns"></i> Form / Pages</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#"><i class="bi bi-envelope-check"></i> Email Verifications</a>
    </li>
</ul>
