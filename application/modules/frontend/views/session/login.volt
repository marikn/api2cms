<div align="center" class="login-page container">

    <div align="left">
        <h2>Login</h2>
        <hr/>
        {{ content() }}
    </div>

	{{ form('role': 'form', 'class': 'col-md-5 col-md-offset-3') }}

        <div align="right">
            <div class="form-group">
                <label for="email" class="col-sm-3 form-label">Email:</label>
                <div class="col-sm-9">
                    {{ form.render('email') }}
                </div>
            </div>

            <div class="form-group">
                <label for="password" class="col-sm-3 form-label">Password:</label>
                <div class="col-sm-9">
                    {{ form.render('password') }}
                </div>
            </div>

            <div class="form-group">
                {{ form.render('Login') }}
            </div>

            <hr>

            <div class="forgot">
                {{ link_to("session/forgotPassword", "Forgot my password") }}
            </div>
        </div>
	</form>
</div>