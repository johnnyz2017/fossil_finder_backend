<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dynamic Treeview with jQuery, Laravel PHP Framework Example</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />
    <link href="http://www.expertphp.in/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="http://demo.expertphp.in/css/jquery.treeview.css" />
    <script src="http://demo.expertphp.in/js/jquery.js"></script>   
    <script src="http://demo.expertphp.in/js/jquery-treeview.js"></script>
    <script type="text/javascript" src="http://demo.expertphp.in/js/demo.js"></script>
</head>
<body>

    <div class="container">
        {{-- <div id="map-canvas" style="height: 425px; width: 100%; position: relative; overflow: hidden;">
        </div> --}}

        <div id="map-canvas" style="height: 425px; width: 60%;  float: left;position: relative; overflow: hidden;">
        </div>
        <div id="category-list" style="height: 425px; width: 30%; float: left; margin-left: 10px">
          <div>Categories</div>
          {{-- {{ dd($tree) }} --}}
          {{-- {!! $tree !!} --}}
          {{-- <ul id="browser" class="filetree"><li class="tree-view"></li><li class="tree-view closed"<a class="tree-name">Category facere</a><ul><li class="tree-view closed"><a class="tree-name">Category illum</a><ul><li class="tree-view closed"><a class="tree-name">Category nihil</a><ul><li class="tree-view closed"><a class="tree-name">Category deleniti</a><ul><li class="tree-view"><a class="tree-name">Category aspernatur</a></li><li class="tree-view closed"><a class="tree-name">Category expedita</a><ul><li class="tree-view"><a class="tree-name">Category autem</a></li></ul></ul></ul></ul></ul><li class="tree-view closed"<a class="tree-name">Category nulla</a><ul> --}}
          <div>
            <ul id="browser" class="filetree"><li class="tree-view"></li><li class="tree-view closed"<a class="tree-name">Category facere</a><ul><li class="tree-view closed"><a class="tree-name">Category illum</a><ul><li class="tree-view closed"><a class="tree-name">Category nihil</a><ul><li class="tree-view closed"><a class="tree-name">Category deleniti</a><ul><li class="tree-view"><a class="tree-name">Category aspernatur</a></li><li class="tree-view closed"><a class="tree-name">Category expedita</a><ul><li class="tree-view"><a class="tree-name">Category autem</a></li></ul></ul></ul></ul></ul><li class="tree-view closed"<a class="tree-name">Category nulla</a><ul>
          </div>

        </div>
        <div style="height: 10px; clear:both;"></div>
    </div>
{{-- <div class="container" style="left: 100px">    
    {!! $tree !!}
</div>  --}}
</body>
</html>