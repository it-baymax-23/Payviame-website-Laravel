<div class="sidebar" data-color="purple" data-image="{{ asset('backend/img/sidebar-1.jpg') }}">

    <div class="logo">
        <a href="{{ route('admin.dashboard') }}" class="simple-text">
            {{ __('Admin Panel') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="{{ Request::is('admin/dashboard*') ? 'active': '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="material-icons">dashboard</i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li class="{{ Request::is('admin/lang*') ? 'active': '' }}">
                <a href="{{ route('admin.lang.index', $user->profile->lang) }}">
                    <i class="material-icons">language</i>
                    <p>{{ __('Languages') }}</p>
                </a>
            </li>
            <li class="{{ Request::is('admin/currency*') ? 'active': '' }}">
                <a href="{{ route('admin.currency.index') }}">
                    <i class="material-icons">money</i>
                    <p>{{ __('Currencies') }}</p>
                </a>
            </li>
            <li class="{{ Request::is('admin/user*') ? 'active': '' }}">
                <a href="{{ route('admin.user.index') }}">
                    <i class="material-icons">supervised_user_circle</i>
                    <p>{{ __('Users') }}</p>
                </a>
            </li>
            <li class="{{ Request::is('admin/quote*') ? 'active': '' }}">
                <a href="{{ route('admin.quote.index') }}">
                    <i class="material-icons">library_books</i>
                    <p>{{ __('Quotes') }}</p>
                </a>
            </li>
            <li class="{{ Request::is('admin/invoice*') ? 'active': '' }}">
                <a href="{{ route('admin.invoice.index') }}">
                    <i class="material-icons">chrome_reader_mode</i>
                    <p>{{ __('Invoices') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>