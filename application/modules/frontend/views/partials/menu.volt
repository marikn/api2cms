<nav class="navbar navbar-default navbar-fixed-top {% if router.getRewriteUri() != '/' %} scrolled {% endif %}" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="fa fa-bars fa-lg"></span>
            </button>
            <a class="navbar-brand" href="/">
                {{ image("img/freeze/logo.png", "class" : "logo") }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    {{ link_to("blog", "blog") }}
                </li>

                {% if session.get('identity') == null %}
                    <li>
                        {{ link_to("/login", "login") }}
                    </li>
                    <li>
                        {{ link_to("/signup", "sign up") }}
                    </li>
                {% else %}
                    <li>
                        {{ link_to("/profile", "profile") }}
                    </li>
                    <li>
                        {{ link_to("/logout", "logout") }}
                    </li>
                {% endif %}
            </ul>
        </div>
    </div>
</nav>