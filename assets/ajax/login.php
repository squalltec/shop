<div class="login-popup">
    <div class="tab tab-nav-boxed tab-nav-center tab-nav-underline">
        <ul class="nav nav-tabs text-uppercase" role="tablist">
            <li class="nav-item">
                <a href="#sign-in" class="nav-link active">Sign In</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="sign-in">
                <form action="<?php echo base_url().'Account/Loginaccount' ?>" method="post" autocomplete="off">
                    <div class="form-group">
                        <label>Mobile or Email address *</label>
                        <input type="text" class="form-control" name="logusername" id="logusername" required>
                    </div>
                    <div class="form-group mb-0">
                        <label>Password *</label>
                        <input type="password" class="form-control" name="logpassword" id="logpassword" required>
                    </div>
                    <div class="form-checkbox text-right">
                        <a href="<?php echo base_url().'Account/Lostpassword' ?>">Last your password?</a>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Sign In</button>
                </form>
            </div>
        </div>
    </div>
</div>