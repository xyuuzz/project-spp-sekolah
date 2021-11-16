<div>
<div class="logo">
    <h1>Halaman Login</h1>
    <!-- if logo is image enable this
        <a class="brand-logo" href="#index.html">
            <img src="image-path" alt="Your logo" title="Your logo" style="height:35px;" />
        </a> -->
</div>
<div class="workinghny-block-grid">
    <div class="workinghny-left-img align-end">
        <img src="{{asset("assets/login_page_asset/images/2.png")}}" class="img-responsive" alt="img" />
    </div>
    <div class="form-right-inf">

        <div class="login-form-content">
            <form wire:submit.prevent="authenticate" class="signin-form">
                <div class="one-frm">
                    <label>Email</label>
                    <input required wire:model.defer="email" type="email" placeholder="Type email of your account" autofocus>
                </div>
                <div class="one-frm">
                    <label>Password</label>
                    <input required wire:model.defer="password" type="password" placeholder="Type password of your account">
                </div>
                <label class="check-remaind">
                    <input wire:model="remember" type="checkbox">
                    <span class="checkmark"></span>
                    <p class="remember">Remember Me</p>
                </label>

                @error("email")
                    <small class="text-danger">*{{$message}}</small>
                @enderror
                <button type="submit" class="btn btn-style mt-3">Sign In </button>
            </form>
        </div>
    </div>
</div>
</div>

