{{--             <a href="{{route('dashboard')}}" class="brand-link">--}}
{{--                <img src="{{asset('public/logo.png')}}" alt="Smart Campus" class="brand-image center">--}}
{{--                <p class="brand-text text-white">Smart Campus</p>--}}
{{--            </a>--}}

<div class="sidebar-brand"
     style="background: #1e4080;border-width: 0px 2px 0px 0px;padding-bottom: 9px;border-style: solid;border-color: #f97b40;">
    <a href="{{route('dashboard')}}" class="text-center">
        <img src="{{asset('public/logo.png')}}" alt="Smart Campus" class="nav-logo">
        {{--        <h5 class="mt-3 brand-text" style="color: #1E4080;">Smart Campus</h5>--}}
    </a>
</div>
<div class="sidebar campus-sidebar">
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">

            <li class="nav-item">
                <a href="{{route('dashboard')}}" class="nav-link {{ Request::is('dashboard')? 'active1':''}}">
                    <i class="fa-solid fa-gauge nav-icon"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('student')}}" class="nav-link {{ Request::is('student*')? 'active1':''}}">
                    <i class="fa-solid fa-users nav-icon"></i>
                    <p>Students</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('events')}}" class="nav-link {{ Request::is('events*')? 'active1':''}}">
                    <i class="fa-solid fa-calendar-days nav-icon"></i>
                    <p>Events</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('streams')}}" class="nav-link {{ Request::is('streams*')? 'active1':''}}">
                    <i class="fa-solid fa-laptop-file nav-icon"></i>
                    <p>Streams</p>
                </a>
            </li>

            <li class="nav-item has-treeview {{ Request::is('notes*','textbooks*')? 'menu-open':''}}">
                <a href="#" class="nav-link">
                    <i class="fa-solid fa-book nav-icon"></i>
                    <p>Library<i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('notes')}}" class="nav-link {{ Request::is('notes*')? 'active1':''}}">
                            <i class="fa-solid fa-clipboard nav-icon"></i>
                            <p>Notes</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('textbooks')}}" class="nav-link {{ Request::is('textbooks*')? 'active1':''}}">
                            <i class="fa-solid fa-book-open nav-icon"></i>
                            <p>Text Books</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{route('category')}}" class="nav-link {{ Request::is('category*')? 'active1':''}}">
                    <i class="fa-solid fa-list nav-icon"></i>
                    <p>Category</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('cafeteria')}}" class="nav-link {{ Request::is('cafeteria*')? 'active1':''}}">
                    <i class="fa-solid fa-hotel nav-icon"></i>
                    <p>Cafeteria</p>
                </a>
            </li>
        </ul>
    </nav>
</div>
