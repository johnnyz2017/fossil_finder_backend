<div class="container">
    {{-- <div id="map-canvas" style="height: 425px; width: 70%;  float: left;position: relative; overflow: hidden;">
    </div>
    <div id="category-list" style="height: 425px; width: 25%; float: left; margin-left: 20px">
        <div>Categories</div>
        {!! $tree !!}
    </div>

    <div style="height: 10px; clear:both;"></div> --}}
    <div class="row">
        <div class="col-md-9">
            <div id="map-canvas" style="height: 425px; width: 100%; overflow: hidden;">
            </div>
        </div>
        <div class="col-md-3">
            <div style="padding: 10px 5px;background-color: #eceeef;text-align: center;margin-bottom: 10px;">
                Categories
            </div>
            {!! $tree !!}
        </div>
    </div>
</div>