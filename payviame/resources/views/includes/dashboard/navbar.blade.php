<div class="span-24 last relative">
	<a class="logo" href="{{route('dashboard')}}"><img src="{{asset('frontend/images/logo.png')}}" alt="Paydirt logo">
	</a>
	<div id="nav">
		<ul>
			<li id="nav-reports" class="{{ Request::is('reports*') ? 'selected': '' }}">
				<a href="{{route('report.index')}}">{{__('Dashboard')}}</a>
			</li>
			<li id="nav-clients" class="{{ Request::is('clients*') ? 'selected': '' }}">
				<a href="{{route('client.index')}}">{{__('Clients')}}</a>
			</li>
			<li id="nav-quotes" class="{{ Request::is('quotes*') ? 'selected': '' }}">
				<a  href="{{route('quote.index')}}">{{__('Quotes')}}</a>
			</li>
			<li id="nav-invoices" class="{{ Request::is('invoices*') ? 'selected': '' }}">
				<a  href="{{route('invoice.index')}}">{{__('Invoices')}}</a>
			</li>
		</ul>
	</div>
	<div id="account_nav">
		<ul>
			<li>
				<div class="dropdown">
				  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    @php
                        $currentLang = basename(App::getLocale());
                    @endphp
                    <span>{{Str::upper($currentLang)}}</span>
				  </button>
				  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				    @foreach($user->profile->languages() as $lang)
                        @if($currentLang != $lang)
                            <a class="dropdown-item" href="{{ route('report.changeLang', [$user->profile->id, $lang]) }}">{{Str::upper($lang)}}</a>
                        @endif
                    @endforeach
				  </div>
				</div>
			</li>
			<li class="{{ Request::is('memberships*') ? 'selected': '' }}">
				@if($user->role_id == 1)
					<a href="{{ route('report.membership') }}">{{__('Membership')}}</a>
				@endif
			</li>
			<li class="{{ Request::is('teams*') ? 'selected': '' }}">
				<a href="{{ route('team.index') }}">{{__('Team')}}</a>
			</li>
			<li class="{{ Request::is('setting*') ? 'selected': '' }}">
				<a href="{{ route('setting.profile.index',$user->profile->id) }}">{{__('Settings')}}</a>
			</li>
			<li>
				<a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i></a>
				<form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none">
		            @csrf
		        </form>
			</li>
		</ul>
	</div>
</div>