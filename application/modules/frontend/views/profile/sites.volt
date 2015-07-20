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
    Here will be pretty grid with list of sites, wich connect to your account.

</div>
