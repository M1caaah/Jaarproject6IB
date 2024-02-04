<h1 class="mt-5 ms-5">Login view</h1>
<div class="container w-25">
    <form action="" method="post">
        <div class="row">
            <div class="col">
                <div data-mdb-input-init  class="form-outline mb-4">
                    <input type="text" name="firstname" id="firstname" class="form-control"/>
                    <label class="form-label" for="firstname">First name</label>
                </div>
            </div>
            <div class="col">
                <div data-mdb-input-init  class="form-outline mb-4">
                    <input type="text" name="lastname" id="lastname" class="form-control"/>
                    <label class="form-label" for="lastname">Last name</label>
                </div>
            </div>
        </div>
        <div data-mdb-input-init  class="form-outline mb-4">
            <input type="text" name="email" id="email" class="form-control"/>
            <label class="form-label" for="email">Email address</label>
        </div>

        <!-- Password input -->
        <div data-mdb-input-init  class="form-outline mb-4">
            <input type="password" name="password" id="password" class="form-control"/>
            <label class="form-label" for="password">Password</label>
        </div>
        <div data-mdb-input-init  class="form-outline mb-4">
            <input type="password" name="confirmPassword" id="confirmPassword" class="form-control"/>
            <label class="form-label" for="confirmPassword">Confirm Password</label>
        </div>
        <!-- Submit button -->
        <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block">Sign in</button>
    </form>
</div>