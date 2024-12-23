<header>
    <div style="width: 100px; padding:20px;"> Logo</div>
    @auth
    <divs style="width: 70px; padding:20px;">
        <form action="logout" method="POST">
            @csrf
            <button>Log Out</button>
        </form>
    </div>
    @else
    <div style="width: 100px; padding:20px;">
        <form action="/login" method="GET">
        <button>Log In</button>
        </form>
      
    </div>
    @endauth
</header>