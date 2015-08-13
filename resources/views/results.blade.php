<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="//fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">3D Matrix Results</div>


				{!! Form::open( array('action' => 'WelcomeController@calculus') ) !!}
				
				<div class="form-group">


					{!! Form::label('El resultado es') !!}<br/><?php echo $exercise; ?>c
				</div>
				
				<div class="form-group">
					{!! Form::submit('Ingresar', 
					  array('class'=>'btn btn-primary')) !!}
				</div>
				{!! Form::close() !!}
				
            </div>
        </div>
    </body>
</html>
