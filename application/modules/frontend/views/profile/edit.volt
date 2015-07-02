<div align="center" class="login-page container">

    <div align="left">
        <h2>Hi, {{ session.get('identity')['name'] }}</h2>
        <hr/>
        <div id="api-key">
            Your API key is {{ account.apiKey }}
        </div>

        {{ content() }}

    </div>

    {{ partial("partials/profile-menu") }}

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
                    {{ form.render('Save') }}
                </div>
            </div>
    </form>
</div>