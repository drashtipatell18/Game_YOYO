<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Game Ecommerce">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">
    <title>Login Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/h_style.css') }}" />
    <!-- Custom Checkbox Style -->
    <style>
        .db_custom_checkbox {
            position: relative;
            padding-left: 26px;
            cursor: pointer;
            user-select: none;
            display: inline-block;
            color: #ccc;
            font-size: 14px;
        }

        .db_custom_checkbox input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .db_custom_checkbox .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 16px;
            width: 16px;
            background-color: transparent;
            border: 2px solid #ccc;
            border-radius: 3px;
        }

        .db_custom_checkbox input:checked~.checkmark {
            background-color: black;
            border-color: white;
        }

        .db_custom_checkbox .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        .db_custom_checkbox input:checked~.checkmark:after {
            display: block;
        }

        .db_custom_checkbox .checkmark:after {
            left: 4px;
            top: 0px;
            width: 5px;
            height: 9px;
            border: solid #fff;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        .error {
            color: red;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .social-icons .icon {
            cursor: pointer;
        }

        /* Captcha Styles */
        .block {
            position: absolute;
            left: 0;
            top: 0;
        }

        .slidercaptcha {
            margin: 0 auto;
            width: 100%;
            height: 200px;
            border-radius: 4px;
            margin-top: 0;
        }

        .slidercaptcha canvas:first-child {
            border-radius: 5px;
            border: 1px solid #e6e8eb;
        }

        .sliderContainer {
            position: relative;
            text-align: center;
            line-height: 40px;
            background: #f7f9fa;
            color: #45494c;
            border-radius: 2px;
        }

        .sliderbg {
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            background-color: #f7f9fa;
            height: 40px;
            border-radius: 2px;
            border: 1px solid #e6e8eb;
        }

        .sliderContainer_active .slider {
            top: -1px;
            border: 1px solid #1991FA;
        }

        .sliderContainer_active .sliderMask {
            border-width: 1px 0 1px 1px;
        }

        .sliderContainer_success .slider {
            top: -1px;
            border: 1px solid #02c076;
            background-color: #02c076 !important;
            color: #fff;
        }

        .sliderContainer_success .sliderMask {
            border: 1px solid #52CCBA;
            border-width: 1px 0 1px 1px;
            background-color: #D2F4EF;
        }

        .sliderContainer_success .sliderIcon:before {
            content: "\f00c";
        }

        .sliderContainer_fail .slider {
            top: -1px;
            border: 1px solid #f35c59;
            background-color: #f35c59;
            color: #fff;
        }

        .sliderContainer_fail .sliderMask {
            border: 1px solid #f35c59;
            background-color: #f7dcdd;
            border-width: 1px 0 1px 1px;
        }

        .sliderContainer_fail .sliderIcon:before {
            content: "\f00d";
        }

        .sliderContainer_active .sliderText,
        .sliderContainer_success .sliderText,
        .sliderContainer_fail .sliderText {
            display: none;
        }

        .sliderMask {
            position: absolute;
            left: 0;
            top: 0;
            height: 40px;
            border: 0 solid #d1e9fe;
            background: #d1e9fe;
            border-radius: 2px;
        }

        .slider {
            position: absolute;
            top: 0;
            left: 0;
            width: 40px;
            height: 40px;
            background: #fff;
            box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);
            cursor: pointer;
            transition: background .2s linear;
            border-radius: 2px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .slider:hover {
            background: #009efb;
            color: #fff;
            border-color: #009efb;
        }

        .slider:hover .sliderIcon {
            background-position: 0 -13px;
        }

        .sliderText {
            position: relative;
        }

        .refreshIcon {
            position: absolute;
            right: 5px;
            top: 5px;
            cursor: pointer;
            padding: 6px;
            color: #fff;
            background-color: #ff4c4c;
            font-size: 14px;
            border-radius: 50px;
        }

        .refreshIcon:hover {
            color: #fff;
        }

        /* Captcha container styling */
        .captcha-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            padding: 15px;
            margin: 15px 0;
        }

        .captcha-container .card-header {
            background: transparent;
            border: none;
            padding: 0 0 10px 0;
            font-size: 14px;
            color: #333;
            text-align: center;
        }

        .captcha-container .card-body {
            padding: 0;
        }

        #loginBtn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
    </style>
