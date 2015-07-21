{% set identity = session.get('identity') %}

<h2>Hi, {{ identity['name'] }}</h2>
<hr/>
<div id="api-key">
    Your API key is {{ account.apiKey }}
</div>