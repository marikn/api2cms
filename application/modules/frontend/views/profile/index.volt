<div align="center" class="login-page container">

    <div align="left">
        <h2>Hi, {{ session.get('identity')['name'] }}</h2>
        <hr/>
        {{ content() }}
    </div>
</div>