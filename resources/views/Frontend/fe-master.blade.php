<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" href="{{ asset('frontend/assets/css/main.min.css') }}">
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<title>Trang chu</title>
	</head>
	<body class="@yield('body-class')">
        @include('Frontend.main.header')
		
		<main>
			<section id="home-banner"> 
				<div class="home-banner"> 
					<div class="swiper-container">
						<div class="swiper-wrapper">
							<div class="swiper-slide">
								<div class="wrap-banner">
									<div class="img"><img class="lazyload" data-src="./img/banner/1.jpg" alt=""></div>
									<div class="wrap-inner bl-title">
										<div class="title">To be recognized as the leader in the development and supply of innovative and sustainable athletic footwear.</div>
									</div>
									<div class="wrap-inner icon">
										<div class="btn-scrolldown"><em class="material-icons">expand_more</em></div>
									</div>
								</div>
							</div>
							<div class="swiper-slide">
								<div class="wrap-banner">
									<div class="img"><img class="lazyload" data-src="./img/banner/2.jpg" alt=""></div>
									<div class="wrap-inner bl-title">
										<div class="title">To be recognized as the leader in the development and supply of innovative and sustainable athletic footwear.</div>
									</div>
									<div class="wrap-inner icon">
										<div class="btn-scrolldown"><em class="material-icons">expand_more</em></div>
									</div>
								</div>
							</div>
							<div class="swiper-slide">
								<div class="wrap-banner">
									<div class="img"><img class="lazyload" data-src="./img/banner/3.jpg" alt=""></div>
									<div class="wrap-inner bl-title">
										<div class="title">To be recognized as the leader in the development and supply of innovative and sustainable athletic footwear.</div>
									</div>
									<div class="wrap-inner icon">
										<div class="btn-scrolldown"><em class="material-icons">expand_more</em></div>
									</div>
								</div>
							</div>
							<div class="swiper-slide">
								<div class="wrap-banner">
									<div class="img"><img class="lazyload" data-src="./img/banner/4.jpg" alt=""></div>
									<div class="wrap-inner bl-title">
										<div class="title">To be recognized as the leader in the development and supply of innovative and sustainable athletic footwear.</div>
									</div>
									<div class="wrap-inner icon">
										<div class="btn-scrolldown"><em class="material-icons">expand_more</em></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<section class="section home-1">
				<div class="container"> 
					<div class="row"> 
						<div class="col-lg-6 col-md-12">
							<div class="wrap-title"> 
								<div class="section-title">Giới thiệu
									<div class="section-title-line"><img src="./img/title.png" alt=""></div>
								</div>
							</div>
							<div class="wrap-content"> 
								<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut magnam culpa, perspiciatis architecto autem dolore sint non tempore obcaecati ullam odio, provident impedit commodi porro exercitationem ratione maiores? Harum, facilis?</p>
								<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nihil ullam vel neque veritatis dignissimos! Reiciendis pariatur consectetur impedit nesciunt. Animi quibusdam, est quis ex laborum assumenda culpa a odit asperiores.</p>
								<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nihil ullam vel neque veritatis dignissimos! Reiciendis pariatur consectetur impedit nesciunt. Animi quibusdam, est quis ex laborum assumenda culpa a odit asperiores.</p>
							</div>
							<div class="wrap-button"><a class="btn btn-primary" href="">Xem thêm</a></div>
						</div>
						<div class="col-lg-6 col-md-12">
							<div class="swiper-home-1">
								<div class="swiper-container"> 
									<div class="swiper-wrapper"> 
										<div class="swiper-slide"><a href="./img/flower/1.jpg" data-fancybox="Img" title="Album 1"><img src="./img/flower/1.jpg" alt=""></a></div>
										<div class="swiper-slide"><a href="./img/flower/2.jpg" data-fancybox="Img" title="Album 1"><img src="./img/flower/2.jpg" alt=""></a></div>
										<div class="swiper-slide"><a href="./img/flower/3.jpg" data-fancybox="Img" title="Album 1"><img src="./img/flower/3.jpg" alt=""></a></div>
										<div class="swiper-slide"><a href="./img/flower/4.jpg" data-fancybox="Img" title="Album 1"><img src="./img/flower/4.jpg" alt=""></a></div>
									</div>
								</div>
								<div class="swiper-navigation"> 
									<div class="button-next"><em class="material-icons">east</em></div>
									<div class="button-prev"><em class="material-icons">east</em></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<section class="section home-2">
				<div class="container">
					<div class="wrap-title"> 
						<div class="section-title">Dịch vụ nhận hoa
							<div class="section-title-line"><img src="./img/title.png" alt=""></div>
						</div>
					</div>
					<div class="wrap-product">
						<div class="row">
							<div class="col-md-4 col-sm-12">
								<div class="block-product"> <a class="product-img zoom-out" href=""><img src="./img/flower/1.jpg" alt=""></a>
									<div class="product-info"><a class="product-info__title" href="">Gói sản phẩm 1</a>
										<div class="product-info__detail">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Expedita delectus est labore fugit natus, similique atque rem nulla, vero laborum debitis aspernatur ratione animi, vitae sed nisi minima! Sunt, pariatur!</div>
										<div class="product-info__price">Liên hệ</div>
									</div>
								</div>
							</div>
							<div class="col-md-4 col-sm-12">
								<div class="block-product"> <a class="product-img zoom-out" href=""><img src="./img/flower/2.jpg" alt=""></a>
									<div class="product-info"><a class="product-info__title" href="">Gói sản phẩm 2</a>
										<div class="product-info__detail">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Expedita delectus est labore fugit natus, similique atque rem nulla, vero laborum debitis aspernatur ratione animi, vitae sed nisi minima! Sunt, pariatur!</div>
										<div class="product-info__price">Liên hệ</div>
									</div>
								</div>
							</div>
							<div class="col-md-4 col-sm-12">
								<div class="block-product"> <a class="product-img zoom-out" href=""><img src="./img/flower/3.jpg" alt=""></a>
									<div class="product-info"><a class="product-info__title" href="">Gói sản phẩm 3</a>
										<div class="product-info__detail">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Expedita delectus est labore fugit natus, similique atque rem nulla, vero laborum debitis aspernatur ratione animi, vitae sed nisi minima! Sunt, pariatur!</div>
										<div class="product-info__price">Liên hệ</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<section class="section home-3">
				<div class="container"> 
					<div class="wrap-title"> 
						<div class="section-title">Sản phẩm nổi bật
							<div class="section-title-line"><img src="./img/title.png" alt=""></div>
						</div>
					</div>
					<div class="swiper-home-2">
						<div class="swiper-container"> 
							<div class="swiper-wrapper"> 
								<div class="swiper-slide">
									<div class="block-product"> <a class="product-img zoom-out" href=""><img src="./img/flower/1.jpg" alt=""></a>
										<div class="product-info"><a class="product-info__title" href="">Sản phẩm 1</a>
											<div class="product-info__price">Liên hệ</div>
										</div>
									</div>
								</div>
								<div class="swiper-slide">
									<div class="block-product"> <a class="product-img zoom-out" href=""><img src="./img/flower/2.jpg" alt=""></a>
										<div class="product-info"><a class="product-info__title" href="">Sản phẩm 2</a>
											<div class="product-info__price">Liên hệ</div>
										</div>
									</div>
								</div>
								<div class="swiper-slide">
									<div class="block-product"> <a class="product-img zoom-out" href=""><img src="./img/flower/3.jpg" alt=""></a>
										<div class="product-info"><a class="product-info__title" href="">Sản phẩm 3</a>
											<div class="product-info__price">Liên hệ</div>
										</div>
									</div>
								</div>
								<div class="swiper-slide">
									<div class="block-product"> <a class="product-img zoom-out" href=""><img src="./img/flower/4.jpg" alt=""></a>
										<div class="product-info"><a class="product-info__title" href="">Sản phẩm 4</a>
											<div class="product-info__price">Liên hệ</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="swiper-navigation"> 
							<div class="button-next"><em class="material-icons">east</em></div>
							<div class="button-prev"><em class="material-icons">east</em></div>
						</div>
						<div class="wrap-button"> <a class="btn btn-primary" href="">Xem thêm</a></div>
					</div>
				</div>
			</section>
			<section class="section home-5">
				<div class="container"> 
					<div class="wrap-title"> 
						<div class="section-title">Bộ sưu tập
							<div class="section-title-line"><img src="./img/title.png" alt=""></div>
						</div>
					</div>
				</div>
				<div class="block-gallery">
					<div class="gallery-item eye"><a class="zoom-out" href="./img/flower/1.jpg" data-fancybox="Img" title="Album 1"><img src="./img/flower/1.jpg" alt=""></a></div>
					<div class="gallery-item eye"><a class="zoom-out" href="./img/flower/2.jpg" data-fancybox="Img" title="Album 1"><img src="./img/flower/2.jpg" alt=""></a></div>
					<div class="gallery-item eye"><a class="zoom-out" href="./img/flower/3.jpg" data-fancybox="Img" title="Album 1"><img src="./img/flower/3.jpg" alt=""></a></div>
					<div class="gallery-item eye"><a class="zoom-out" href="./img/flower/4.jpg" data-fancybox="Img" title="Album 1"><img src="./img/flower/4.jpg" alt=""></a></div>
					<div class="gallery-item eye"><a class="zoom-out" href="./img/flower/5.jpg" data-fancybox="Img" title="Album 1"><img src="./img/flower/5.jpg" alt=""></a></div>
					<div class="gallery-item eye"><a class="zoom-out" href="./img/flower/6.jpg" data-fancybox="Img" title="Album 1"><img src="./img/flower/6.jpg" alt=""></a></div>
				</div>
			</section>
		</main>
		
        @include('Frontend.main.footer')
		<div class="tool-page">
			<div class="scrolltop" id="scroll-top"></div>
			<div id="phone"><a class="Phone is-animating" href="tel:+5545455"></a></div>
		</div>
		<script>LazyLoad=function(doc){var env,head,pending={},pollCount=0,queue={css:[],js:[]},styleSheets=doc.styleSheets;function createNode(name,attrs){var node=doc.createElement(name),attr;for(attr in attrs)attrs.hasOwnProperty(attr)&&node.setAttribute(attr,attrs[attr]);return node}function finish(type){var p=pending[type],callback,urls;p&&(callback=p.callback,(urls=p.urls).shift(),pollCount=0,urls.length||(callback&&callback.call(p.context,p.obj),pending[type]=null,queue[type].length&&load(type)))}function getEnv(){var ua=navigator.userAgent;((env={async:!0===doc.createElement("script").async}).webkit=/AppleWebKit\//.test(ua))||(env.ie=/MSIE|Trident/.test(ua))||(env.opera=/Opera/.test(ua))||(env.gecko=/Gecko\//.test(ua))||(env.unknown=!0)}function load(type,urls,callback,obj,context){var _finish=function(){finish(type)},isCSS="css"===type,nodes=[],i,len,node,p,pendingUrls,url;if(env||getEnv(),urls)if(urls="string"==typeof urls?[urls]:urls.concat(),isCSS||env.async||env.gecko||env.opera)queue[type].push({urls:urls,callback:callback,obj:obj,context:context});else for(i=0,len=urls.length;i<len;++i)queue[type].push({urls:[urls[i]],callback:i===len-1?callback:null,obj:obj,context:context});if(!pending[type]&&(p=pending[type]=queue[type].shift())){for(head||(head=doc.head||doc.getElementsByTagName("head")[0]),i=0,len=(pendingUrls=p.urls.concat()).length;i<len;++i)url=pendingUrls[i],isCSS?node=env.gecko?createNode("style"):createNode("link",{href:url,rel:"stylesheet"}):(node=createNode("script",{src:url})).async=!1,node.className="lazyload",node.setAttribute("charset","utf-8"),env.ie&&!isCSS&&"onreadystatechange"in node&&!("draggable"in node)?node.onreadystatechange=function(){/loaded|complete/.test(node.readyState)&&(node.onreadystatechange=null,_finish())}:isCSS&&(env.gecko||env.webkit)?env.webkit?(p.urls[i]=node.href,pollWebKit()):(node.innerHTML='@import "'+url+'";',pollGecko(node)):node.onload=node.onerror=_finish,nodes.push(node);for(i=0,len=nodes.length;i<len;++i)head.appendChild(nodes[i])}}function pollGecko(node){var hasRules;try{hasRules=!!node.sheet.cssRules}catch(ex){return void((pollCount+=1)<200?setTimeout((function(){pollGecko(node)}),50):hasRules&&finish("css"))}finish("css")}function pollWebKit(){var css=pending.css,i;if(css){for(i=styleSheets.length;--i>=0;)if(styleSheets[i].href===css.urls[0]){finish("css");break}pollCount+=1,css&&(pollCount<200?setTimeout(pollWebKit,50):finish("css"))}}return{css:function(urls,callback,obj,context){load("css",urls,callback,obj,context)},js:function(urls,callback,obj,context){load("js",urls,callback,obj,context)}}}(this.document);</script>
		<script>
			LazyLoad.css([
				"{{ asset('frontend/assets/css/plugins.min.css') }}",
				'https://fonts.googleapis.com/icon?family=Material+Icons',
				'https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css',
				'https://fonts.googleapis.com/css2?family=KoHo:wght@200;300;400;500;600;700&display=swap',
				'https://cdn.jsdelivr.net/npm/@mdi/font@5.8.55/css/materialdesignicons.min.css',
				"https://fonts.googleapis.com/css2?family=Material+Icons",
				//- 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
				"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
			], function () {
			});
		</script>
		<script>
			LazyLoad.js([
				"{{ asset('frontend/assets/js/plugins.min.js') }}",
				"{{ asset('frontend/assets/js/main.min.js') }}",
				], function () {
			});
		</script>
	</body>
</html>