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

    <div style="float: right; width: 850px; margin: 20px;">
        <table class="table table-striped">
            <tr>
                <th>#</th>
                <th>Url</th>
                <th>Token</th>
                <th>Requests count</th>
                <th>Actions</th>
            </tr>

            {% for site in sites %}
                <tr>
                    <td> {{ site['id'] }} </td>
                    <td> {{ site['siteUrl'] }} </td>
                    <td> {{ site['siteKey'] }} </td>
                    <td> <?php echo rand(10000, 100000); ?> </td>
                    <th> </td>
                </tr>
            {% endfor %}

        </table>
    </div>
</div>