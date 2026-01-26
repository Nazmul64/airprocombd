<!doctype html>
<html lang="en" class="semi-dark">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link rel="icon" href="{{ asset('backend/assets/images/favicon-32x32.png') }}" type="image/png" />

  <!-- Bootstrap CSS -->
  <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('backend/assets/css/bootstrap-extended.css') }}" rel="stylesheet" />
  <link href="{{ asset('backend/assets/css/style.css') }}" rel="stylesheet" />
  <link href="{{ asset('backend/assets/css/icons.css') }}" rel="stylesheet" />

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet" />

  <!-- Bootstrap Icons CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />

  <!-- loader -->
  <link href="{{ asset('backend/assets/css/pace.min.css') }}" rel="stylesheet" />

  <title>Welcome Admin</title>
</head>

<body class="bg-login">

  <!--start wrapper-->
  <div class="wrapper">

    <!--start content-->
    <main class="authentication-content mt-5">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12 col-lg-4 mx-auto">
            <div class="card shadow rounded-5 overflow-hidden">
              <div class="card-body p-4 p-sm-5">
                <h5 class="card-title">Sign In</h5>
                <p class="card-text mb-5">See your growth and get consulting support!</p>
                <form class="form-body" method="post" action="{{ route('admin.login.submit') }}">
                  @csrf

                  <div class="login-separater text-center mb-4">
                    <span>OR SIGN IN WITH EMAIL</span>
                    <hr />
                  </div>

                  <div class="row g-3">
                    <div class="col-12">
                      <label for="inputEmailAddress" class="form-label">Email Address</label>
                      <div class="ms-auto position-relative">
                        <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                          <i class="bi bi-envelope-fill"></i>
                        </div>
                        <input type="email" name="email" class="form-control radius-30 ps-5" id="inputEmailAddress" placeholder="Email Address" />
                        @error('email')
                           <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="inputChoosePassword" class="form-label">Enter Password</label>
                      <div class="ms-auto position-relative">
                        <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                          <i class="bi bi-lock-fill"></i>
                        </div>
                        <input
                          type="password"
                          name="password"
                          class="form-control radius-30 ps-5"
                          id="inputChoosePassword"
                          placeholder="Enter Password"
                        />
                        @error('password')
                           <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <button
                          type="button"
                          class="btn btn-sm btn-outline-secondary position-absolute top-50 end-0 translate-middle-y me-2"
                          id="togglePassword"
                          style="z-index: 10;"
                          aria-label="Show/Hide password"
                        >
                          <i class="bi bi-eye"></i>
                        </button>
                      </div>
                    </div>

                    <div class="col-6">
                      <div class="form-check form-switch">
                        <input
                          class="form-check-input"
                          type="checkbox"
                          name="checkbox"
                          id="flexSwitchCheckChecked"
                          checked=""
                        />
                        <label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="d-grid">
                        <button type="submit" class="btn btn-primary radius-30">Sign In</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <!--end page main-->

  </div>
  <!--end wrapper-->

  <!--plugins-->
  <script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>
  <script src="{{ asset('backend/assets/js/pace.min.js') }}"></script>

  <!-- Password show/hide toggle script -->
  <script>
    document.getElementById('togglePassword').addEventListener('click', function () {
      const passwordInput = document.getElementById('inputChoosePassword');
      const icon = this.querySelector('i');
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
      } else {
        passwordInput.type = 'password';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
      }
    });
  </script>

</body>

<script>
  'undefined' === typeof _trfq || (window._trfq = []);
  'undefined' === typeof _trfd && (window._trfd = []),
    _trfd.push(
      { 'tccl.baseHost': 'secureserver.net' },
      { ap: 'cpsh-oh' },
      { server: 'p3plzcpnl509132' },
      { dcenter: 'p3' },
      { cp_id: '10399385' },
      { cp_cl: '8' }
    ); // Monitoring performance to make your website faster. If you want to opt-out, please contact web hosting support.
</script>
<script src="../../../../img1.wsimg.com/signals/js/clients/scc-c2/scc-c2.min.js"></script>
</html>
