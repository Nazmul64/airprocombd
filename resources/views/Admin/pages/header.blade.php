   @php
            use Illuminate\Support\Facades\Auth;
            $user_photo = Auth::user();
         @endphp



<header class="top-header">
        <nav class="navbar navbar-expand gap-3 align-items-center">
          <div class="mobile-toggle-icon fs-3">
              <i class="bi bi-list"></i>
            </div>

            <div class="top-navbar-right ms-auto">
              <ul class="navbar-nav align-items-center">

              <li class="nav-item dropdown dropdown-user-setting">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                  <div class="user-setting d-flex align-items-center">
                    <img src="{{ $user_photo && $user_photo->image
            ? asset('uploads/admin/' . $user_photo->image)
            : asset('uploads/admin/default.png') }}" class="user-img" alt="">
                  </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                     <a class="dropdown-item" href="#">
                       <div class="d-flex align-items-center">
                          <img src="{{ $user_photo && $user_photo->image
            ? asset('uploads/admin/' . $user_photo->image)
            : asset('uploads/admin/default.png') }}" alt="" class="rounded-circle" width="54" height="54">
                       </div>
                     </a>
                   </li>
                   <li><hr class="dropdown-divider"></li>
                   <li>
                      <a class="dropdown-item" href="{{route('profile.change')}}">
                         <div class="d-flex align-items-center">
                           <div class=""><i class="bi bi-person-fill"></i></div>
                           <div class="ms-3"><span>Profile</span></div>
                         </div>
                       </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{route('adminpassword.change')}}">
                         <div class="d-flex align-items-center">
                           <div class=""><i class="bi bi-gear-fill"></i></div>
                           <div class="ms-3"><span>Password Changes</span></div>
                         </div>
                       </a>
                    </li>
                    <li>
                      <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                  <i class="bx bx-log-out fs-18 align-middle me-1"></i><span class="align-middle">Logout</span>
                             </a>
                               <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                   @csrf
                              </form>
                    </li>
                </ul>
              </li>
              </ul>
              </div>
        </nav>
      </header>
