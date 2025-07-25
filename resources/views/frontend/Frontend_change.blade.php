<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />

    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />

    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins&display=swap"
      rel="stylesheet"
    />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/h_style.css') }}" />
  </head>
  <body>
    <div class="login-page">
      <div class="overlay">
        <div class="container">
          <div class="row form-box rounded-4 overflow-hidden">
            <!-- Left Image -->
            <div
              class="col-lg-6 col-md-6 d-none d-md-flex justify-content-center align-items-end img-part"
            >
              <img
                src="{{ asset('frontend/images/login.webp')}}"
                alt="robot"
                class="img-fluid robot-img"
              />
            </div>

            <!-- Right Form -->
            <div
              class="col-12 col-lg-5 col-md-6 d-flex align-items-center justify-content-center"
            >
              <div class="text-center login-content w-100">
                <h2 class="mb-5">Forget Password</h2>
                <form>
                  <!-- Email -->
                  <div class="mb-3 d-flex flex-column align-items-start">
                    <label for="email" class="mb-1">Email</label>
                    <input
                      type="email"
                      id="email"
                      class="form-control rounded py-2 px-4 text-black"
                      placeholder="Enter Email"
                    />
                  </div>

                  <!-- Sign In Button -->
                  <button
                    type="submit"
                    class="btn btn-light w-100 rounded-pill py-2 mt-3"
                  >
                    Reset Password
                  </button>

                  <!-- Create Account -->
                  <p class="text-center text-white-50 login-page-last mt-3">
                    I have remember my Password
                    <a href="{{ route('frontend.login')}}" class="text-white"> sign In</a>
                  </p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
      document.querySelector("form").addEventListener("submit", async function (e) {
        e.preventDefault();

        const email = this.querySelector('input[type="email"]').value.trim();

        if (!email) {
          alert("Please enter your email.");
          return;
        }

        // Check if email exists
        const res = await fetch(`http://localhost:4000/users?email=${encodeURIComponent(email)}`);
        const users = await res.json();

        if (users.length > 0) {
          // Store the user's id as forgot_id
          localStorage.setItem("forgot_id", users[0].id);
          // Redirect to Confirm_pass.html
          window.location.href = "/auth/Confirm_pass.html";
        } else {
          alert("Email not found. Please enter a registered email.");
        }
      });
    </script>
  </body>
</html>
