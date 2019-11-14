<nav class="navbar navbar-transparent navbar-absolute">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="javascript:;"> {{ __('Hello') }}, {{ Auth::user()->name }} </a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @php
                            $currentLang = basename(App::getLocale());
                        @endphp
                        <span>{{Str::upper($currentLang)}}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        @foreach($user->profile->languages() as $lang)
                            @if($currentLang != $lang)
                                <li class="dropdown-item"><a href="{{ route('admin.changeLang', [$user->profile->id, $lang]) }}">{{Str::upper($lang)}}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </li>
                <li>
                    <a href="{{ route('dashboard' )}}">
                        <i class="material-icons">dashboard</i>
                        <p class="hidden-lg hidden-md">{{ __('Homepage') }}</p>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.user.edit',$user->id) }}">
                        <i class="material-icons">person</i>
                        <p class="hidden-lg hidden-md">{{ __('Profile') }}</p>
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="material-icons">exit_to_app</i>
                        <p class="hidden-lg hidden-md">{{ __('Log Out') }}</p>
                    </a>
                    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>