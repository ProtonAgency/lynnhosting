<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>Container {{ $container->name }} Terminal</title>

		<link rel="stylesheet" type="text/css" href="/css/jquery.terminal.css">
		<link rel="icon" type="image/png" href="/img/favicon.png">

		<!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script> -->
		<script src="/js/app.js"></script>
		<script src="/js/jquery.terminal.js"></script>

		<script type="text/javascript">
			Echo.private('container.{{ $container->name}}').listen('.container.command.response', (e) => {
			    window.term.echo(e.command_response);
			    window.term.terminal().resume();
			    console.log(e);
			});
		</script>

		<script type="text/javascript">	
		   $(function() {
		       	window.term = $('body').terminal(function(command, term) 
		      	{
		        	term.pause();
		
					$.ajax({
					    url: '/containers/{{ $container->hash }}/terminal',
					    type: 'post',
					    data: 
					   	{
					        'input_command': command
					    },
					    headers: {
					        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
					    },
					    dataType: 'json',
					    error: function (data) {
					    	term.echo('ERROR: UNABLE TO COMMUNICATE WITH {{ strtoupper($container->location->name) }} LOCATION!');
					    }
					});
				}, 
				{
					greetings: "You're viewing the terminal for container {{ $container->name }}, your container runs the php7.2-apache docker image. Enter any commands below to manipulate your container and it's environment. Container Terminal is not interactive, some commands such as `cd` may not work, to execute a command in a specific directory you must format your command as `cd /mydir && mycommand`. Container Terminal is a BETA feature, it is not complete and you may encounter issues at any time.",
					prompt: '{{ $container->name . "@" . strtolower($container->location->name) }}> '
				});
		   });
		</script>
	</head>
	<body class="terminal" style="overflow-y: hidden;">
	</body>
</html>