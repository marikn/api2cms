<div align="center" class="login-page container">

    <div align="left">
        <h2>Hi, Pavlo</h2>
        <hr/>
        <div id="api-key">
            Your API key is {{ account.apiKey }}
        </div>

        {{ content() }}

    </div>

    {{ partial("partials/profile-menu") }}
    Here you can configure some parameters of your account.

</div>
