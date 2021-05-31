<?php
start_div('mb-3');
  create_title(str_replace('/',' <i class="fas fa-chevron-right fa-sm"></i> ',$_SERVER['REQUEST_URI']), "warning");
end_div();
?>

<div class="mb-5">
<!-- stats v1 -->
<div class="wrapper">
  <div class="heading">
  <div class="row">
    <div class="col-12 col-md-8"><h2 class="text-muted">System Overview</h2></div>
    <div class="col-6 col-md-4 text-right"><span id="mitigation_services"></span></div>
  </div>
  </div>

  <div class="row">
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
      <a class="dashboard-stat red" href="#">
        <div class="visual">
          <i class="fas fa-cloud-download-alt"></i>
        </div>
        <div class="details">
          <div class="number">
            <span id="inbound_pps">0</span>
          </div>
          <div class="text-right">INBOUND (<span id="inbound_pps_unit" class="desc"></span>)</div>
        </div>
      </a>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
      <a class="dashboard-stat blue" href="#">
        <div class="visual">
          <i class="fas fa-download"></i>
        </div>
        <div class="details">
          <div class="number">
            <span id="inbound_mbps">0</span>
          </div>
          <div class="text-right">INBOUND (<span id="inbound_mbps_unit" class="desc"></span>)</div>
        </div>
      </a>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
      <a class="dashboard-stat hoki" href="#">
        <div class="visual">
          <i class="fas fa-cloud-upload-alt"></i>
        </div>
        <div class="details">
          <div class="number">
            <span id="outbound_pps">0</span>
          </div>
          <div class="text-right">OUTBOUND (<span id="outbound_pps_unit" class="desc"></span>)</div>
        </div>
      </a>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
      <a class="dashboard-stat purple" href="#">
        <div class="visual">
          <i class="fas fa-upload"></i>
        </div>
        <div class="details">
          <div class="number">
            <span id="outbound_mbps">0</span>
          </div>
          <div class="text-right">OUTBOUND (<span id="outbound_mbps_unit" class="desc"></span>)</div>
        </div>
      </a>
    </div>
  </div>
</div>

<pre id="license">LICENSE: </pre>

<!-- stats v2 -->
<div class="mb-5">
  <h4 class="mb-3 text-muted">Global Configuration</h4>
  <div class="header-body">
    <div class="row">
    <div class="col-xl-3 col-lg-6">
      <div class="card card-stats mb-4 mb-xl-0 is-card-dark">
        <div class="card-body">
          <div class="row">
            <div class="col">
              <h5 class="card-title text-uppercase text-muted mb-0">PPS THRESHOLD</h5>
              <span id="threshold_pps" class="h2 font-weight-bold mb-0">0</span>
            </div>
            <div class="col-auto">
              <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
              <i class="fab fa-connectdevelop"></i>
              </div>
            </div>
          </div>
          <p class="mt-3 mb-0 text-muted text-sm">
            <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
            <span class="text-nowrap">Since last month</span>
          </p>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6">
      <div class="card card-stats mb-4 mb-xl-0 is-card-dark">
        <div class="card-body">
          <div class="row">
            <div class="col">
              <h5 class="card-title text-uppercase text-muted mb-0">MBPS THRESHOLD</h5>
              <span id="threshold_mbps" class="h2 font-weight-bold mb-0">0</span>
            </div>
            <div class="col-auto">
              <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
              <i class="fas fa-random"></i>
              </div>
            </div>
          </div>
          <p class="mt-3 mb-0 text-muted text-sm">
            <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 3.48%</span>
            <span class="text-nowrap">Since last week</span>
          </p>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6">
      <div class="card card-stats mb-4 mb-xl-0 is-card-dark">
        <div class="card-body">
          <div class="row">
            <div class="col">
              <h5 class="card-title text-uppercase text-muted mb-0">FLOW THRESHOLD</h5>
              <span id="threshold_flows" class="h2 font-weight-bold mb-0">0</span>
            </div>
            <div class="col-auto">
              <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
              <i class="fas fa-sitemap"></i>
              </div>
            </div>
          </div>
          <p class="mt-3 mb-0 text-muted text-sm">
            <span class="text-warning mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
            <span class="text-nowrap">Since yesterday</span>
          </p>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6">
      <div class="card card-stats mb-4 mb-xl-0 is-card-dark">
        <div class="card-body">
          <div class="row">
            <div class="col">
              <h5 class="card-title text-uppercase text-muted mb-0">NETFLOW RATIO</h5>
              <span id="netflows_ratio" class="h2 font-weight-bold mb-0">0</span>
            </div>
            <div class="col-auto">
              <div class="icon icon-shape bg-info text-white rounded-circle shadow">
              <i class="fas fa-archive"></i>
              </div>
            </div>
          </div>
          <p class="mt-3 mb-0 text-muted text-sm">
            <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
            <span class="text-nowrap">Since last month</span>
          </p>
        </div>
      </div>
    </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-sm-6">
    <div class="card mb-3 is-card-dark">
      <div class="card-body">
        <h5 class="card-title text-muted">Attack Mitigation (Flowspec)</h5>
        <small>
          <?php create_table(array("Prefix","Desc","Dst. Ports","Src. Ports","Protocols","Action","uuid"),array(1,'1.1.1.1','2.2.2.2','53','111','udp','drop','a21cd-x'),"FlowSpec");?>
        </small>
      </div>
    </div>
  </div>

  <div class="col-sm-6">
    <div class="card mb-3 is-card-dark">
      <div class="card-body">
        <h5 class="card-title text-muted">Attack Mitigation (Blackhole)</h5>
        <small>
          <?php create_table(array("IP","Desc","UUID"),array(1,'1.1.1.1','Unknown','a21cd-x'),"BlackHole");?>
        </small>
      </div>
    </div>
  </div>
</div>

</div>

<?php load_css('css/dashboard.css');?>
