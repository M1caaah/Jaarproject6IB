<h1 class="mt-5 ms-5">Register view</h1>
<form>
    <!-- Email input -->
    <div data-mdb-input-init class="form-outline mb-4">
        <input type="email" id="form1Example1" class="form-control" />
        <label class="form-label" for="form1Example1">Email address</label>
    </div>

    <!-- Password input -->
    <div data-mdb-input-init class="form-outline mb-4">
        <input type="password" id="form1Example2" class="form-control" />
        <label class="form-label" for="form1Example2">Password</label>
    </div>

    <!-- 2 column grid layout for inline styling -->
    <div class="row mb-4">
        <div class="col d-flex justify-content-center">
            <!-- Checkbox -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                <label class="form-check-label" for="form1Example3"> Remember me </label>
            </div>
        </div>

        <div class="col">
            <!-- Simple link -->
            <a href="#!">Forgot password?</a>
        </div>
    </div>

    <!-- Submit button -->
    <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block">Sign in</button>
</form>
<form action="" method="post">
    <div class="container w-25">
        <div class="form-outline mb-4">
            <input type="text" name="firstname" id="firstname" class="form-control"/>
            <label class="form-label" for="firstname">First name</label>
        </div>
        <div class="form-outline mb-4">
            <input type="text" name="lastname" id="lastname" class="form-control"/>
            <label class="form-label" for="lastname">Last name</label>
        </div>
        <div class="form-outline mb-4">
            <input type="text" name="email" id="email" class="form-control"/>
            <label class="form-label" for="email">Email address</label>
        </div>

        <!-- Password input -->
        <div class="form-outline mb-4">
            <input type="password" name="password" id="password" class="form-control"/>
            <label class="form-label" for="password">Password</label>
        </div>
        <div class="form-outline mb-4">
            <input type="password" name="confirmPassword" id="confirmPassword" class="form-control"/>
            <label class="form-label" for="confirmPassword">Confirm Password</label>
        </div>
        <!-- Submit button -->
        <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block">Sign in</button>
    </div>

</form>