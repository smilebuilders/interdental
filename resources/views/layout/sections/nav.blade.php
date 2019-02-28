<nav class="navbar navbar-expand-lg">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav container">
        <li class="nav-item active">
          <a class="nav-link" href="{{ route('index') }}">Pacientes <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('policies_pending') }}">Verificacion Poliza
              @if (App\Policy::pending() > 0)
                  <span class="badge badge-light">{{App\Policy::pending()}}</span>
                  <span class="sr-only">unread messages</span>
              @endif
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('claim_pending') }}">Claims
               @if (App\Claim::pending() > 0)
                  <span class="badge badge-light">{{App\Claim::pending()}}</span>
                  <span class="sr-only">unread messages</span>
              @endif
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Reporte Claims</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('report') }}">Reporte</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto mr-auto">
          <!-- Authentication Links -->
          @guest
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
              </li>
              <li class="nav-item">
                  @if (Route::has('register'))
                      <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                  @endif
              </li>
          @else
              <li class="nav-item dropdown">
                  <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                      {{ Auth::user()->name }} <span class="caret"></span>
                  </a>

                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                          {{ __('Logout') }}
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                  </div>
              </li>
          @endguest
      </ul>
    </div>
  </nav>