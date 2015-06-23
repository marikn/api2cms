<div class="content container">

    <div class="section-heading">
        <h1>Blog</h1>
        <hr />
        {{ content() }}
    </div>

    <div id="articles">
        {% for item in page.items %}

            <h3>{{ item.title}}</h3> <br />

            <?php $preview = substr($item->content, 0, 1000);?>

            <p class="text-justify">{{ preview ~ "... " }}</p>

            <a href="/blog/{{ item.id }}" class="btn btn-primary btn-sm">Read more</a>

        {% endfor %}
    </div>

    <div id="pagination" class="text-center">
        <ul class="pagination">
            <li {% if page.before is page.current %} class="disabled" {% endif %}><a href="/blog?page={{ page.before }} ">&laquo;</a></li>

            {% if page.before-1 >= page.first %}
                <li><a href="/blog?page={{ page.before-1 }} ">{{ page.before-1 }}</a></li>
            {% endif %}
            {% if page.before is not page.current %}
                <li><a href="/blog?page={{ page.before }} ">{{ page.before }}</a></li>
            {% endif %}
            <li class="active"><a href="/blog?page={{ page.current }} ">{{ page.current }}</a></li>
            {% if page.next is not page.current %}
                <li><a href="/blog?page={{ page.next }} ">{{ page.next }}</a></li>
            {% endif %}
            {% if page.next+1 <= page.last %}
                <li><a href="/blog?page={{ page.next+1 }} ">{{ page.next+1 }}</a></li>
            {% endif %}

            <li {% if page.next is page.current %} class="disabled" {% endif %}><a href="/blog?page={{ page.next }} ">&raquo;</a></li>
        </ul>
    </div>
</div>