@extends('layouts.main')

@section('content')

{{-- {{ $helloString}} --}}

<div class="row">
    <div class="col-md-10">
    <h1>{{ $post->title }}</h1>
    </div>

    <div class="col-md-12">
        <hr>
    </div>
</div> <!--end of .row -->

<div class="row">
    <div class="col-sm-6">
        <table class="table">
            <tbody>
                    <tr>
                        <th>#ID</th>
                        <th>{{ $post->id }}</th>
                    </tr>
                    <tr>
                        <th>标题</th>
                        <th>{{ $post->title }}</th>
                    </tr>
                    <tr>
                        <th>内容</th>
                        <th>{{ $post->content }}</th>
                    </tr>
                    <tr>
                        <th>创建时间</th>
                        <th>{{ date('M j, Y', strtotime($post->created_at)) }}</th>
                    </tr>
            </tbody>
        </table>
    </div>
    <div class="col-sm-6">
        <div id="amapcontainer"></div>
    </div>
</div>

{{-- {{ $posts ?? 'no posts'}} --}}

@endsection

<script>
    var app = @json($post);
    console.log(app);
</script>

<script>
    window.onLoad  = function(){
        var p = @json($post);
        console.log(p.coordinate_longitude, p.coordinate_latitude);
        var map = new AMap.Map('amapcontainer', {
            zooms: [4,18],//设置地图级别范围
            zoom:11,//级别
            layers: [//使用多个图层
                new AMap.TileLayer.Satellite()
            ],
            // center: [116.397428, 39.90923],//中心点坐标
            center: [p.coordinate_longitude, p.coordinate_latitude],
            viewMode:'3D'//使用3D视图
        });

        var infoWindow = new AMap.InfoWindow({ //创建信息窗体
            isCustom: true,  //使用自定义窗体
            content:'<div>信息窗体</div>', //信息窗体的内容可以是任意html片段
            offset: new AMap.Pixel(16, -45)
        });
        var onMarkerClick  =  function(e) {
            infoWindow.open(map, e.target.getPosition());//打开信息窗体
            //e.target就是被点击的Marker
        } 
        var marker = new AMap.Marker({
            icon: new AMap.Icon({
                size: [36, 36],
                image: "http://images.vppdb.com/image_picker_36936C20-D749-4D95-B262-BA67293ED53B-95759-00037EC8E75609DF.jpg",
            }),
            anchor: 'center',
            position: [p.coordinate_longitude, p.coordinate_latitude],
            label: {
                content: p.title,
                direction: 'bottom',
                // offset: new AMap.Pixel(-5, 10)
            }
        })

        map.add(marker);
        // marker.on('click',onMarkerClick);//绑定click事件

        // 同时引入工具条插件，比例尺插件和鹰眼插件
        AMap.plugin([
            'AMap.ToolBar',
            'AMap.Scale',
            'AMap.OverView',
            'AMap.MapType',
            'AMap.Geolocation',
        ], function(){
            // 在图面添加工具条控件，工具条控件集成了缩放、平移、定位等功能按钮在内的组合控件
            // map.addControl(new AMap.ToolBar());

            // 在图面添加比例尺控件，展示地图在当前层级和纬度下的比例尺
            // map.addControl(new AMap.Scale());

            // 在图面添加鹰眼控件，在地图右下角显示地图的缩略图
            // map.addControl(new AMap.OverView({isOpen:true}));
        
            // 在图面添加类别切换控件，实现默认图层与卫星图、实施交通图层之间切换的控制
            map.addControl(new AMap.MapType());
        
            // 在图面添加定位控件，用来获取和展示用户主机所在的经纬度位置
            map.addControl(new AMap.Geolocation());
        });

        map.setFitView();
    }


    var url = 'https://webapi.amap.com/maps?v=1.4.15&key=f885b7b92d0285147996269b7afaa30e&callback=onLoad';
    var jsapi = document.createElement('script');
    jsapi.charset = 'utf-8';
    jsapi.src = url;
    document.head.appendChild(jsapi);
</script>