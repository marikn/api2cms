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
                <!--<li>-->
                    <!--{{ link_to("#about", "about") }}-->
                <!--</li>-->
                <!--<li>-->
                    <!--{{ link_to("#features", "features") }}-->
                <!--</li>-->
                <!--<li>-->
                    <!--{{ link_to("#reviews", "reviews") }}-->
                <!--</li>-->
                <!--<li>-->
                    <!--{{ link_to("#screens", "screens") }}-->
                <!--</li>-->
                <!--<li>-->
                    <!--{{ link_to("#demo", "demo") }}-->
                <!--</li>-->
                <!--<li>-->
                    <!--{{ link_to("#getApp", "get app", "class" : "getApp") }}-->
                <!--</li>-->
                <li>
                    {{ link_to("/login", "login") }}
                </li>
                <li>
                    {{ link_to("/signup", "sign up") }}
                </li>
            </ul>
        </div>
    </div>
</nav>