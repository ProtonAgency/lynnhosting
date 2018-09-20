@extends ('layouts.app')
@section ('content')
<div class="inner-hero-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="inner-hero-content">
                    <h1>Your Databases</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="domain-area">
    <div class="container">
        <div class="domain-area-left">
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                    	<thead>
                    		<tr>
                    			<th>Container</th>
                                <th>Name</th>
                    			<th>Action</th>
                    		</tr>
                    	</thead>
                    	<tbody>
                            @foreach ($databases as $database)
                                <tr>
                                    <td>{{ $database->container->name }}</td>
                                    <td>{{ $database->name }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="{{ $database->name}}-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="{{ $database->name}}-dropdown">
                                                <a class="dropdown-item" type="button" data-toggle="modal" data-target="#{{ $database->name }}">View Database Info</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                    	</tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@foreach ($databases as $database)
<div class="modal" id="{{ $database->name }}" tabindex="-1" role="dialog" aria-labelledby="{{ $database->name}}-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="{{ $database->name}}-label"><center>SFTP Information Container #{{ $database->name }}</center></h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label>Database Host:</label>
                        <input class="form-control" type="text" value="{{ $database->host }}" readonly>
                        <small>If connecting to database from container {{ $database->container->name }}, `localhost` can be used at the connection ip.</small>
                    </div>
                    <div class="form-group">
                        <label>Database Port:</label>
                        <input class="form-control" type="text" value="3306" readonly>
                    </div>
                    <div class="form-group">
                        <label>Database Name:</label>
                        <input class="form-control" type="text" value="{{ $database->name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Database User:</label>
                        <input class="form-control" type="text" value="{{ $database->user }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Database Password:</label>
                        <input class="form-control" type="text" value="{{ $database->password }}" readonly>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection