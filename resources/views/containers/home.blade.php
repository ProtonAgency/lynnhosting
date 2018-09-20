@extends ('layouts.app')
@section ('content')
<div class="inner-hero-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="inner-hero-content">
                    <h1>Your Containers</h1>
                    <div class="row">
                    	<div class="col-md-4"></div>
                    	<div class="col-md-4">
		                    <div class="center-btn text-center">
		                    	<a href="/containers/new" >Create Container</a>
		                    </div>
                    	</div>
                    	<div class="col-md-4"></div>
                    </div>
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
                    @if(session('notification') !== null)
                        <div class="alert alert-primary" role="alert">
                            {{ session('notification') }}
                        </div>
                    @endif
                    <table class="table">
                    	<thead>
                    		<tr>
                    			<th>Name</th>
                                <th>Domain</th>
                    			<th>Storage</th>
                    			<th>Bandwidth</th>
                                <th>Status</th>
                    			<th>Action</th>
                    		</tr>
                    	</thead>
                    	<tbody>
                    		@foreach ($containers as $container)
                    			<tr>
                    				<td>{{ $container->name }}</td>
                                    <td><a href="https://{{ $container->domain }}" target="_blank">{{ $container->domain }}</a></td>
                    				<td>{{ $container->getStorageUsed() }}GB of {{ $container->plan->storage }}GB used</td>
                    				<td>Not Monitored</td>
                                    <td>
                                    @if ($container->getStatus())
                                        <span class="badge badge-success">Online</span>
                                    @else
                                        <span class="badge badge-danger">Offline</span>
                                    @endif
                                    </td>
                    				<td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="{{ $container->name}}-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="{{ $container->name}}-dropdown">
                                                <a class="dropdown-item" type="button" data-toggle="modal" data-target="#{{ $container->name }}-info">View Container Info</a>
                                                <a class="dropdown-item" type="button" data-toggle="modal" data-target="#{{ $container->name }}">View SFTP Info</a>
                                                <a class="dropdown-item" href="/containers/{{ $container->hash }}/terminal" target="_blank">Container Terminal</a>
                                                <a class="dropdown-item" href="/containers/{{ $container->hash }}/destroy">Destroy Container</a>
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
@foreach($containers as $container)
<div class="modal" id="{{ $container->name }}" tabindex="-1" role="dialog" aria-labelledby="{{ $container->name}}-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="{{ $container->name}}-label"><center>SFTP Information Container #{{ $container->name }}</center></h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label>SFTP Host:</label>
                        <input class="form-control" type="text" value="{{ $container->location->host }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>SFTP Port:</label>
                        <input class="form-control" type="text" value="{{ $container->location->port }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>SFTP User:</label>
                        <input class="form-control" type="text" value="{{ $container->name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>SFTP Password:</label>
                        <input class="form-control" type="text" value="{{ $container->ftp_password }}" readonly>
                        @if ($container->change_password !== false)
                            <!-- <p style="color: red;">You need to change your SFTP password! Click <a href="/containers/{{ $container->hash }}/password">here</a> to change your password.</p> -->
                        @endif
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="{{ $container->name }}-info" tabindex="-1" role="dialog" aria-labelledby="{{ $container->name}}-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="{{ $container->name}}-label"><center>Container Information #{{ $container->name }}</center></h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label>Container Domain:</label>
                        <input class="form-control" type="text" value="{{ $container->domain }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Container Storage:</label>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Calculating...</div>
                        </div>
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