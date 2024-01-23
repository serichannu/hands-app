<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/top') }}">
            <i class="fas fa-hand-paper"></i>
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link text-decoration-none text-primary" href="{{ route('students.create') }}">
                        <i class="fas fa-check"></i>出席番号登録
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-decoration-none" href="{{ route('seats.index') }}">
                        <i class="fas fa-chair"></i>席替え
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-decoration-none" href="{{ route('statics.index') }}">
                        <i class="fas fa-chart-bar"></i>集計
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-decoration-none" href="{{ route('mypage.index') }}">
                        <i class="fas fa-user"></i>マイページ
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-decoration-none text-danger" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>ログアウト
                    </a>
                </li>
                <li class="nav-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
