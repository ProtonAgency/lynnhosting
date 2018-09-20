@extends ('layouts.app')
@section ('content')
<div class="inner-hero-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="inner-hero-content">
                    <h1>Create Container</h1>
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
                    <form id="form" class="form" action="/containers/new" method="post">
                        @csrf

                        @if (isset($error))
                            <div style="color: red; text-align: center;">
                                {{ $error }}
                            </div>
                        @endif
                        @if (session('error') !== null)
                            <div style="color: red; text-align: center;">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <div class="inner-hero-content">
                                    <h3><center>Select Plan</center></h3>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <?php $container_total = \App\Container::all()->count(); ?>
                        @foreach (\App\Plan::all() as $plan)
                            <div class="col-md-4">
                                <a href="#!" class="btn" onclick="document.getElementById('plan').value = '{{ $plan->id }}'; document.getElementById('submit').disabled = false;">
                                    <div class="single-price-slide">
                                        <div class="single-price">
                                            <div class="price-quality">
                                                <h4>{{ $plan->name }}</h4>
                                                <h2>${{ $plan->price }}/mo</h2>
                                            </div>
                                            <div class="price-details">
                                                <ul>
                                                    <li><b>{{ $plan->storage }}</b>GB SSD</li>
                                                    <li><b>{{ $plan->databases}}</b> Database(s)</li>
                                                    <li><b>{{ $plan->emails }}</b> Email Accounts</li>
                                                    <li><b>{{ $plan->domains }}</b> Projects</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach 
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="inner-hero-content">
                                    <h3><center>Select Location</center></h3>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Location</label>
                            <select class="form-control" name="location" required>
                                <option value="Select Location.." disabled selected>Select Location..</option>
                                @foreach (\App\Location::all() as $location)
                                    <?php $percent = $container_total > 0 ? \App\Container::where('location_id', '=', $location->id)->get()->count() / $container_total : 0; ?>
                                    <option value="{{ $location->id }}">{{ $location->name }} {{ number_format( $percent * 100, 2 ) . '%' }} Usage</option>
                                @endforeach
                            </select>
                        </div>

                        <input type="hidden" name="plan" id="plan" onchange="document.getElementById('submit').disabled = false;">

                        <div id="domain_holder">
                            <div class="form-group">
                                <label>Domain</label>
                                <input class="form-control" type="text" name="domain" placeholder="mydomain.com" required>
                                <small>You can enter multiple domains seperated by commas and multiple websites will be setup on your container.</small>
                            </div>
                        </div>

                        
                        <div class="form-group">
                            <label>Pre-Installed Software <span class="badge badge-info">BETA</span></label>
                            <select class="form-control" name="software">
                                <option value="Select Location.." disabled selected>Select Software..</option>
                                @foreach (\App\Software::all() as $software)
                                    <option value="{{ $software->id }}">{{ $software->name . ' v' . $software->version }}</option>
                                @endforeach
                            </select>
                            <small>This is a <b>beta</b> feature, you may encounter issues with software installs. Please <a href="mailto:sales@lynndigital.com">contact support </a> if you encounter any issues.</small>
                        </div>  

                        <div class="form-group">
                            <label>Composer Repositories <span class="badge badge-info">BETA</span></label>
                            <textarea class="form-control" name="composer" rows="2" placeholder="lynndigital/repo1, lynndigital/repo2"></textarea>
                            <small>Enter up to 15 composer repos seperated by commas.</small>
                        </div>
                        

                        <div class="form-group">
                            <label>.htaccess <span class="badge badge-info">BETA</span></label>
                            <textarea class="form-control" name="htaccess" rows="5"></textarea>
                            <small>Paste the contents of your .htaccess file here and the container will be built with it. We also offer fillable variables for your .htaccess file, <a href="/docs">view documentation</a>.</small>
                        </div>                 

                        <div class="form-group">
                            <button id="submit" style="width: 100%" class="btn btn-primary btn-lg" disabled>Create Container</button>
                            <small>By clicking Create Container you agree to Lynn Hosting's <a href="/legal">ToS</a>, <a href="/legal">Privacy Policy</a>, and <a href="/legal">Refund Policy</a>.</small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section ('js')
<script type="text/javascript">
    $(document).ready(function() {
        document.querySelector('#submit').addEventListener( 'click', function ( event ) {
            if (document.getElementById('plan').value === "") {
                return;
            }

            document.getElementById('submit').innerHTML = 'Creating Container <i class="fa fa-circle-o-notch fa-spin"></i>';
            document.getElementById('submit').disabled = true;
            $('#form').submit();
        });
    });
</script>
@endsection