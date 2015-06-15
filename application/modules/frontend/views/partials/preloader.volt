{% if router.getRewriteUri() == '/' %}
    <div class="pre-loader">
        <div class="load-con">
            {{ image("img/freeze/logo.png", "class" : "animated fadeInDown") }}
            <div class="spinner">
                <div class="bounce1"></div>
                <div class="bounce2"></div>
                <div class="bounce3"></div>
            </div>
        </div>
    </div>
{% endif %}