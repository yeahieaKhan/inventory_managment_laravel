<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-10 center-screen">
            <div class="card animated fadeIn w-100 p-3">
                <div class="card-body">
                    <h4>Sign Up</h4>
                    <hr/>
                    <div class="container-fluid m-0 p-0">
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <label>First Name</label>
                                <input id="firstName" placeholder="First Name" class="form-control" type="text"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Last Name</label>
                                <input id="lastName" placeholder="Last Name" class="form-control" type="text"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Email Address</label>
                                <input id="email" placeholder="User Email" class="form-control" type="email"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Password</label>
                                <input id="password" placeholder="User Password" class="form-control" type="password"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Mobile Number</label>
                                <input id="number" placeholder="Mobile" class="form-control" type="number"/>
                            </div>
                        </div>
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <button onclick="onRegistration()" class="btn mt-3 w-100 bg-gradient-primary">Complete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
async function onRegistration() {
    // Get input values and trim whitespace
    const firstName = document.getElementById('firstName').value.trim();
    const lastName = document.getElementById('lastName').value.trim();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value.trim();
    const number = document.getElementById('number').value.trim();

    // Validation
    if (!firstName) {
        return errorToast('First Name is required');
    }
    if (!lastName) {
        return errorToast('Last Name is required');
    }
    if (!email) {
        return errorToast('Email is required');
    }
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        return errorToast('Invalid email format');
    }
    if (!password) {
        return errorToast('Password is required');
    }
    if (password.length < 6) {
        return errorToast('Password must be at least 6 characters');
    }
    if (!number) {
        return errorToast('Mobile Number is required');
    }
    if (!/^\d{10}$/.test(number)) { // Example: 10-digit validation
        return errorToast('Mobile Number must be 10 digits');
    }

    try {
        // API call
        const res = await axios.post("/user-registration", {
            firstName,
            lastName,
            email,
            password,
            number
        });

        // Check response
        if (res.status === 200 && res.data.status === 'success') {
            successToast('Registration successful!');
            window.location.href = "/login";
        } else {
            errorToast(res.data.message || 'An unexpected error occurred');
        }
    } catch (error) {
        // Handle server or network errors
        errorToast(error.response?.data?.message || 'Something went wrong. Please try again.');
        console.error('Registration Error:', error); // For debugging
    }
}

</script>
