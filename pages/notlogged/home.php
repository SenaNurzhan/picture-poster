<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 center">
                <div class="form-wrap">
                <h1 style = "color:#009900">Log in with your Login</h1>
                    <form role="form" action="?act=login" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <input type="text" name = "login" id="email" placeholder="Login" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" id="password" placeholder="Password" class="form-control">
                        </div>
                        <input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Log in" style = "background-color:#008000">
                        <a href="?act=regis"><button  type="button" class="btn btn-custom btn-lg btn-block" style = "background-color:#ff7733">Registration</button></a>
                    </form>

                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>