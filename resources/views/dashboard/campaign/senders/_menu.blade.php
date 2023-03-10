<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-tabs nav-tabs-top nav-underline">
            @if (Auth::user()->customer->subscription->plan->useOwnSendingServer())
                <li class="nav-item" rel0="SenderController">
                    <a href="{{ route('user.sender.index', Auth::user()->username) }}" class="nav-link">
                    <span class="material-icons-round">
mail_outline
</span> {{ trans('messages.email_addresses') }}
                    </a>
                </li>
            @elseif ( Auth::user()->customer->subscription->plan->primarySendingServer()->allowVerifyingOwnEmails() ||
                Auth::user()->customer->subscription->plan->primarySendingServer()->allowVerifyingOwnEmailsRemotely() )
                <li class="nav-item" rel0="SenderController">
                    <a href="{{ route('user.sender.index', Auth::user()->username) }}" class="nav-link">
                    <span class="material-icons-round">
mail_outline
</span> {{ trans('messages.email_addresses') }}
                    </a>
                </li>
            @endif

            @if (Auth::user()->customer->subscription->plan->useOwnSendingServer())
                <li class="nav-item" rel0="SendingDomainController">
                    <a href="{{ route('user.sending-domain.index', Auth::user()->username) }}" class="nav-link">
                        <span class="material-icons-round">
alternate_email
</span> {{ trans('messages.domains') }}
                    </a>
                </li>
            @elseif ( Auth::user()->customer->subscription->plan->useOwnSendingServer() ||
                Auth::user()->customer->subscription->plan->primarySendingServer()->allowVerifyingOwnDomains() ||
                Auth::user()->customer->subscription->plan->primarySendingServer()->allowVerifyingOwnDomainsRemotely() )
                <li class="nav-item" rel0="SendingDomainController">
                    <a href="{{ route('user.sending-domain.index', Auth::user()->username) }}" class="nav-link">
                    <span class="material-icons-round">
alternate_email
</span> {{ trans('messages.domains') }}
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>
