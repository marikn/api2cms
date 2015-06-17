<div align="center" class="signup-page container">

    <div align="left">
        <h2>Sign Up</h2>
        <hr/>
        {{ content() }}
    </div>

    {{ form('role': 'form', 'class': 'form-horizontal col-md-5 col-md-offset-3') }}

        <div align="right">
            <div class="form-group">
                <label for="email" class="col-sm-3 form-label">Email:</label>
                <div class="col-sm-9">
                    {{ form.render('email')}}
                </div>
            </div>

            <div class="form-group">
                <label for="first" class="col-sm-3 form-label">First name:</label>
                <div class="col-sm-9">
                    {{ form.render('first') }}
                </div>
            </div>

            <div class="form-group">
                <label for="first" class="col-sm-3 form-label">Last name:</label>
                <div class="col-sm-9">
                    {{ form.render('last') }}
                </div>
            </div>

            <div class="form-group">
                <label for="first" class="col-sm-3 form-label">Password:</label>
                <div class="col-sm-9">
                    {{ form.render('password') }}
                </div>
            </div>

            <div class="form-group">
                <label for="first" class="col-sm-3 form-label">Confirm password:</label>
                <div class="col-sm-9">
                    {{ form.render('confirmPassword') }}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-12">
                    {{ form.render('terms') }} {{ form.label('terms') }}
                </div>
            </div>

            <div class="form-group">
                {{ form.render('Sign Up') }}
            </div>
        </div>
	</form>
</div>