<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --}}
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no"> 
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fossils Hunter Home Page</title>

    {{-- <script type="text/javascript" src="https://webapi.amap.com/maps?v=1.4.15&key=f885b7b92d0285147996269b7afaa30e"></script>  --}}


    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        
        body {
            font-family: 'Nunito';
        }

        #container {
            margin: auto
            width: 60%; 
            height: 600px;
        }
    </style>
</head>
{{-- <body>
    <div id="container"></div> 

    <script>
        window.onLoad  = function(){
            var map = new AMap.Map('container', {
                zoom:11,//级别
                center: [116.397428, 39.90923],//中心点坐标
                viewMode:'3D'//使用3D视图
            });
        }
        var url = 'https://webapi.amap.com/maps?v=1.4.15&key=f885b7b92d0285147996269b7afaa30e&callback=onLoad';
        var jsapi = document.createElement('script');
        jsapi.charset = 'utf-8';
        jsapi.src = url;
        document.head.appendChild(jsapi);
    </script>
</body> --}}

<body class="c-app">
    <div class="c-sidebar">
      <!-- Sidebar content here -->
    </div>
    <div class="c-wrapper">
      <header class="c-header">
          test
        {{-- <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            
          </div> --}}

        @if (Route::has('login'))
            <div class="fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                    <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                    @endif
                @endif
            </div>
        @endif
      </header>
      <div class="c-body">
        <main class="c-main">
          <!-- Main content here -->
          test
          <div id="container"></div>
        </main>
      </div>
      <footer class="c-footer">
        <!-- Footer content here -->
      </footer>
    </div>

   
    <script>
        window.onLoad  = function(){
            var map = new AMap.Map('container', {
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
                position: [116.481181, 39.989792],
                label: {
                    content: '测试marker',
                    direction: 'bottom',
                    // offset: new AMap.Pixel(-5, 10)
                }
            })
            // var marker = new AMap.Icon({
            //     position: [116.481181, 39.989792],
            //     image: "http://images.vppdb.com/image_picker_36936C20-D749-4D95-B262-BA67293ED53B-95759-00037EC8E75609DF.jpg"
            // })
            map.add(marker);
            marker.on('click',onMarkerClick);//绑定click事件

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


        var url = 'https://webapi.amap.com/maps?v=1.4.15&key=f885b7b92d0285147996269b7afaa30e&callback=onLoad';
        var jsapi = document.createElement('script');
        jsapi.charset = 'utf-8';
        jsapi.src = url;
        document.head.appendChild(jsapi);
    </script>
  </body>
</html>