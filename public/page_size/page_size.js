$("#page-size").change(function(){  
    var url = new URL(window.location.href);
    var search_params = url.searchParams;
    search_params.set('page_size', $('#page-size').val());
    search_params.set('page',1);
    url.search = search_params.toString();
    var new_url = url.toString();
    window.location.href = new_url
  });