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
    Here will be pretty graphics, wich included a lot of helpful information.

</div>