</head>

<body>
    <div class="login-page">
        <div class="overlay">
            <div class="container">
                <div class="row form-box rounded-4 overflow-hidden">
                    <!-- Left Image -->
                    <div class="col-lg-6 col-md-6 d-none d-md-flex justify-content-center align-items-end img-part">
                        <img src="{{ asset('frontend/images/login.webp') }}" alt="robot"
                            class="img-fluid robot-img" />
                    </div>
                    <!-- Right Form -->
                    <div class="col-12 col-lg-5 col-md-6 d-flex align-items-center justify-content-center">
                        <div class="text-center login-content w-100">
                            <h2 class="mb-4">Welcome<br />The YOYO Khel</h2>
                            <form action={{ route('frontlogin') }} method="post" id="frontendlogin">
                                @csrf
                                <!-- Email -->
                                <div class="mb-3">
                                    <input type="email" name="email" id="db_email_input"
                                        class="form-control rounded py-2 px-4 text-black" placeholder="Enter Email" />
                                </div>
                                <!-- Password with eye icon -->
                                <div class="mb-3">
                                    <div class="position-relative">
                                        <input type="password" name="password"
                                            class="form-control rounded-end py-2 px-4 pe-5 text-black"
                                            placeholder="Enter Password" id="db_password_input" />
                                       <i class="fa-solid fa-eye-slash" id="db_toggle_password"
                                            style="
                                                position: absolute;
                                                top: 35%;
                                                right: 31px;
                                                transform: translateY(-50%);
                                                cursor: pointer;
                                                color: #888;
                                                z-index: 5;
                                            "></i>
                                    </div>
                                    <!-- Custom Checkbox + Forgot Password -->
                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <label class="db_custom_checkbox">
                                            {{-- Remember Me
                                <input type="checkbox" id="rememberMe" />
                                <span class="checkmark"></span> --}}
                                        </label>
                                        <a href="{{ route('frontendforget')}}" class="text-white-50 small">Forgot Password?</a>
                                    </div>
                                    <div id="credentialError" class="error"></div>
                                </div>

                                <!-- Slider Captcha -->
                                <div class="captcha-container d-none" id="captchaCard">
                                    <div class="card-header">
                                        <span>Please complete security verification!</span>
                                    </div>
                                    <div class="card-body">
                                        <div id="captcha"></div>
                                    </div>
                                </div>

                                <!-- Sign In Button -->
                                <button type="submit" id="loginBtn" class="btn btn-light w-100 rounded-pill py-2">
                                    Sign In
                                </button>
                            </form>
                            <!-- Or continue with -->
                            <div class="d-flex align-items-center my-3">
                                <hr class="flex-grow-1 border-white" />
                                <span class="px-3 text-white-50 small">Or continue with</span>
                                <hr class="flex-grow-1 border-white" />
                            </div>
                            <!-- Social Icons -->
                            <div class="d-flex justify-content-center gap-4 mb-3 social-icons">
                                <div class="google icon">
                                    <a href="{{ url('auth/google') }}">
                                        <img src="{{ asset('frontend/images/google-logo.png') }}" alt="Google"
                                            width="25" />
                                    </a>
                                </div>
                                <div class="facebook icon">
                                    <a href="{{ url('auth/facebook') }}">
                                        <img src="{{ asset('frontend/images/Facebook-logo.png') }}" alt="Facebook"
                                            width="25" />
                                    </a>
                                </div>
                            </div>
                            <!-- Create Account -->
                            <p class="text-center text-white-50 login-page-last">
                                Don't have an account?
                                <a href="{{ route('frontregister') }}" class="text-white">Create Account!</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Slider Captcha Script -->
    <script>
        // Slider Captcha Implementation
        (function () { "use strict"; function u(n) { var i = document.getElementById(n.id), r = typeof n == "object" && n; return new t(i, r) } var r = function () { var u = arguments.length, n = arguments[0] || {}, t, i, r; for (typeof n != "object" && typeof n != "function" && (n = {}), u == 1 && (n = this, t--), t = 1; t < u; t++) { i = arguments[t]; for (r in i) Object.prototype.hasOwnProperty.call(i, r) && (n[r] = i[r]) } return n }, i = function (n) { return typeof n == "function" && typeof n.nodeType != "number" }, t = function (n, i) { this.$element = n; this.options = r({}, t.DEFAULTS, i); this.$element.style.position = "relative"; this.$element.style.width = this.options.width + "px"; this.$element.style.margin = "0 auto"; this.init() }, n; t.VERSION = "1.0"; t.Author = "argo@163.com"; t.DEFAULTS = { width: 280, height: 155, PI: Math.PI, sliderL: 42, sliderR: 9, offset: 5, loadingText: "Loading...", failedText: "Try again", barText: "Slide right to fill", repeatIcon: "fa fa-repeat", maxLoadCount: 3, localImages: function () { return "https://picsum.photos/280/155/?image=" + Math.round(Math.random() * 20) }, verify: function (n, t) { var i = !1; return $.ajax({ url: t, data: { datas: JSON.stringify(n) }, dataType: "json", type: "post", async: !1, success: function (n) { i = JSON.stringify(n); console.log("Result: " + i) } }), i }, remoteUrl: null }; window.sliderCaptcha = u; window.sliderCaptcha.Constructor = t; n = t.prototype; n.init = function () { this.initDOM(); this.initImg(); this.bindEvents() }; n.initDOM = function () { var n = function (n, t) { var i = document.createElement(n); return i.className = t, i }, v = function (n, t) { var i = document.createElement("canvas"); return i.width = n, i.height = t, i }, f = v(this.options.width - 2, this.options.height), e = f.cloneNode(!0), t = n("div", "sliderContainer"), l = n("i", "refreshIcon " + this.options.repeatIcon), o = n("div", "sliderMask"), y = n("div", "sliderbg"), s = n("div", "slider"), a = n("i", "fa fa-arrow-right sliderIcon"), h = n("span", "sliderText"), u, c; e.className = "block"; h.innerHTML = this.options.barText; u = this.$element; u.appendChild(f); u.appendChild(l); u.appendChild(e); s.appendChild(a); o.appendChild(s); t.appendChild(y); t.appendChild(o); t.appendChild(h); u.appendChild(t); c = { canvas: f, block: e, sliderContainer: t, refreshIcon: l, slider: s, sliderMask: o, sliderIcon: a, text: h, canvasCtx: f.getContext("2d"), blockCtx: e.getContext("2d") }; i(Object.assign) ? Object.assign(this, c) : r(this, c) }; n.initImg = function () { var n = this, f = window.navigator.userAgent.indexOf("Trident") > -1, r = this.options.sliderL + this.options.sliderR * 2 + 3, e = function (t, i) { var r = n.options.sliderL, o = n.options.sliderR, s = n.options.PI, u = n.x, e = n.y; t.beginPath(); t.moveTo(u, e); t.arc(u + r / 2, e - o + 2, o, .72 * s, 2.26 * s); t.lineTo(u + r, e); t.arc(u + r + o - 2, e + r / 2, o, 1.21 * s, 2.78 * s); t.lineTo(u + r, e + r); t.lineTo(u, e + r); t.arc(u + o - 2, e + r / 2, o + .4, 2.76 * s, 1.24 * s, !0); t.lineTo(u, e); t.lineWidth = 2; t.fillStyle = "rgba(255, 255, 255, 0.7)"; t.strokeStyle = "rgba(255, 255, 255, 0.7)"; t.stroke(); t[i](); t.globalCompositeOperation = f ? "xor" : "destination-over" }, o = function (n, t) { return Math.round(Math.random() * (t - n) + n) }, t = new Image, u; t.crossOrigin = "Anonymous"; u = 0; t.onload = function () { n.x = o(r + 10, n.options.width - (r + 10)); n.y = o(10 + n.options.sliderR * 2, n.options.height - (r + 10)); e(n.canvasCtx, "fill"); e(n.blockCtx, "clip"); n.canvasCtx.drawImage(t, 0, 0, n.options.width - 2, n.options.height); n.blockCtx.drawImage(t, 0, 0, n.options.width - 2, n.options.height); var i = n.y - n.options.sliderR * 2 - 1, u = n.blockCtx.getImageData(n.x - 3, i, r, r); n.block.width = r; n.blockCtx.putImageData(u, 0, i + 1); n.text.textContent = n.text.getAttribute("data-text") }; t.onerror = function () { if (u++, window.location.protocol === "file:" && (u = n.options.maxLoadCount, console.error("can't load pic resource file from File protocal. Please try http or https")), u >= n.options.maxLoadCount) { n.text.textContent = "Loading failed"; return } t.src = n.options.localImages() }; t.setSrc = function () { var r = "", e; u = 0; i(n.options.setSrc) && (r = n.options.setSrc()); r && r !== "" || (r = "https://picsum.photos/" + n.options.width + "/" + n.options.height + "/?image=" + Math.round(Math.random() * 20)); f ? (e = new XMLHttpRequest, e.onloadend = function (n) { var i = new FileReader; i.readAsDataURL(n.target.response); i.onloadend = function (n) { t.src = n.target.result } }, e.open("GET", r), e.responseType = "blob", e.send()) : t.src = r }; t.setSrc(); this.text.setAttribute("data-text", this.options.barText); this.text.textContent = this.options.loadingText; this.img = t }; n.clean = function () { this.canvasCtx.clearRect(0, 0, this.options.width, this.options.height); this.blockCtx.clearRect(0, 0, this.options.width, this.options.height); this.block.width = this.options.width }; n.bindEvents = function () { var n = this; this.$element.addEventListener("selectstart", function () { return !1 }); this.refreshIcon.addEventListener("click", function () { n.text.textContent = n.options.barText; n.reset(); i(n.options.onRefresh) && n.options.onRefresh.call(n.$element) }); var r, u, f = [], t = !1, e = function (i) { n.text.classList.contains("text-danger") || (r = i.clientX || i.touches[0].clientX, u = i.clientY || i.touches[0].clientY, t = !0) }, o = function (i) { var o; if (!t) return !1; var s = i.clientX || i.touches[0].clientX, h = i.clientY || i.touches[0].clientY, e = s - r, c = h - u; if (e < 0 || e + 40 > n.options.width) return !1; n.slider.style.left = e - 1 + "px"; o = (n.options.width - 60) / (n.options.width - 40) * e; n.block.style.left = o + "px"; n.sliderContainer.classList.add("sliderContainer_active"); n.sliderMask.style.width = e + 4 + "px"; f.push(Math.round(c)) }, s = function (u) { var o, e; if (!t || (t = !1, o = u.clientX || u.changedTouches[0].clientX, o === r)) return !1; n.sliderContainer.classList.remove("sliderContainer_active"); n.trail = f; e = n.verify(); e.spliced && e.verified ? (n.sliderContainer.classList.add("sliderContainer_success"), i(n.options.onSuccess) && n.options.onSuccess.call(n.$element)) : (n.sliderContainer.classList.add("sliderContainer_fail"), i(n.options.onFail) && n.options.onFail.call(n.$element), setTimeout(function () { n.text.innerHTML = n.options.failedText; n.reset() }, 1e3)) }; this.slider.addEventListener("mousedown", e); this.slider.addEventListener("touchstart", e); document.addEventListener("mousemove", o); document.addEventListener("touchmove", o); document.addEventListener("mouseup", s); document.addEventListener("touchend", s); document.addEventListener("mousedown", function () { return !1 }); document.addEventListener("touchstart", function () { return !1 }); document.addEventListener("swipe", function () { return !1 }) }; n.verify = function () { var n = this.trail, r = parseInt(this.block.style.left), t = !1; if (this.options.remoteUrl !== null) t = this.options.verify(n, this.options.remoteUrl); else { var i = function (n, t) { return n + t }, u = function (n) { return n * n }, f = n.reduce(i) / n.length, e = n.map(function (n) { return n - f }), o = Math.sqrt(e.map(u).reduce(i) / n.length); t = o !== 0 } return { spliced: Math.abs(r - this.x) < this.options.offset, verified: t } }; n.reset = function () { this.sliderContainer.classList.remove("sliderContainer_fail"); this.sliderContainer.classList.remove("sliderContainer_success"); this.slider.style.left = 0; this.block.style.left = 0; this.sliderMask.style.width = 0; this.clean(); this.text.setAttribute("data-text", this.text.textContent); this.text.textContent = this.options.loadingText; this.img.setSrc() } })();

        // Initialize captcha and form validation
        $(document).ready(function() {
            var isCaptchaVerified = false;

            var captchaInstance = null;
            function initCaptcha(onSolved){
                captchaInstance = sliderCaptcha({
                    id: 'captcha',
                    loadingText: 'Loading...',
                    failedText: 'Try again',
                    barText: 'Slide right to verify',
                    repeatIcon: 'fa fa-redo',
                    width: 280,
                    height: 120,
                    onSuccess: function () {
                        isCaptchaVerified = true;
                        if (typeof onSolved === 'function') { onSolved(); }
                    },
                    onFail: function() { isCaptchaVerified = false; },
                    onRefresh: function() { isCaptchaVerified = false; }
                });
            }

            // Password toggle
            $('#db_toggle_password').on('click', function () {
                const passwordInput = $('#db_password_input');
                const icon = $(this);
                const type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
                passwordInput.attr('type', type);
                icon.toggleClass('fa-eye fa-eye-slash');
            });

            // Form validation rules
            $("#frontendlogin").validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                        maxlength: 100
                    },
                    password: {
                        required: true,
                        minlength: 6
                    }
                },
                messages: {
                    email: {
                        required: "Please enter your email",
                        email: "Enter a valid email",
                    },
                    password: {
                        required: "Please enter your password",
                        minlength: "Minimum 6 characters",
                    }
                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element);
                },
                highlight: function(element) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element) {
                    $(element).removeClass('is-invalid');
                },
                submitHandler: function(form) {
                    var submitBtn = $(form).find('button[type="submit"]');
                    var originalText = submitBtn.text();
                    submitBtn.prop('disabled', true).text('Processing...');

                    $('#credentialError').text('');

                    $.ajax({
                        url: '{{ route('checkCredentials') }}',
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            _token: $(form).find('input[name="_token"]').val(),
                            email: $(form).find('input[name="email"]').val(),
                            password: $(form).find('input[name="password"]').val()
                        }
                    }).done(function(res){
                        if(res && res.success){
                            $('#captchaCard').removeClass('d-none');
                            initCaptcha(function(){ form.submit(); });
                        } else {
                            $('#credentialError').text('Invalid email or password');
                            submitBtn.prop('disabled', false).text(originalText);
                        }
                    }).fail(function(){
                        $('#credentialError').text('Unable to verify credentials. Please try again.');
                        submitBtn.prop('disabled', false).text(originalText);
                    });
                }
            });

            // Real-time validation
            $('#db_email_input, #db_password_input').on('keyup blur', function() {
                $(this).valid();
            });

            // Social icon click
            $('.social-icons .icon').on('click', function() {
                const platform = $(this).attr('class').split(' ')[0];
                if (typeof toastr !== 'undefined') {
                    toastr.info(`${platform.charAt(0).toUpperCase() + platform.slice(1)} login clicked!`);
                }
            });
        });
    </script>
</body>

</html>
