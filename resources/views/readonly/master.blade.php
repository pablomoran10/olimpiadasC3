<!DOCTYPE HTML>
<!--
	Read Only by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Olimpiadas Informáticas Región de Murcia</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <meta name="description" content="Olimpiadas Informáticas Región de Murcia" />
        <meta name="author" content="CIFP Carlos III" />
        <meta lang="es" />
		<link rel="stylesheet" href="{{ asset('/ediciones/edicion2025/main.css') }}" />
	</head>
	<body class="is-preload">

        @include('readonly.partials.header')
        @include('readonly.partials.wrapper')
        @include('readonly.partials.footer')

		<!-- Scripts -->
			<script src="{{ asset('/readonly/assets/js/jquery.min.js') }}"></script>
			<script src="{{ asset('/readonly/assets/js/jquery.scrollex.min.js') }}"></script>
			<script src="{{ asset('/readonly/assets/js/jquery.scrolly.min.js') }}"></script>
			<script src="{{ asset('/readonly/assets/js/browser.min.js') }}"></script>
			<script src="{{ asset('/readonly/assets/js/breakpoints.min.js') }}"></script>
			<script src="{{ asset('/readonly/assets/js/util.js') }}"></script>
			<script src="{{ asset('/readonly/assets/js/main.js') }}"></script>

	</body>
</html>
