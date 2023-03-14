<ul class="nav nav-tabs nav-underline mb-4 timeline-tab">
    <li class="nav-item dropdown">
        <a href="javascript:;" class="nav-link {{ controllerAction() == 'user.automation.contacts' ? 'active' : '' }}" onclick="timelinePopup.load('{{ route('user.automation.contacts', [
            'username' => Auth::user()->username,
            'uid' => $automation->uid,
        ]) }}')">
            {{ trans('messages.automation.audience') }}
        </a>
    </li>
    <li class="nav-item dropdown">
        <a href="javascript:;" class="nav-link {{ controllerAction() == 'user.automation.timeline' ? 'active' : '' }}" onclick="timelinePopup.load('{{ route('user.automation.timeline', ['username' => Auth::user()->username,'uid' => $automation->uid]) }}')">
            {{ trans('messages.automation.timeline') }}
        </a>
    </li>
</ul>
    
<script>
    @if (isset($tab))
        $('.timeline-tab .nav-link.{{ $tab }}').addClass('active');
    @endif
</script>