{{--             <a href="#" class="brand-link">--}}
{{--                <img src="#" class="brand-image center">--}}
{{--                <p class="brand-text"></p>--}}
{{--            </a>--}}
<div class="sidebar-brand">
    <a href="{{route('dashboard')}}" class="text-center">
        <h5 class="mt-3 brand-text" style="color: #1E4080;">Smart Campus</h5>
    </a>
</div>
<div class="sidebar mt-3 campus-sidebar">
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

            <li class="nav-item has-treeview">
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
                        <a href="{{route('events')}}" class="nav-link {{ Request::is('text-books*')? 'active1':''}}">
                            <i class="fa-solid fa-book-open nav-icon"></i>
                            <p>Text Books</p>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</div>
