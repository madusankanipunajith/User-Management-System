<html>
    <head>
        <title>{page_title}</title>
    </head>
    <body>
        <h1>{page_header | upper}</h1>
        <ul>
            {blog_entries}
                <li>
                    <h5>{title}</h5>
                    <p>{body}</p>
                </li>
            {/blog_entries}
        </ul>
        <h1>{date | date(l dS F Y)}</h1>
        <h3>{price | local_currency(EUR)}</h3>
        <h4>{salary | round(ceil)}</h4>
        <br/>

        
        <h1>Appling Custome Filters</h1>
        <h4>{mobile | hidenumbers(6)}</h4>
    </body>
</html>