<div class="profile-menu">
    <ul id="profile-menu">
        <li><a {% if router.getRewriteUri() == '/profile' %} class="active" {% endif %} href="/profile">General</a></li>
        <li><a {% if router.getRewriteUri() == '/profile/edit' %} class="active" {% endif %} href="/profile/edit">Personal info</a></li>
        <li><a {% if router.getRewriteUri() == '/profile/sites' %} class="active" {% endif %} href="/profile/sites">Sites</a></li>
        <li><a {% if router.getRewriteUri() == '/profile/logs' %} class="active" {% endif %} href="/profile/logs">Logs</a></li>
        <li><a {% if router.getRewriteUri() == '/profile/settings' %} class="active" {% endif %} href="/profile/settings">Settings</a></li>
    </ul>
</div>