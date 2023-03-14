<a class="mb-4 d-flex align-items-center back-to-automation" href="javascript:;"
    onclick="sidebar.load('{{ route('user.automation.settings', ['username' => Auth::user()->username, 'uid' => $automation->uid]) }}')"
>
    <span class="material-icons-outlined me-2">
        arrow_back
        </span>
    <span>{{ trans('messages.automation.back_to_automation') }}</span>
</a>
