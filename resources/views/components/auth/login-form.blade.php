<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 animated fadeIn col-lg-6 center-screen">
            <div class="card w-90  p-4">
                <div class="card-body">
                    <h4>SIGN IN</h4>
                    <br/>
                    <input id="email" placeholder="User Email" class="form-control" type="email"/>
                    <br/>
                    <input id="password" placeholder="User Password" class="form-control" type="password"/>
                    <br/>
                    <button onclick="SubmitLogin()" class="btn w-100 bg-gradient-primary">Next</button>
                    <hr/>
                    <div class="float-end mt-3">
                        <span>
                            <a class="text-center ms-3 h6" href="{{url('/userRegistaion')}}">Sign Up </a>
                            <span class="ms-1">|</span>
                            <a class="text-center ms-3 h6" href="{{url('/sendOtp')}}">Forget Password</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    async function SubmitLogin() {
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value;

    // Validation
    if (!email) {
        return errorToast("Email is required");
    }
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        return errorToast("Invalid email format");
    }
    if (!password) {
        return errorToast("Password is required");
    }
    if (password.length < 6) { // Example: minimum password length
        return errorToast("Password must be at least 6 characters");
    }

    try {
        showLoader();
        const res = await axios.post("/user-login", { email, password });
        hideLoader();

        if (res.status === 200 && res.data.status === 'success') {
            window.location.href = "/dashboard";
        } else {
            errorToast(res.data.message || "Login failed");
        }
    } catch (error) {
        hideLoader();
        errorToast("An error occurred. Please try again.");
        console.error("Login Error:", error); // For debugging purposes
    }
}

</script>
