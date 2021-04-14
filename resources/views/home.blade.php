@extends('layouts.app')

@section('style-links')
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />
<link href="{{ asset('css/jquery.treeview.css') }}" rel="stylesheet">
@endsection

@section('content')

@include('partials.map')

<div class="container">
    {{-- <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div> --}}

    {{-- {{ __('You are logged in!') }} --}}

    {{-- {{ dd($posts) }} --}}
    
    {{-- @foreach($posts as $post)
    <div>{{ $post->title }}</div>
    @endforeach --}}
</div>
@endsection


@section('scripts')
<script src="{{ asset('js/jquery.js') }}" defer></script>   
<script src="{{ asset('js/jquery-treeview.js') }}" defer></script>
<script type="text/javascript" src="{{ asset('js/demo.js') }}" defer></script>
<script type='text/javascript' src="https://webapi.amap.com/maps?v=1.4.15&key=f885b7b92d0285147996269b7afaa30e&callback=onLoad"></script>
<script defer>
    window.onLoad  = function(){
        @foreach ($posts as $post)
          title = '{{ $post->coordinate_longitude }} -  {{ $post->coordinate_latitude }} ';
        //   console.log(title);
        @endforeach
        var map = new AMap.Map('map-canvas', {
            zooms: [4,18],//设置地图级别范围
            zoom:11,//级别
            layers: [//使用多个图层
                new AMap.TileLayer.Satellite()
            ],
            center: [116.397428, 39.90923],//中心点坐标
            viewMode:'3D'//使用3D视图
        });

        // var marker = new AMap.Marker({
        //     position:[116.39, 39.9]//位置
        // })
        // map.add(marker);//添加到地图
        // map.remove(marker);

        var infoWindow = new AMap.InfoWindow({ //创建信息窗体
            isCustom: true,  //使用自定义窗体
            content:'<div><a href="http://www.baidu.com">信息窗体</a></div>', //信息窗体的内容可以是任意html片段
            offset: new AMap.Pixel(16, -45)
        });
        var onMarkerClick  =  function(e) {
            infoWindow.open(map, e.target.getPosition());//打开信息窗体
            console.log(e);
            //e.target就是被点击的Marker
        } 
        // var marker = new AMap.Marker({
        //     icon: new AMap.Icon({
        //         size: [36, 36],
        //         image: "http://images.vppdb.com/image_picker_36936C20-D749-4D95-B262-BA67293ED53B-95759-00037EC8E75609DF.jpg",
        //     }),
        //     anchor: 'center',
        //     position: [116.481181, 39.989792],
        //     label: {
        //         content: '测试marker',
        //         direction: 'bottom',
        //         // offset: new AMap.Pixel(-5, 10)
        //     }
        // })
        // // var marker = new AMap.Icon({
        // //     position: [116.481181, 39.989792],
        // //     image: "http://images.vppdb.com/image_picker_36936C20-D749-4D95-B262-BA67293ED53B-95759-00037EC8E75609DF.jpg"
        // // })
        // map.add(marker);
        // // marker.on('click',onMarkerClick);//绑定click事件
        // marker.on('click', function(e){
        //     new AMap.InfoWindow({ //创建信息窗体
        //         isCustom: true,  //使用自定义窗体
        //         content:'<div><a href="http://www.baidu.com">信息窗体</a></div>', //信息窗体的内容可以是任意html片段
        //         offset: new AMap.Pixel(16, -45)
        //     }).open(map, e.target.getPosition());
        // });

        @foreach ($posts as $post)
            // title = '{{ $post->title }} ';
            // console.log(title);

            var lat = Number.parseFloat('{{ $post->coordinate_latitude }}');
            var lng = Number.parseFloat('{{ $post->coordinate_longitude }}');
            // console.log(lat, lng);

            var img = '{{ $post->images }}';
            // console.log(img.split(',')[0]);

            // var marker = new AMap.Marker({
            //     icon: new AMap.Icon({
            //         // size: [36, 36],
            //         // image: "http://images.vppdb.com/image_picker_36936C20-D749-4D95-B262-BA67293ED53B-95759-00037EC8E75609DF.jpg"
            //         // image: "{{ asset('images/avatar/people.jpeg')  }}",
            //         image: "//a.amap.com/jsapi_demos/static/demo-center/icons/poi-marker-default.png",
            //         offset: new AMap.Pixel(-13, -30)
            //     }),
            //     anchor: 'center',
            //     position: [lng, lat],
            //     // position: [116.481181, 39.989792],
            //     // label: {
            //     //     content: '{{ $post->title }}',
            //     //     direction: 'bottom',
            //     //     // offset: new AMap.Pixel(-5, 10)
            //     // }
            // });

            var marker = new AMap.Marker({
                icon: "//a.amap.com/jsapi_demos/static/demo-center/icons/poi-marker-default.png",
                position: [lng, lat],
                offset: new AMap.Pixel(-13, -30)
            });
            // marker.setMap(map);
            
            // var marker = new AMap.Icon({
            //     position: [116.481181, 39.989792],
            //     image: "http://images.vppdb.com/image_picker_36936C20-D749-4D95-B262-BA67293ED53B-95759-00037EC8E75609DF.jpg"
            // })

            map.add(marker);
            marker.on('click', function(e){
                new AMap.InfoWindow({ //创建信息窗体
                    isCustom: true,  //使用自定义窗体
                    content:'<div><a href="posts/{{ $post->id }}">{{ $post->title }}</a></div>', //信息窗体的内容可以是任意html片段
                    offset: new AMap.Pixel(16, -45)
                }).open(map, e.target.getPosition());
            });

        @endforeach

        // 同时引入工具条插件，比例尺插件和鹰眼插件
        AMap.plugin([
            'AMap.ToolBar',
            'AMap.Scale',
            'AMap.OverView',
            'AMap.MapType',
            'AMap.Geolocation',
        ], function(){
            // 在图面添加工具条控件，工具条控件集成了缩放、平移、定位等功能按钮在内的组合控件
            map.addControl(new AMap.ToolBar());

            // 在图面添加比例尺控件，展示地图在当前层级和纬度下的比例尺
            map.addControl(new AMap.Scale());

            // 在图面添加鹰眼控件，在地图右下角显示地图的缩略图
            map.addControl(new AMap.OverView({isOpen:true}));
        
            // 在图面添加类别切换控件，实现默认图层与卫星图、实施交通图层之间切换的控制
            map.addControl(new AMap.MapType());
        
            // 在图面添加定位控件，用来获取和展示用户主机所在的经纬度位置
            map.addControl(new AMap.Geolocation());
        });


        //批量添加index marker
        var layer = new AMap.LabelsLayer({
            zooms: [3, 20],
            zIndex: 1000,
            // 开启标注避让，默认为开启，v1.4.15 新增属性
            collision: true,
            // 开启标注淡入动画，默认为开启，v1.4.15 新增属性
            animation: true,
        });
        var markers = [];
        var LabelsData = [
            {
                position: [120.387428, 39.91923],
                name: 'id1',
                icon: new AMap.Icon({
                    size: [36, 36],
                    image: "http://images.vppdb.com/image_picker_36936C20-D749-4D95-B262-BA67293ED53B-95759-00037EC8E75609DF.jpg",
                }),
                text: 'Test 001'
            }
        ];

        for (var i = 0; i < LabelsData.length; i++) {
            var curData = LabelsData[i];
            curData.extData = {
                index: i
            };

            var labelMarker = new AMap.LabelMarker(curData);

            markers.push(labelMarker);

            layer.add(labelMarker);
        }

        map.setFitView();
    }
</script>
@endsection
